<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserStatusController extends MasterResourceController
{
    protected string $modelClass = UserStatus::class;
    protected string $routeName = 'admin.user-statuses';
    protected string $resourceLabel = 'User Status';
    protected string $resourcePlural = 'User Statuses';
    protected string $indexSubtitle = 'Control the master list of user visibility states used across the system.';
    protected string $formSubtitle = 'Give each status a slug and ordering position before activating it.';
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
            'route' => 'admin.user-statuses.sample',
            'description' => 'See the required fields before importing.',
        ],
        'export' => [
            'label' => 'Export filtered list',
            'route' => 'admin.user-statuses.export',
            'description' => 'Download the current filter of statuses.',
        ],
        'import' => [
            'label' => 'Import CSV',
            'route' => 'admin.user-statuses.import',
            'description' => 'Upload a CSV to bulk create or update statuses.',
        ],
    ];

    protected function rules(Model $record = null): array
    {
        $slugRule = Rule::unique('user_statuses', 'slug');

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

            $slug = Str::slug($rowData['slug'] ?? $rowData['label'] ?? '');
            if (!$slug) {
                continue;
            }

            $payload = [
                'slug' => $slug,
                'sort_order' => $rowData['sort_order'] ?: null,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            UserStatus::updateOrCreate(['slug' => $slug], $payload);
            $imported++;
        }

        return back()->with('status', "Imported {$imported} user statuses.");
    }

    public function export(Request $request)
    {
        $columns = ['slug', 'sort_order', 'is_active'];
        $filename = 'user-statuses-' . Carbon::now()->format('Y-m-d') . '.csv';

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
        $filename = 'user-statuses-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['active', 1, 1]);
            fputcsv($handle, ['inactive', 2, 0]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }
}
