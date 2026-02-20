<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DepartmentController extends MasterResourceController
{
    protected string $modelClass = Department::class;
    protected string $routeName = 'admin.departments';
    protected string $resourceLabel = 'Department';
    protected string $resourcePlural = 'Departments';
    protected string $indexSubtitle = 'Group the company into departments that power access controls.';
    protected string $formSubtitle = 'Give each department a slug, label, and sort order before toggling visibility.';
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'Label', 'field' => 'label', 'sortable' => true],
        ['label' => 'Slug', 'field' => 'slug', 'sortable' => true],
        ['label' => 'Sort order', 'field' => 'sort_order', 'sortable' => true],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
    ];
    protected array $formFields = [
        ['name' => 'label', 'label' => 'Label', 'type' => 'text', 'required' => true],
        ['name' => 'slug', 'label' => 'Slug', 'type' => 'text', 'required' => true],
        ['name' => 'sort_order', 'label' => 'Sort order', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $searchColumns = ['label', 'slug'];
    protected array $sortable = ['id', 'label', 'slug', 'sort_order', 'is_active'];
    protected array $bulkActions = [
        'sample' => [
            'label' => 'Download sample CSV',
            'route' => 'admin.departments.sample',
            'description' => 'Open the sample to match the expected columns.',
        ],
        'export' => [
            'label' => 'Export filtered list',
            'route' => 'admin.departments.export',
            'description' => 'Save the currently filtered departments.',
        ],
        'import' => [
            'label' => 'Import CSV',
            'route' => 'admin.departments.import',
            'description' => 'Upload a CSV to bulk add or update departments.',
        ],
    ];

    protected function rules(Model $record = null): array
    {
        $slugRule = Rule::unique('departments', 'slug');

        if ($record) {
            $slugRule->ignore($record);
        }

        return [
            'label' => ['required', 'string', 'max:191'],
            'slug' => ['required', 'alpha_dash', 'max:191', $slugRule],
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
                'sort_order' => $rowData['sort_order'] ?: null,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            Department::updateOrCreate(['slug' => $slug], $payload);
            $imported++;
        }

        return back()->with('status', "Imported {$imported} departments.");
    }

    public function export(Request $request)
    {
        $columns = ['slug', 'label', 'sort_order', 'is_active'];
        $filename = 'departments-' . Carbon::now()->format('Y-m-d') . '.csv';

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
        $columns = ['slug', 'label', 'sort_order', 'is_active'];
        $filename = 'departments-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['hr', 'Human Resources', 1, 1]);
            fputcsv($handle, ['ops', 'Operations', 2, 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }
}
