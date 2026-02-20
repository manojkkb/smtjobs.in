<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LanguageController extends MasterResourceController
{
    protected string $modelClass = Language::class;
    protected string $routeName = 'admin.languages';
    protected string $resourceLabel = 'Language';
    protected string $resourcePlural = 'Languages';
    protected string $indexSubtitle = 'Track every language, its ISO code, and ordering preferences.';
    protected string $formSubtitle = 'Capture native names and directionality for each language.';
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'Name', 'field' => 'name', 'sortable' => true],
        ['label' => 'ISO', 'field' => 'iso_code', 'sortable' => true],
        ['label' => 'Default', 'field' => 'is_default', 'type' => 'boolean', 'sortable' => true],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
        ['label' => 'Sort order', 'field' => 'sort_order', 'sortable' => true],
    ];
    protected array $formFields = [
        ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true],
        ['name' => 'native_name', 'label' => 'Native name', 'type' => 'text'],
        ['name' => 'iso_code', 'label' => 'ISO Code', 'type' => 'text', 'required' => true],
        ['name' => 'is_rtl', 'label' => 'Right to left text', 'type' => 'checkbox'],
        ['name' => 'is_default', 'label' => 'Default language', 'type' => 'checkbox'],
        ['name' => 'sort_order', 'label' => 'Sort order', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $searchColumns = ['name', 'iso_code', 'native_name'];
    protected array $sortable = ['id', 'name', 'iso_code', 'sort_order', 'is_active'];
    protected array $bulkActions = [
        'sample' => [
            'label' => 'Download sample CSV',
            'route' => 'admin.languages.sample',
            'description' => 'See the required fields before importing.',
        ],
        'export' => [
            'label' => 'Export filtered list',
            'route' => 'admin.languages.export',
            'description' => 'Download the current filters for languages.',
        ],
        'import' => [
            'label' => 'Import CSV',
            'route' => 'admin.languages.import',
            'description' => 'Upload a CSV to bulk add or update languages.',
        ],
    ];

    protected function rules(Model $record = null): array
    {
        $isoRule = Rule::unique('languages', 'iso_code');

        if ($record) {
            $isoRule->ignore($record);
        }

        return [
            'name' => ['required', 'string', 'max:191'],
            'native_name' => ['nullable', 'string', 'max:191'],
            'iso_code' => ['required', 'alpha_dash', 'max:10', $isoRule],
            'is_rtl' => ['nullable', 'boolean'],
            'is_default' => ['nullable', 'boolean'],
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

            $slug = Str::slug($rowData['slug'] ?? $rowData['name'] ?? '');
            if (!$slug) {
                continue;
            }

            $payload = [
                'slug' => $slug,
                'name' => $rowData['name'] ?? Str::of($slug)->replace('-', ' ')->title()->toString(),
                'native_name' => $rowData['native_name'] ?? null,
                'iso_code' => $rowData['iso_code'] ?? null,
                'is_rtl' => filter_var($rowData['is_rtl'] ?? '0', FILTER_VALIDATE_BOOLEAN),
                'is_default' => filter_var($rowData['is_default'] ?? '0', FILTER_VALIDATE_BOOLEAN),
                'sort_order' => $rowData['sort_order'] ?: null,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            Language::updateOrCreate(['slug' => $slug], $payload);
            $imported++;
        }

        return back()->with('status', "Imported {$imported} languages.");
    }

    public function export(Request $request)
    {
        $columns = ['slug', 'name', 'native_name', 'iso_code', 'is_rtl', 'is_default', 'sort_order', 'is_active'];
        $filename = 'languages-' . Carbon::now()->format('Y-m-d') . '.csv';

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
        $columns = ['slug', 'name', 'native_name', 'iso_code', 'is_rtl', 'is_default', 'sort_order', 'is_active'];
        $filename = 'languages-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['english', 'English', 'English', 'en', 0, 1, 1, 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }
}
