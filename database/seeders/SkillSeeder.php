<?php

namespace Database\Seeders;

use App\Models\Skill;

class SkillSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(Skill::class, $this->basicSlugLabelData('skill', ['slug' => 'php', 'label' => 'PHP']));
    }
}
