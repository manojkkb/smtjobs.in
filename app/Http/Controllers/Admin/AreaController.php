<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AreaController extends MasterResourceController
{
    protected string $modelClass = Area::class;
    protected string $routeName = 'admin.areas';
    protected string $resourceLabel = 'Area';
    protected string $resourcePlural = 'Areas';
    protected string $indexSubtitle = 'Manage postal areas that sit within cities and states.';
    protected string $formSubtitle = 'Choose a city before describing the tight neighborhoods you need to track.';
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'City', 'field' => 'city.name'],
        ['label' => 'State', 'field' => 'city.state.name'],
        ['label' => 'Slug', 'field' => 'slug', 'sortable' => true],
        ['label' => 'Name', 'field' => 'name', 'sortable' => true],
        ['label' => 'Postal code', 'field' => 'postal_code'],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
    ];
    protected array $detailColumns = [
        ['label' => 'City', 'field' => 'city.name'],
        ['label' => 'State', 'field' => 'city.state.name'],
        ['label' => 'Slug', 'field' => 'slug'],
        ['label' => 'Name', 'field' => 'name'],
        ['label' => 'Postal code', 'field' => 'postal_code'],
        ['label' => 'Latitude', 'field' => 'latitude'],
        ['label' => 'Longitude', 'field' => 'longitude'],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean'],
    ];
    protected array $formFields = [
        ['name' => 'city_id', 'label' => 'City', 'type' => 'select', 'required' => true],
        ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true],
        ['name' => 'slug', 'label' => 'Slug', 'type' => 'text', 'required' => true],
        ['name' => 'postal_code', 'label' => 'Postal Code', 'type' => 'text'],
        ['name' => 'latitude', 'label' => 'Latitude', 'type' => 'number', 'attributes' => ['step' => '0.000001']],
        ['name' => 'longitude', 'label' => 'Longitude', 'type' => 'number', 'attributes' => ['step' => '0.000001']],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $searchColumns = ['name', 'slug', 'postal_code'];
    protected array $sortable = ['id', 'name', 'slug', 'postal_code', 'is_active'];
    protected array $with = ['city', 'city.state'];
    protected array $bulkActions = [
        'sample' => [
            'label' => 'Download sample CSV',
            'route' => 'admin.areas.sample',
            'description' => 'Review the column layout before importing.',
        ],
        'export' => [
            'label' => 'Export filtered list',
            'route' => 'admin.areas.export',
            'description' => 'Save the current filter for areas.',
        ],
        'import' => [
            'label' => 'Import CSV',
            'route' => 'admin.areas.import',
            'description' => 'Upload a CSV to bulk add or update areas.',
        ],
    ];

    protected function rules(Model $record = null): array
    {
        $slugRule = Rule::unique('areas', 'slug');

        if ($record) {
            $slugRule->ignore($record);
        }

        return [
            'city_id' => ['required', 'exists:cities,id'],
            'name' => ['required', 'string', 'max:191'],
            'slug' => ['required', 'alpha_dash', 'max:191', $slugRule],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
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

            $cityId = array_key_exists('city_id', $rowData) ? (int) $rowData['city_id'] : 0;
            if (!$cityId || !City::find($cityId)) {
                continue;
            }

            $name = trim($rowData['name'] ?? '');
            if ($name === '') {
                continue;
            }

            $slug = Str::slug($rowData['slug'] ?? $name);
            if (!$slug) {
                continue;
            }

            $payload = [
                'city_id' => $cityId,
                'name' => $name,
                'slug' => $slug,
                'postal_code' => $rowData['postal_code'] ?: null,
                'latitude' => is_numeric($rowData['latitude'] ?? null) ? (float) $rowData['latitude'] : null,
                'longitude' => is_numeric($rowData['longitude'] ?? null) ? (float) $rowData['longitude'] : null,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            Area::updateOrCreate(['slug' => $slug], $payload);
            $imported++;
        }

        return back()->with('status', "Imported {$imported} areas.");
    }

    public function export(Request $request)
    {
        $columns = ['city_id', 'name', 'slug', 'postal_code', 'latitude', 'longitude', 'is_active'];
        $filename = 'areas-' . Carbon::now()->format('Y-m-d') . '.csv';

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
        $columns = ['city_id', 'name', 'slug', 'postal_code', 'latitude', 'longitude', 'is_active'];
        $filename = 'areas-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, [1, 'Downtown', 'downtown', '1001', '12.345678', '98.765432', 1]);
            fputcsv($handle, [1, 'Portside', 'portside', '1002', '12.345000', '98.770000', 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }

    protected function getSelectOptions(?Model $record): array
    {
        return [
            'city_id' => City::orderBy('name')->pluck('name', 'id')->toArray(),
        ];
    }
}
