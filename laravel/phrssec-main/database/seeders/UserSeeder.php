<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(3)->has(
            Task::factory(10)
                ->state(new Sequence(
                    [
                        'completed' => true,
                        "time" => 2,
                        "type" => "min(s)"
                    ],
                    [
                        'completed' => false,
                        "time" => 6,
                        "type" => "dia(s)"
                    ],
                    
                ))
        )->create();
    }
}
