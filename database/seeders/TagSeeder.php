<?php

namespace Database\Seeders;

use App\Models\Tag;

class TagSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(Tag::class, $this->basicSlugLabelData('tag', ['slug' => 'urgent', 'label' => 'Urgent']));
    }
}
