<?php

namespace App\Http\Controllers\Admin;

use App\Models\CompanyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CompanyTypeController extends MasterResourceController
{
    protected string $modelClass = CompanyType::class;
    protected string $routeName = 'admin.company-types';
    protected string $resourceLabel = 'Company Type';
    protected string $resourcePlural = 'Company Types';
    protected string $indexSubtitle = 'Segment your employer directory by the organization types that matter to your users.';
    protected string $formSubtitle = 'Capture a friendly label, description, slug, and the sort order for each company type.';
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'Slug', 'field' => 'slug', 'sortable' => true],
        ['label' => 'Label', 'field' => 'label', 'sortable' => true],
        ['label' => 'Description', 'field' => 'description'],
        ['label' => 'Sort order', 'field' => 'sort_order', 'sortable' => true],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
    ];
    protected array $formFields = [
        ['name' => 'label', 'label' => 'Label', 'type' => 'text', 'required' => true],
        ['name' => 'slug', 'label' => 'Slug', 'type' => 'text', 'required' => true],
        ['name' => 'description', 'label' => 'Description', 'type' => 'textarea'],
        ['name' => 'sort_order', 'label' => 'Sort order', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $searchColumns = ['slug', 'label', 'description'];
    protected array $sortable = ['id', 'slug', 'label', 'sort_order', 'is_active'];
    protected array $bulkActions = [
        'sample' => [
            'label' => 'Download sample CSV',
            'route' => 'admin.company-types.sample',
            'description' => 'Copy the structure before importing more data.',
        ],
        'export' => [
            'label' => 'Export filtered list',
            'route' => 'admin.company-types.export',
            'description' => 'Download everything that matches the current filters.',
        ],
        'import' => [
            'label' => 'Import CSV',
            'route' => 'admin.company-types.import',
            'description' => 'Upload new or updated company types via CSV.',
        ],
    ];

    protected function rules(Model $record = null): array
    {
        $slugRule = Rule::unique('company_types', 'slug');

        if ($record) {
            $slugRule->ignore($record);
        }

        return [
            'label' => ['required', 'string', 'max:191'],
            'slug' => ['required', 'alpha_dash', 'max:191', $slugRule],
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
                'description' => $rowData['description'] ?? null,
                'sort_order' => $rowData['sort_order'] ?: 0,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            CompanyType::updateOrCreate(['slug' => $slug], $payload);
            $imported++;
        }

        return back()->with('status', "Imported {$imported} company types.");
    }

    public function export(Request $request)
    {
        $columns = ['slug', 'label', 'description', 'sort_order', 'is_active'];
        $filename = 'company-types-' . Carbon::now()->format('Y-m-d') . '.csv';

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
        $columns = ['slug', 'label', 'description', 'sort_order', 'is_active'];
        $filename = 'company-types-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['startup', 'Startup', 'Early-stage, high-growth companies.', 10, 1]);
            fputcsv($handle, ['enterprise', 'Enterprise', 'Large, established corporations.', 20, 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }
}
