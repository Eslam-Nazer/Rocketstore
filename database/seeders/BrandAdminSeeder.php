<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Database\Seeder;

class BrandAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::factory()
            ->forUser(User::class)
            ->count(25)
            ->create();
    }
}
