<?php

namespace App\Http\Controllers\Admin;

use App\Models\CompanySize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CompanySizeController extends MasterResourceController
{
    protected string $modelClass = CompanySize::class;
    protected string $routeName = 'admin.company-sizes';
    protected string $resourceLabel = 'Company Size';
    protected string $resourcePlural = 'Company Sizes';
    protected string $indexSubtitle = 'Control the company-size catalog that powers search filters and reporting.';
    protected string $formSubtitle = 'Provide a slug, label, employee range, and ordering for each company size bucket.';
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'Slug', 'field' => 'slug', 'sortable' => true],
        ['label' => 'Label', 'field' => 'label', 'sortable' => true],
        ['label' => 'Min employees', 'field' => 'min_employees', 'align' => 'right'],
        ['label' => 'Max employees', 'field' => 'max_employees', 'align' => 'right'],
        ['label' => 'Sort order', 'field' => 'sort_order', 'sortable' => true],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
    ];
    protected array $formFields = [
        ['name' => 'label', 'label' => 'Label', 'type' => 'text', 'required' => true],
        ['name' => 'slug', 'label' => 'Slug', 'type' => 'text', 'required' => true],
        ['name' => 'min_employees', 'label' => 'Min employees', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'max_employees', 'label' => 'Max employees', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'sort_order', 'label' => 'Sort order', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $searchColumns = ['slug', 'label'];
    protected array $sortable = ['id', 'slug', 'label', 'min_employees', 'max_employees', 'sort_order', 'is_active'];
    protected array $bulkActions = [
        'sample' => [
            'label' => 'Download sample CSV',
            'route' => 'admin.company-sizes.sample',
            'description' => 'Use the template to ensure imports include ranges and statuses.',
        ],
        'export' => [
            'label' => 'Export filtered list',
            'route' => 'admin.company-sizes.export',
            'description' => 'Download only the buckets that match your filters.',
        ],
        'import' => [
            'label' => 'Import CSV',
            'route' => 'admin.company-sizes.import',
            'description' => 'Upload or update company sizes via CSV.',
        ],
    ];

    protected function rules(Model $record = null): array
    {
        $slugRule = Rule::unique('company_sizes', 'slug');

        if ($record) {
            $slugRule->ignore($record);
        }

        return [
            'label' => ['required', 'string', 'max:191'],
            'slug' => ['required', 'alpha_dash', 'max:191', $slugRule],
            'min_employees' => ['nullable', 'integer', 'min:0'],
            'max_employees' => ['nullable', 'integer', 'min:0'],
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
                'min_employees' => isset($rowData['min_employees']) ? (int) $rowData['min_employees'] : null,
                'max_employees' => isset($rowData['max_employees']) ? (int) $rowData['max_employees'] : null,
                'sort_order' => $rowData['sort_order'] ?: 0,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            CompanySize::updateOrCreate(['slug' => $slug], $payload);
            $imported++;
        }

        return back()->with('status', "Imported {$imported} company sizes.");
    }

    public function export(Request $request)
    {
        $columns = ['slug', 'label', 'min_employees', 'max_employees', 'sort_order', 'is_active'];
        $filename = 'company-sizes-' . Carbon::now()->format('Y-m-d') . '.csv';

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
        $columns = ['slug', 'label', 'min_employees', 'max_employees', 'sort_order', 'is_active'];
        $filename = 'company-sizes-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['micro', 'Micro (1-10)', 1, 10, 10, 1]);
            fputcsv($handle, ['enterprise', 'Enterprise (500+)', 500, null, 20, 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }
}
