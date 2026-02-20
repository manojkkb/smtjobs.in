<?php

namespace App\Http\Controllers\Admin;

use App\Models\ApplicationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ApplicationStatusController extends MasterResourceController
{
    protected string $modelClass = ApplicationStatus::class;
    protected string $routeName = 'admin.application-statuses';
    protected string $resourceLabel = 'Application Status';
    protected string $resourcePlural = 'Application Statuses';
    protected string $indexSubtitle = 'Define every step an application can go through.';
    protected string $formSubtitle = 'Keep each status in the proper order before toggling it on.';
    protected array $tableColumns = [
        ['label' => 'Slug', 'field' => 'slug', 'sortable' => true],
        ['label' => 'Sort order', 'field' => 'sort_order', 'sortable' => true],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
    ];
    protected array $formFields = [
        ['name' => 'slug', 'label' => 'Slug', 'type' => 'text', 'required' => true],
        ['name' => 'sort_order', 'label' => 'Sort order', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $searchColumns = ['slug'];
    protected array $sortable = ['slug', 'sort_order', 'is_active'];
    protected array $bulkActions = [
        'sample' => [
            'label' => 'Download sample CSV',
            'route' => 'admin.application-statuses.sample',
            'description' => 'See the required fields before importing.',
        ],
        'export' => [
            'label' => 'Export filtered list',
            'route' => 'admin.application-statuses.export',
            'description' => 'Download the current filter for application statuses.',
        ],
        'import' => [
            'label' => 'Import CSV',
            'route' => 'admin.application-statuses.import',
            'description' => 'Upload a CSV to bulk add or update application statuses.',
        ],
    ];

    protected function rules(Model $record = null): array
    {
        $slugRule = Rule::unique('application_statuses', 'slug');

        if ($record) {
            $slugRule->ignore($record);
        }

        return [
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

            $slug = Str::slug($rowData['slug'] ?? '');
            if (!$slug) {
                continue;
            }

            $payload = [
                'slug' => $slug,
                'sort_order' => $rowData['sort_order'] ?: null,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            ApplicationStatus::updateOrCreate(['slug' => $slug], $payload);
            $imported++;
        }

        return back()->with('status', "Imported {$imported} application statuses.");
    }

    public function export(Request $request)
    {
        $columns = ['slug', 'sort_order', 'is_active'];
        $filename = 'application-statuses-' . Carbon::now()->format('Y-m-d') . '.csv';

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
        $columns = ['slug', 'sort_order', 'is_active'];
        $filename = 'application-statuses-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['screening', 1, 1]);
            fputcsv($handle, ['approved', 2, 1]);
            fputcsv($handle, ['rejected', 3, 0]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }
}
