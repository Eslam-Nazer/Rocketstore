<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ColorAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Color::factory()
            ->forUser(User::class)
            ->count(25)
            ->create();
    }
}
