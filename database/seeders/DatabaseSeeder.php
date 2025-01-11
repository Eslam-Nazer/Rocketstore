<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ColorAdminSeeder;
use Database\Seeders\BrandAdminSeeder;
use Database\Seeders\CategoryAdminSeeder;
use Database\Seeders\SubCategoryAdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            CategoryAdminSeeder::class,
            SubCategoryAdminSeeder::class,
            BrandAdminSeeder::class,
            ColorAdminSeeder::class
        ]);
    }
}
