<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CityController extends MasterResourceController
{
    protected string $modelClass = City::class;
    protected string $routeName = 'admin.cities';
    protected string $resourceLabel = 'City';
    protected string $resourcePlural = 'Cities';
    protected string $indexSubtitle = 'Keep cities tied to the right state and expose their coordinates.';
    protected string $formSubtitle = 'Select a state first, then fill in the city-level details.';
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'State', 'field' => 'state.name'],
        ['label' => 'Slug', 'field' => 'slug', 'sortable' => true],
        ['label' => 'Name', 'field' => 'name', 'sortable' => true],
        ['label' => 'Latitude', 'field' => 'latitude'],
        ['label' => 'Longitude', 'field' => 'longitude'],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
    ];
    protected array $detailColumns = [
        ['label' => 'State', 'field' => 'state.name'],
        ['label' => 'Slug', 'field' => 'slug'],
        ['label' => 'Name', 'field' => 'name'],
        ['label' => 'Latitude', 'field' => 'latitude'],
        ['label' => 'Longitude', 'field' => 'longitude'],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean'],
    ];
    protected array $formFields = [
        ['name' => 'state_id', 'label' => 'State', 'type' => 'select', 'required' => true],
        ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true],
        ['name' => 'slug', 'label' => 'Slug', 'type' => 'text', 'required' => true],
        ['name' => 'latitude', 'label' => 'Latitude', 'type' => 'number', 'attributes' => ['step' => '0.000001']],
        ['name' => 'longitude', 'label' => 'Longitude', 'type' => 'number', 'attributes' => ['step' => '0.000001']],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $searchColumns = ['name', 'slug'];
    protected array $sortable = ['id', 'name', 'slug', 'is_active'];
    protected array $with = ['state'];
    protected array $bulkActions = [
        'sample' => [
            'label' => 'Download sample CSV',
            'route' => 'admin.cities.sample',
            'description' => 'See the required fields before importing.',
        ],
        'export' => [
            'label' => 'Export filtered list',
            'route' => 'admin.cities.export',
            'description' => 'Download the current filters for cities.',
        ],
        'import' => [
            'label' => 'Import CSV',
            'route' => 'admin.cities.import',
            'description' => 'Upload a CSV to bulk add or update cities.',
        ],
    ];

    protected function rules(Model $record = null): array
    {
        $slugRule = Rule::unique('cities', 'slug');

        if ($record) {
            $slugRule->ignore($record);
        }

        return [
            'state_id' => ['required', 'exists:states,id'],
            'name' => ['required', 'string', 'max:191'],
            'slug' => ['required', 'alpha_dash', 'max:191', $slugRule],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    protected function getSelectOptions(?Model $record): array
    {
        return [
            'state_id' => State::orderBy('name')->pluck('name', 'id')->toArray(),
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

            $state = $this->resolveState($rowData);
            if (!$state) {
                continue;
            }

            $slug = Str::slug($rowData['slug'] ?? $rowData['name'] ?? '');
            if (!$slug) {
                continue;
            }

            $payload = [
                'state_id' => $state->id,
                'name' => $rowData['name'] ?? Str::of($slug)->replace('-', ' ')->title()->toString(),
                'slug' => $slug,
                'latitude' => $rowData['latitude'] ?: null,
                'longitude' => $rowData['longitude'] ?: null,
                'is_active' => filter_var($rowData['is_active'] ?? '1', FILTER_VALIDATE_BOOLEAN),
            ];

            City::updateOrCreate(['slug' => $slug], $payload);
            $imported++;
        }

        return back()->with('status', "Imported {$imported} cities.");
    }

    public function export(Request $request)
    {
        $columns = ['slug', 'name', 'state_slug', 'latitude', 'longitude', 'is_active'];
        $filename = 'cities-' . Carbon::now()->format('Y-m-d') . '.csv';

        $callback = function () use ($columns, $request) {
            $records = $this->buildQuery($request)->with('state')->get();
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            foreach ($records as $record) {
                $row = [];
                foreach ($columns as $column) {
                    $value = $column === 'state_slug'
                        ? $record->state?->slug
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
        $columns = ['slug', 'name', 'state_slug', 'latitude', 'longitude', 'is_active'];
        $filename = 'cities-sample.csv';

        $callback = function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);
            fputcsv($handle, ['los-angeles', 'Los Angeles', 'california', '34.0522', '-118.2437', 1]);
            fclose($handle);
        };

        return response()->streamDownload($callback, $filename, ['Content-Type' => 'text/csv']);
    }

    private function resolveState(array $rowData): ?State
    {
        $identifier = $rowData['state_slug'] ?? $rowData['state'] ?? null;
        if (!$identifier) {
            return null;
        }

        $query = State::query();
        $query->where(function ($builder) use ($identifier) {
            $builder->where('slug', $identifier)
                ->orWhere('code', $identifier)
                ->orWhere('name', $identifier);
        });

        return $query->first();
    }
}
