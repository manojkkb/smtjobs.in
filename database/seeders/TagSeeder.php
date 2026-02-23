<?php

namespace Database\Seeders;

use App\Models\Tag;

class TagSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(Tag::class, [

    [
        'slug' => 'urgent',
        'label' => 'Urgent',
        'bg_color' => '#FEE2E2',
        'text_color' => '#B91C1C',
        'sort_order' => 1,
        'is_active' => true,
    ],

    [
        'slug' => 'featured',
        'label' => 'Featured',
        'bg_color' => '#DBEAFE',
        'text_color' => '#1D4ED8',
        'sort_order' => 2,
        'is_active' => true,
    ],

    [
        'slug' => 'hot',
        'label' => 'Hot',
        'bg_color' => '#FFEDD5',
        'text_color' => '#C2410C',
        'sort_order' => 3,
        'is_active' => true,
    ],

    [
        'slug' => 'new',
        'label' => 'New',
        'bg_color' => '#DCFCE7',
        'text_color' => '#15803D',
        'sort_order' => 4,
        'is_active' => true,
    ],

    [
        'slug' => 'remote',
        'label' => 'Remote',
        'bg_color' => '#EDE9FE',
        'text_color' => '#6D28D9',
        'sort_order' => 5,
        'is_active' => true,
    ],

    [
        'slug' => 'walk_in',
        'label' => 'Walk-in Interview',
        'bg_color' => '#CFFAFE',
        'text_color' => '#0E7490',
        'sort_order' => 6,
        'is_active' => true,
    ],

    [
        'slug' => 'government',
        'label' => 'Government Job',
        'bg_color' => '#E0E7FF',
        'text_color' => '#3730A3',
        'sort_order' => 7,
        'is_active' => true,
    ],

    [
        'slug' => 'high_salary',
        'label' => 'High Salary',
        'bg_color' => '#ECFDF5',
        'text_color' => '#065F46',
        'sort_order' => 8,
        'is_active' => true,
    ],

]);
    }
}
