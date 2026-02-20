<?php

namespace App\Http\Controllers\Admin;

use App\Models\Candidate;
use App\Models\City;
use App\Models\ExperienceRange;
use App\Models\NoticePeriod;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CandidateController extends MasterResourceController
{
    protected string $modelClass = Candidate::class;
    protected string $routeName = 'admin.candidates';
    protected string $resourceLabel = 'Candidate';
    protected string $resourcePlural = 'Candidates';
    protected string $indexSubtitle = 'Track every profile that can be matched to open roles.';
    protected string $formSubtitle = 'Manage the core metadata for a candidate profile, including availability and expectations.';
    protected array $with = ['user', 'city.state.country', 'experienceRange', 'noticePeriod'];
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'User', 'field' => 'user.name'],
        ['label' => 'City', 'field' => 'city.name'],
        ['label' => 'Experience range', 'field' => 'experienceRange.label'],
        ['label' => 'Expected salary', 'field' => 'expected_salary'],
        ['label' => 'Open to work', 'field' => 'open_to_work', 'type' => 'boolean', 'sortable' => true],
        ['label' => 'Last active', 'field' => 'last_active_at', 'sortable' => true],
    ];
    protected array $formFields = [
        ['name' => 'user_id', 'label' => 'User', 'type' => 'select', 'required' => true],
        ['name' => 'city_id', 'label' => 'City', 'type' => 'select'],
        ['name' => 'experience_range_id', 'label' => 'Experience range', 'type' => 'select'],
        ['name' => 'notice_period_id', 'label' => 'Notice period', 'type' => 'select'],
        ['name' => 'total_experience_years', 'label' => 'Total experience (years)', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'expected_salary', 'label' => 'Expected salary', 'type' => 'number', 'attributes' => ['step' => 1000]],
        ['name' => 'last_active_at', 'label' => 'Last active', 'type' => 'datetime-local'],
        ['name' => 'open_to_work', 'label' => 'Open to work', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $sortable = ['id', 'total_experience_years', 'expected_salary', 'last_active_at'];
    protected array $booleanFields = ['open_to_work'];

    protected function rules(Model $record = null): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'experience_range_id' => ['nullable', 'exists:experience_ranges,id'],
            'notice_period_id' => ['nullable', 'exists:notice_periods,id'],
            'total_experience_years' => ['nullable', 'integer', 'min:0'],
            'expected_salary' => ['nullable', 'integer', 'min:0'],
            'last_active_at' => ['nullable', 'date'],
            'open_to_work' => ['nullable', 'boolean'],
        ];
    }

    protected function getSelectOptions(?Model $record): array
    {
        $cities = City::with(['state.country'])->orderBy('name')->get();

        return [
            'user_id' => User::orderBy('name')->pluck('name', 'id')->toArray(),
            'city_id' => $cities->mapWithKeys(fn (City $city) => [$city->id => $this->formatLocationLabel($city)])->toArray(),
            'experience_range_id' => ExperienceRange::orderBy('priority')->pluck('label', 'id')->toArray(),
            'notice_period_id' => NoticePeriod::orderBy('sort_order')->pluck('label', 'id')->toArray(),
        ];
    }

    private function formatLocationLabel(City $city): string
    {
        $parts = array_filter([
            $city->name,
            $city->state?->name,
            $city->state?->country?->name,
        ]);

        return implode(', ', $parts);
    }

    protected function buildQuery(Request $request): Builder
    {
        $query = ($this->modelClass)::query()->with($this->with);

        if ($search = $request->input('search')) {
            $query->where(function (Builder $builder) use ($search) {
                $like = "%{$search}%";

                $builder->whereHas('user', fn (Builder $sub) => $sub
                        ->where('name', 'like', $like)
                        ->orWhere('email', 'like', $like)
                )
                ->orWhere('total_experience_years', 'like', $like)
                ->orWhere('expected_salary', 'like', $like);
            });
        }

        if ($status = $request->input('status')) {
            if ($status === 'active') {
                $query->where('open_to_work', true);
            } elseif ($status === 'inactive') {
                $query->where('open_to_work', false);
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
}