<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StateController extends MasterResourceController
{
    protected string $modelClass = State::class;
    protected string $routeName = 'admin.states';
    protected string $resourceLabel = 'State';
    protected string $resourcePlural = 'States';
    protected string $indexSubtitle = 'Associate every state with a country and keep geographic data current.';
    protected string $formSubtitle = 'Select the parent country before filling in the state details.';
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'Country', 'field' => 'country.name'],
        ['label' => 'Slug', 'field' => 'slug', 'sortable' => true],
        ['label' => 'Name', 'field' => 'name', 'sortable' => true],
        ['label' => 'Code', 'field' => 'code', 'sortable' => true],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
    ];
    protected array $detailColumns = [
        ['label' => 'Country', 'field' => 'country.name'],
        ['label' => 'Slug', 'field' => 'slug'],
        ['label' => 'Name', 'field' => 'name'],
        ['label' => 'Code', 'field' => 'code'],
        ['label' => 'Latitude', 'field' => 'latitude'],
        ['label' => 'Longitude', 'field' => 'longitude'],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean'],
    ];
    protected array $formFields = [
        ['name' => 'country_id', 'label' => 'Country', 'type' => 'select', 'required' => true],
        ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true],
        ['name' => 'slug', 'label' => 'Slug', 'type' => 'text', 'required' => true],
        ['name' => 'code', 'label' => 'Code', 'type' => 'text'],
        ['name' => 'latitude', 'label' => 'Latitude', 'type' => 'number', 'attributes' => ['step' => '0.000001']],
        ['name' => 'longitude', 'label' => 'Longitude', 'type' => 'number', 'attributes' => ['step' => '0.000001']],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $searchColumns = ['name', 'slug', 'code'];
    protected array $sortable = ['id', 'name', 'slug', 'code', 'is_active'];
    protected array $with = ['country'];
    protected array $bulkActions = [
        'sample' => [
            'label' => 'Download sample CSV',
            'route' => 'admin.states.sample',
            'description' => 'See the required columns before importing.',
        ],
        'export' => [
            'label' => 'Export filtered list',
            'route' => 'admin.states.export',
            'description' => 'Download the current filter of states.',
        ],
        'import' => [
            'label' => 'Import CSV',
            'route' => 'admin.states.import',
            'description' => 'Upload a CSV to bulk add or update states.',
        ],
    ];

    protected function rules(Model $record = null): array
    {
        $slugRule = Rule::unique('states', 'slug');

        if ($record) {
            $slugRule->ignore($record);
        }

        return [
            'country_id' => ['required', 'exists:countries,id'],
            'name' => ['required', 'string', 'max:191'],
            'slug' => ['required', 'alpha_dash', 'max:191', $slugRule],
            'code' => ['nullable', 'string', 'max:20'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    protected function getSelectOptions(?Model $record): array
    {
        return [
            'country_id' => Country::orderBy('name')->pluck('name', 'id')->toArray(),
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

            $country = $this->resolveCountry($rowData);
            if (!$country) {
                continue;
            }

            $slug = Str::slug($rowData['slug'] ?? $rowData['name'] ?? '');
            if (!$slug) {
                continue;
            }

            $payload = [
                'country_id' => $country->id,
                'name' => $rowData['name'] ?? Str::of($slug)->replace('-', ' ')->title()->toString(),
                'slug' => $slug,
                'code' => $rowData['code'] ?? null,
                'latitude' => $rowData['latitude'] ?: null,
                'longitude' => $rowData['longitude'] ?: null,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            State::updateOrCreate(['slug' => $slug], $payload);
            $imported++;
        }

        return back()->with('status', "Imported {$imported} states.");
    }

    public function export(Request $request)
    {
        $columns = ['slug', 'name', 'code', 'country_slug', 'latitude', 'longitude', 'is_active'];
        $filename = 'states-' . Carbon::now()->format('Y-m-d') . '.csv';

        $callback = function () use ($columns, $request) {
            $records = $this->buildQuery($request)->with('country')->get();
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            foreach ($records as $record) {
                $row = [];
                foreach ($columns as $column) {
                    $value = $column === 'country_slug'
                        ? $record->country?->slug
                        : $record->{$column};
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
        $columns = ['slug', 'name', 'code', 'country_slug', 'latitude', 'longitude', 'is_active'];
        $filename = 'states-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['california', 'California', 'CA', 'united-states', '36.7783', '-119.4179', 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }

    private function resolveCountry(array $rowData): ?Country
    {
        $identifier = $rowData['country_slug'] ?? $rowData['country'] ?? null;
        if (!$identifier) {
            return null;
        }

        $query = Country::query();
        $query->where(function ($builder) use ($identifier) {
            $builder->where('slug', $identifier)
                ->orWhere('iso_code', $identifier)
                ->orWhere('name', $identifier);
        });

        return $query->first();
    }
}
