<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CountryController extends MasterResourceController
{
    protected string $modelClass = Country::class;
    protected string $routeName = 'admin.countries';
    protected string $resourceLabel = 'Country';
    protected string $resourcePlural = 'Countries';
    protected string $indexSubtitle = 'Manage the list of countries available across the platform.';
    protected string $formSubtitle = 'Add the ISO codes, coordinates, and activation state for each country.';
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'Slug', 'field' => 'slug', 'sortable' => true],
        ['label' => 'Name', 'field' => 'name', 'sortable' => true],
        ['label' => 'ISO', 'field' => 'iso_code', 'sortable' => true],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
    ];
    protected array $detailColumns = [
        ['label' => 'Slug', 'field' => 'slug'],
        ['label' => 'Name', 'field' => 'name'],
        ['label' => 'ISO Code', 'field' => 'iso_code'],
        ['label' => 'Phone code', 'field' => 'phone_code'],
        ['label' => 'Latitude', 'field' => 'latitude'],
        ['label' => 'Longitude', 'field' => 'longitude'],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean'],
    ];
    protected array $formFields = [
        ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true],
        ['name' => 'slug', 'label' => 'Slug', 'type' => 'text', 'required' => true],
        ['name' => 'iso_code', 'label' => 'ISO Code', 'type' => 'text', 'required' => true, 'attributes' => ['maxlength' => 5]],
        ['name' => 'phone_code', 'label' => 'Phone Code', 'type' => 'text'],
        ['name' => 'latitude', 'label' => 'Latitude', 'type' => 'number', 'attributes' => ['step' => '0.000001']],
        ['name' => 'longitude', 'label' => 'Longitude', 'type' => 'number', 'attributes' => ['step' => '0.000001']],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $searchColumns = ['name', 'slug', 'iso_code'];
    protected array $sortable = ['id', 'slug', 'name', 'iso_code', 'is_active'];
    protected array $bulkActions = [
        'sample' => [
            'label' => 'Download sample CSV',
            'route' => 'admin.countries.sample',
            'description' => 'See the required fields before importing.',
        ],
        'export' => [
            'label' => 'Export filtered list',
            'route' => 'admin.countries.export',
            'description' => 'Download whatever is currently filtered above.',
        ],
        'import' => [
            'label' => 'Import CSV',
            'route' => 'admin.countries.import',
            'description' => 'Upload a CSV to bulk create or update countries.',
        ],
    ];

    protected function rules(Model $record = null): array
    {
        $slugRule = Rule::unique('countries', 'slug');
        $isoRule = Rule::unique('countries', 'iso_code');

        if ($record) {
            $slugRule->ignore($record);
            $isoRule->ignore($record);
        }

        return [
            'name' => ['required', 'string', 'max:191'],
            'slug' => ['required', 'alpha_dash', 'max:191', $slugRule],
            'iso_code' => ['required', 'alpha_dash', 'max:5', $isoRule],
            'phone_code' => ['nullable', 'string', 'max:10'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
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
                'iso_code' => $rowData['iso_code'] ?? null,
                'phone_code' => $rowData['phone_code'] ?? null,
                'latitude' => $rowData['latitude'] ?: null,
                'longitude' => $rowData['longitude'] ?: null,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            Country::updateOrCreate(['slug' => $slug], $payload);
            $imported++;
        }

        return back()->with('status', "Imported {$imported} countries.");
    }

    public function export(Request $request)
    {
        $columns = ['slug', 'name', 'iso_code', 'phone_code', 'latitude', 'longitude', 'is_active'];
        $filename = 'countries-' . Carbon::now()->format('Y-m-d') . '.csv';

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
        $columns = ['slug', 'name', 'iso_code', 'phone_code', 'latitude', 'longitude', 'is_active'];
        $filename = 'countries-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['united-states', 'United States', 'US', '1', '38.9072', '-77.0369', 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }
}
