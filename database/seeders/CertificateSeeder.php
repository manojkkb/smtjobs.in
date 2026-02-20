<?php

namespace Database\Seeders;

use App\Models\Certificate;

class CertificateSeeder extends MasterSeeder
{
    public function run(): void
    {
        $this->upsertRecords(Certificate::class, [
            ['slug' => 'pmp', 'label' => 'PMP', 'issuing_authority' => 'PMI', 'icon' => 'pmp-icon', 'sort_order' => 1],
            ['slug' => 'cissp', 'label' => 'CISSP', 'issuing_authority' => 'ISC2', 'icon' => 'security', 'sort_order' => 2],
        ]);
    }
}
