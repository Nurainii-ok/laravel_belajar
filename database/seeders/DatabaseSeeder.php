<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\admin;
use App\Models\guru;
use App\Models\konten;
use App\Models\siswa;

class DatabaseSeeder extends Seeder
{
    public function run(): void
{
    // Admin tetap
    admin::factory()->dataadmin1()->create();

    // Guru tetap (user: guru / pass: guru)
    $guruAdmin = admin::factory()->dataadmin2()->create();

   

    // Siswa & Guru dummy dari factory
    siswa::factory()->count(15)->create();
    guru::factory()->count(5)->create();

    // Konten dummy
    konten::factory()->count(5)->create();
}


}
