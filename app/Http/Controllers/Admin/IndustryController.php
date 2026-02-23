<?php

namespace App\Http\Controllers\Admin;

use App\Models\Industry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class IndustryController extends MasterResourceController
{
    protected string $modelClass = Industry::class;
    protected string $routeName = 'admin.industries';
    protected string $resourceLabel = 'Industry';
    protected string $resourcePlural = 'Industries';
    protected string $indexSubtitle = 'Manage industry categories that define business sectors and work domains.';
    protected string $formSubtitle = 'Each industry should have a unique slug, label, and optional icon before toggling its status.';
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'Label', 'field' => 'label', 'sortable' => true],
        ['label' => 'Slug', 'field' => 'slug', 'sortable' => true],
        ['label' => 'Icon', 'field' => 'icon', 'sortable' => false],
        ['label' => 'Description', 'field' => 'description', 'sortable' => false],
        ['label' => 'Sort order', 'field' => 'sort_order', 'sortable' => true],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
    ];
    protected array $formFields = [
        ['name' => 'label', 'label' => 'Label', 'type' => 'text', 'required' => true],
        ['name' => 'slug', 'label' => 'Slug', 'type' => 'text', 'required' => true],
        ['name' => 'icon', 'label' => 'Icon', 'type' => 'text', 'attributes' => ['placeholder' => 'e.g., fas fa-industry']],
        ['name' => 'description', 'label' => 'Description', 'type' => 'textarea'],
        ['name' => 'sort_order', 'label' => 'Sort order', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $searchColumns = ['label', 'slug', 'description'];
    protected array $sortable = ['id', 'label', 'slug', 'sort_order', 'is_active'];
    protected array $bulkActions = [
        'sample' => [
            'label' => 'Download sample CSV',
            'route' => 'admin.industries.sample',
            'description' => 'Use the sample to match the column order.',
        ],
        'export' => [
            'label' => 'Export filtered list',
            'route' => 'admin.industries.export',
            'description' => 'Grab whatever the filters are showing.',
        ],
        'import' => [
            'label' => 'Import CSV',
            'route' => 'admin.industries.import',
            'description' => 'Upload new or updated industries via CSV.',
        ],
    ];

    protected function rules(Model $record = null): array
    {
        $slugRule = Rule::unique('industries', 'slug');

        if ($record) {
            $slugRule->ignore($record);
        }

        return [
            'label' => ['required', 'string', 'max:191'],
            'slug' => ['required', 'alpha_dash', 'max:191', $slugRule],
            'icon' => ['nullable', 'string', 'max:191'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,txt'],
        ]);

        $rows = array_filter(array_map('str_getcsv', file($request->file('file')->getRealPath())));
        $headers = array_shift($rows);
        if (empty($headers) || empty($rows)) {
            return back()->with('status', 'No rows were found in the CSV.');
        }

        $headers = array_map(fn ($value) => Str::of($value)->trim()->lower()->toString(), $headers);
        $imported = 0;

        foreach ($rows as $row) {
            $row = array_pad($row, count($headers), null);
            $rowData = array_combine($headers, $row);
            if (!$rowData) {
                continue;
            }

            $slug = Str::slug($rowData['slug'] ?? $rowData['label'] ?? '');
            if (!$slug) {
                continue;
            }

            $payload = [
                'label' => $rowData['label'] ?? Str::of($slug)->replace('-', ' ')->title()->toString(),
                'slug' => $slug,
                'icon' => $rowData['icon'] ?? null,
                'description' => $rowData['description'] ?? null,
                'sort_order' => $rowData['sort_order'] ?: null,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            Industry::updateOrCreate(['slug' => $slug], $payload);
            $imported++;
        }

        return back()->with('status', "Imported {$imported} industries.");
    }

    public function export(Request $request)
    {
        $columns = ['slug', 'label', 'icon', 'description', 'sort_order', 'is_active'];
        $filename = 'industries-' . Carbon::now()->format('Y-m-d') . '.csv';

        $callback = function () use ($columns, $request) {
            $records = $this->buildQuery($request)->get();
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            foreach ($records as $record) {
                $row = [];
                foreach ($columns as $column) {
                    $value = $record->{$column};
                    if (is_bool($value)) {
                        $value = $value ? '1' : '0';
                    }
                    $row[] = $value;
                }
                fputcsv($handle, $row);
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }

    public function sample(): StreamedResponse
    {
        $columns = ['slug', 'label', 'icon', 'description', 'sort_order', 'is_active'];
        $filename = 'industries-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['financial-services', 'Financial Services', 'fas fa-coins', 'Banking, insurance and financial institutions', 10, 1]);
            fputcsv($handle, ['information-technology', 'Information Technology', 'fas fa-laptop-code', 'Software development and IT services', 20, 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }
}
