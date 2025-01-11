<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubCategoryAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::factory()
            ->forUser(User::class, 1)
            ->forCategory(Category::class)
            ->count(25)
            ->create();
    }
}
