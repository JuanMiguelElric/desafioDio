<?php

namespace Database\Seeders;

use App\Models\Terceiro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TerceiroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Terceiro::factory(100)
        ->state(['empresa_id'=>1])
        ->create();
    }
}
