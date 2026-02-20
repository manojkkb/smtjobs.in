<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Company;
use App\Models\CompanySize;
use App\Models\CompanyType;
use App\Models\Industry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class CompanyController extends MasterResourceController
{
    protected string $modelClass = Company::class;
    protected string $routeName = 'admin.companies';
    protected string $resourceLabel = 'Company';
    protected string $resourcePlural = 'Companies';
    protected string $indexSubtitle = 'Manage every employer profile that powers jobs and filters.';
    protected string $formSubtitle = 'Capture the industry, size, and location metadata for each company entry.';
    protected array $with = ['industry', 'companyType', 'companySize', 'city.state.country'];
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'Name', 'field' => 'name', 'sortable' => true],
        ['label' => 'Slug', 'field' => 'slug', 'sortable' => true],
        ['label' => 'Industry', 'field' => 'industry.label'],
        ['label' => 'Company type', 'field' => 'companyType.label'],
        ['label' => 'Company size', 'field' => 'companySize.label'],
        ['label' => 'City', 'field' => 'city.name'],
        ['label' => 'State', 'field' => 'city.state.name'],
        ['label' => 'Country', 'field' => 'city.state.country.name'],
        ['label' => 'Verified', 'field' => 'is_verified', 'type' => 'boolean', 'sortable' => true],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
    ];
    protected array $detailColumns = [
        ['label' => 'Name', 'field' => 'name'],
        ['label' => 'Slug', 'field' => 'slug'],
        ['label' => 'Industry', 'field' => 'industry.label'],
        ['label' => 'Company type', 'field' => 'companyType.label'],
        ['label' => 'Company size', 'field' => 'companySize.label'],
        ['label' => 'City', 'field' => 'city.name'],
        ['label' => 'State', 'field' => 'city.state.name'],
        ['label' => 'Country', 'field' => 'city.state.country.name'],
        ['label' => 'Verified', 'field' => 'is_verified', 'type' => 'boolean'],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean'],
    ];
    protected array $formFields = [
        ['name' => 'name', 'label' => 'Company name', 'type' => 'text', 'required' => true],
        ['name' => 'slug', 'label' => 'Slug', 'type' => 'text', 'required' => true],
        ['name' => 'industry_id', 'label' => 'Industry', 'type' => 'select'],
        ['name' => 'company_type_id', 'label' => 'Company type', 'type' => 'select'],
        ['name' => 'company_size_id', 'label' => 'Company size', 'type' => 'select'],
        ['name' => 'city_id', 'label' => 'City', 'type' => 'select'],
        ['name' => 'is_verified', 'label' => 'Verified', 'type' => 'checkbox'],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $searchColumns = ['name', 'slug'];
    protected array $sortable = ['id', 'name', 'slug', 'is_verified', 'is_active', 'created_at'];
    protected array $booleanFields = ['is_verified', 'is_active'];

    protected function rules(Model $record = null): array
    {
        $slugRule = Rule::unique('companies', 'slug');

        if ($record) {
            $slugRule->ignore($record);
        }

        return [
            'name' => ['required', 'string', 'max:191'],
            'slug' => ['required', 'alpha_dash', 'max:191', $slugRule],
            'industry_id' => ['nullable', 'exists:industries,id'],
            'company_type_id' => ['nullable', 'exists:company_types,id'],
            'company_size_id' => ['nullable', 'exists:company_sizes,id'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'is_verified' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    protected function getSelectOptions(?Model $record): array
    {
        $cities = City::with(['state.country'])
            ->orderBy('name')
            ->get();

        return [
            'industry_id' => Industry::orderBy('label')->pluck('label', 'id')->toArray(),
            'company_type_id' => CompanyType::orderBy('label')->pluck('label', 'id')->toArray(),
            'company_size_id' => CompanySize::orderBy('sort_order')->pluck('label', 'id')->toArray(),
            'city_id' => $cities->mapWithKeys(fn (City $city) => [$city->id => $this->formatCityLabel($city)])->toArray(),
        ];
    }

    private function formatCityLabel(City $city): string
    {
        $parts = array_filter([
            $city->name,
            $city->state?->name,
            $city->state?->country?->name,
        ]);

        return implode(', ', $parts);
    }
}