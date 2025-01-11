<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\Admin\Category\CategoryFactory;
use Illuminate\Database\Seeder;

class CategoryAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()
            ->forUser(User::class)
            ->count(25)
            ->create();
    }
}
