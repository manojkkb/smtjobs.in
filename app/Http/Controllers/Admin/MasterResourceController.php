<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class MasterResourceController extends Controller
{
    protected string $modelClass;
    protected string $routeName;
    protected string $resourceLabel;
    protected string $resourcePlural;
    protected string $indexSubtitle = '';
    protected string $formSubtitle = '';
    protected array $tableColumns = [];
    protected array $detailColumns = [];
    protected array $formFields = [];
    protected array $searchColumns = ['slug', 'name'];
    protected array $sortable = ['id', 'name', 'slug', 'sort_order', 'is_active'];
    protected array $booleanFields = ['is_active'];
    protected array $with = [];
    protected array $bulkActions = [];

    public function index(Request $request)
    {
        $records = $this->buildQuery($request)
            ->with($this->with)
            ->paginate(15)
            ->withQueryString();

        return view('admin.master.index', array_merge($this->baseIndexData(), [
            'records' => $records,
            'tableColumns' => $this->tableColumns,
            'routeName' => $this->routeName,
            'title' => $this->resourcePlural,
            'subtitle' => $this->indexSubtitle,
            'createLabel' => 'New ' . $this->resourceLabel,
            'bulkActions' => $this->getBulkActions(),
        ]));
    }

    public function create()
    {
        return view('admin.master.form', array_merge($this->baseFormData(null), [
            'pageTitle' => 'Create ' . $this->resourceLabel,
            'subtitle' => $this->formSubtitle ?: 'Capture the required fields for this resource.',
            'submitLabel' => 'Create ' . $this->resourceLabel,
        ]));
    }

    public function store(Request $request)
    {
        $this->ensureSlug($request);
        $data = $request->validate($this->rules());
        $payload = $this->preparePayload($data, $request);
        ($this->modelClass)::create($payload);

        return redirect()
            ->route($this->routeName . '.index')
            ->with('status', "{$this->resourceLabel} created successfully.");
    }

    public function show($record)
    {
        $record = $this->resolveRecord($record);

        return view('admin.master.show', array_merge($this->baseShowData($record), [
            'pageTitle' => $this->resourceLabel . ' Details',
            'subtitle' => $this->indexSubtitle,
        ]));
    }

    public function edit($record)
    {
        $record = $this->resolveRecord($record);

        return view('admin.master.form', array_merge($this->baseFormData($record), [
            'pageTitle' => 'Edit ' . $this->resourceLabel,
            'subtitle' => $this->formSubtitle ?: 'Update the fields for this resource.',
            'submitLabel' => 'Update ' . $this->resourceLabel,
        ]));
    }

    public function update(Request $request, $record)
    {
        $this->ensureSlug($request);
        $record = $this->resolveRecord($record);
        $data = $request->validate($this->rules($record));
        $payload = $this->preparePayload($data, $request);
        $record->update($payload);

        return redirect()
            ->route($this->routeName . '.index')
            ->with('status', "{$this->resourceLabel} updated successfully.");
    }

    public function destroy($record)
    {
        $record = $this->resolveRecord($record);
        $record->delete();

        return redirect()
            ->route($this->routeName . '.index')
            ->with('status', "{$this->resourceLabel} deleted.");
    }

    abstract protected function rules(Model $record = null): array;

    protected function ensureSlug(Request $request): void
    {
        if ($request->filled('slug')) {
            return;
        }

        if ($request->filled('name')) {
            $request->merge(['slug' => Str::slug($request->input('name'))]);
        }

        if (!$request->filled('slug') && $request->filled('label')) {
            $request->merge(['slug' => Str::slug($request->input('label'))]);
        }
    }

    protected function preparePayload(array $data, Request $request): array
    {
        foreach ($this->booleanFields as $field) {
            if (array_key_exists($field, $data)) {
                $data[$field] = $request->boolean($field, $data[$field]);
            } else {
                $data[$field] = $request->boolean($field);
            }
        }

        if (array_key_exists('sort_order', $data)) {
            $data['sort_order'] = $data['sort_order'] ?? 0;
        }

        return $data;
    }

    protected function buildQuery(Request $request): Builder
    {
        $query = ($this->modelClass)::query();

        if ($search = $request->input('search')) {
            $query->where(function (Builder $builder) use ($search) {
                foreach ($this->searchColumns as $column) {
                    $builder->orWhere($column, 'like', "%{$search}%");
                }
            });
        }

        if ($status = $request->input('status')) {
            $query->where('is_active', $status === 'active');
        }

        $sort = in_array($request->input('sort'), $this->sortable, true)
            ? $request->input('sort')
            : ($this->sortable[0] ?? 'id');

        $direction = $request->input('direction') === 'asc' ? 'asc' : 'desc';

        return $query->orderBy($sort, $direction);
    }

    protected function baseIndexData(): array
    {
        return [
            'resourceLabel' => $this->resourceLabel,
            'resourcePlural' => $this->resourcePlural,
        ];
    }

    protected function getBulkActions(): array
    {
        return property_exists($this, 'bulkActions') ? $this->bulkActions : [];
    }

    protected function baseFormData(?Model $record): array
    {
        $route = $record
            ? route($this->routeName . '.update', $record)
            : route($this->routeName . '.store');

        return [
            'formAction' => $route,
            'formMethod' => $record ? 'PUT' : 'POST',
            'backRoute' => route($this->routeName . '.index'),
            'backLabel' => 'Back to ' . $this->resourcePlural,
            'record' => $record,
            'formFields' => $this->formFields,
            'selectOptions' => $this->getSelectOptions($record),
            'routeName' => $this->routeName,
            'resourcePlural' => $this->resourcePlural,
        ];
    }

    protected function baseShowData(Model $record): array
    {
        return [
            'record' => $record,
            'routeName' => $this->routeName,
            'detailRows' => $this->getDetailRows($record),
            'backRoute' => route($this->routeName . '.index'),
            'backLabel' => 'Back to ' . $this->resourcePlural,
            'resourcePlural' => $this->resourcePlural,
            'subtitle' => $this->indexSubtitle,
        ];
    }

    protected function resolveRecord(Model|string|int $record): Model
    {
        if ($record instanceof Model) {
            return $record;
        }

        return ($this->modelClass)::findOrFail($record);
    }

    protected function getSelectOptions(?Model $record): array
    {
        return [];
    }

    protected function getDetailRows(Model $record): array
    {
        $columns = $this->detailColumns ?: $this->tableColumns;

        return array_map(fn ($column) => [
            'label' => $column['label'],
            'value' => $this->formatDetailValue($record, $column),
            'type' => $column['type'] ?? null,
            'raw_value' => data_get($record, $column['field'] ?? ''),
        ], $columns);
    }

    protected function formatDetailValue(Model $record, array $column): string
    {
        $value = data_get($record, $column['field'] ?? '');

        if ($column['type'] ?? null === 'boolean') {
            return $value ? 'Active' : 'Inactive';
        }

        if (is_null($value) || $value === '') {
            return '—';
        }

        return (string) $value;
    }
}
