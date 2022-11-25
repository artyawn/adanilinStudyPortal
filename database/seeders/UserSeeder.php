<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
use Database\Factories\SubjectFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(10)->hasAttached(Subject::factory(),['score' => fake()->numberBetween(2,5)])
            ->create();
    }
}
