<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Radnik;

class RadnikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kreiranje 100 nasumičnih radnika
        Radnik::factory(100)->create();
    }
}
