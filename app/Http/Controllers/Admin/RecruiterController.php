<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\Recruiter;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RecruiterController extends MasterResourceController
{
    protected string $modelClass = Recruiter::class;
    protected string $routeName = 'admin.recruiters';
    protected string $resourceLabel = 'Recruiter';
    protected string $resourcePlural = 'Recruiters';
    protected string $indexSubtitle = 'Operate the network of company recruiters visible to your teams.';
    protected string $formSubtitle = 'Assign roles, companies, and availability metadata for each recruiter account.';
    protected array $with = ['user', 'company'];
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'User', 'field' => 'user.name'],
        ['label' => 'Company', 'field' => 'company.name'],
        ['label' => 'Role', 'field' => 'role'],
        ['label' => 'Verified', 'field' => 'is_verified', 'type' => 'boolean', 'sortable' => true],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
        ['label' => 'Last active', 'field' => 'last_active_at', 'sortable' => true],
    ];
    protected array $formFields = [
        ['name' => 'user_id', 'label' => 'User', 'type' => 'select', 'required' => true],
        ['name' => 'company_id', 'label' => 'Company', 'type' => 'select', 'required' => true],
        ['name' => 'role', 'label' => 'Role', 'type' => 'text'],
        ['name' => 'is_verified', 'label' => 'Verified', 'type' => 'checkbox'],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
        ['name' => 'last_active_at', 'label' => 'Last active', 'type' => 'datetime-local'],
    ];
    protected array $sortable = ['id', 'role', 'last_active_at'];
    protected array $booleanFields = ['is_verified', 'is_active'];

    protected function rules(Model $record = null): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'company_id' => ['required', 'exists:companies,id'],
            'role' => ['nullable', 'string', 'max:64'],
            'is_verified' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'last_active_at' => ['nullable', 'date'],
        ];
    }

    protected function getSelectOptions(?Model $record): array
    {
        return [
            'user_id' => User::orderBy('name')->pluck('name', 'id')->toArray(),
            'company_id' => Company::orderBy('name')->pluck('name', 'id')->toArray(),
        ];
    }

    protected function buildQuery(Request $request): Builder
    {
        $query = ($this->modelClass)::query()->with($this->with);

        if ($search = $request->input('search')) {
            $like = "%{$search}%";

            $query->where(function (Builder $builder) use ($like) {
                $builder->whereHas('user', fn (Builder $sub) => $sub->where('name', 'like', $like))
                    ->orWhere('role', 'like', $like);
            });
        }

        if ($status = $request->input('status')) {
            if ($status === 'active') {
                $query->where('is_active', true);
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $sort = in_array($request->input('sort'), $this->sortable, true)
            ? $request->input('sort')
            : ($this->sortable[0] ?? 'id');

        $direction = $request->input('direction') === 'asc' ? 'asc' : 'desc';

        return $query->orderBy($sort, $direction);
    }

    protected function baseFormData(?Model $record): array
    {
        if ($record && $record->last_active_at) {
            $record->last_active_at = $record->last_active_at->format('Y-m-d\TH:i');
        }

        return parent::baseFormData($record);
    }

    protected function ensureSlug(Request $request): void
    {
        // Recruiter does not use slugs.
    }
}