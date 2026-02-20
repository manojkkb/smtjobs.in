<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

abstract class MasterSeeder extends Seeder
{
    use WithoutModelEvents;

    protected function upsertRecords(string $model, array $records, array $uniqueKeys = ['slug']): void
    {
        foreach ($records as $record) {
            $model::updateOrCreate(
                Arr::only($record, $uniqueKeys),
                $record
            );
        }
    }

    protected function basicSlugLabelData(string $key, array $seed, bool $includeLabel = true): array
    {
        return [
            array_merge([
                'slug' => "{$key}-primary",
                'label' => ucfirst(str_replace('_', ' ', $key)),
            ], $includeLabel ? ['label' => $seed['label']] : []),
            $seed,
        ];
    }
}
