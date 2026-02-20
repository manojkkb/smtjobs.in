<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubscriptionPlanController extends MasterResourceController
{
    protected string $modelClass = SubscriptionPlan::class;
    protected string $routeName = 'admin.subscription-plans';
    protected string $resourceLabel = 'Subscription Plan';
    protected string $resourcePlural = 'Subscription Plans';
    protected string $indexSubtitle = 'Offer subscription-based credits and validity settings to your recruiters.';
    protected string $formSubtitle = 'Configure credits, pricing, and availability for each plan.';
    protected array $tableColumns = [
        ['label' => 'ID', 'field' => 'id', 'sortable' => true],
        ['label' => 'Name', 'field' => 'name', 'sortable' => true],
        ['label' => 'Slug', 'field' => 'slug', 'sortable' => true],
        ['label' => 'Job credits', 'field' => 'job_credits', 'sortable' => true, 'align' => 'right'],
        ['label' => 'Database credits', 'field' => 'database_credits', 'sortable' => true, 'align' => 'right'],
        ['label' => 'AI agent credits', 'field' => 'ai_agent_credits', 'sortable' => true, 'align' => 'right'],
        ['label' => 'Validity (days)', 'field' => 'validity_days', 'sortable' => true, 'align' => 'right'],
        ['label' => 'Price', 'field' => 'price', 'sortable' => true, 'align' => 'right'],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean', 'sortable' => true],
    ];
    protected array $detailColumns = [
        ['label' => 'Name', 'field' => 'name'],
        ['label' => 'Slug', 'field' => 'slug'],
        ['label' => 'Job credits', 'field' => 'job_credits'],
        ['label' => 'Database credits', 'field' => 'database_credits'],
        ['label' => 'AI agent credits', 'field' => 'ai_agent_credits'],
        ['label' => 'Validity (days)', 'field' => 'validity_days'],
        ['label' => 'Price', 'field' => 'price'],
        ['label' => 'Active', 'field' => 'is_active', 'type' => 'boolean'],
    ];
    protected array $formFields = [
        ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true],
        ['name' => 'slug', 'label' => 'Slug', 'type' => 'text'],
        ['name' => 'job_credits', 'label' => 'Job credits', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'database_credits', 'label' => 'Database credits', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'ai_agent_credits', 'label' => 'AI agent credits', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'validity_days', 'label' => 'Validity (days)', 'type' => 'number', 'attributes' => ['step' => 1]],
        ['name' => 'price', 'label' => 'Price', 'type' => 'number', 'attributes' => ['step' => 0.01]],
        ['name' => 'is_active', 'label' => 'Active', 'type' => 'checkbox', 'default' => true],
    ];
    protected array $searchColumns = ['name', 'slug'];
    protected array $sortable = ['id', 'name', 'job_credits', 'database_credits', 'ai_agent_credits', 'validity_days', 'price'];
    protected array $booleanFields = ['is_active'];

    protected function rules(Model $record = null): array
    {
        $slugRule = Rule::unique('subscription_plans', 'slug');

        if ($record) {
            $slugRule->ignore($record);
        }

        return [
            'name' => ['required', 'string', 'max:191'],
            'slug' => ['nullable', 'alpha_dash', 'max:191', $slugRule],
            'job_credits' => ['nullable', 'integer', 'min:0'],
            'database_credits' => ['nullable', 'integer', 'min:0'],
            'ai_agent_credits' => ['nullable', 'integer', 'min:0'],
            'validity_days' => ['nullable', 'integer', 'min:0'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    protected function preparePayload(array $data, Request $request): array
    {
        $payload = parent::preparePayload($data, $request);

        foreach (['job_credits', 'database_credits', 'ai_agent_credits', 'validity_days'] as $key) {
            if (!array_key_exists($key, $payload) || $payload[$key] === null) {
                $payload[$key] = 0;
            }
        }

        if (!array_key_exists('price', $payload) || $payload['price'] === null) {
            $payload['price'] = 0;
        }

        return $payload;
    }
}