<?php

namespace Database\Factories\Admin\SubCategory;

use App\Enum\StatusEnum;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Summary of model
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = SubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(3, true);
        $slug = Str::slug($name);
        return [
            'id'                => null,
            'name'              => $name,
            'slug'              => $slug,
            'status'            => fake()->randomElement([StatusEnum::Active, StatusEnum::Inactive]),
            'meta_title'        => fake()->words(3, true),
            'meta_description'  => fake()->text(100),
            'meta_keywords'     => fake()->words(3, true),
            'created_at'        => now()
        ];
    }

    /**
     * Summary of forUser
     * @param string $user
     * @param int $id
     * @return \Database\Factories\Admin\SubCategory\SubCategoryFactory
     */
    public function forUser(string $user, int $id = null): SubCategoryFactory
    {
        $user = ($id !== null) ?
            $user::find($id) :
            $user::inRandomOrder()->first();
        return $this->state([
            'created_by'        => $user->id
        ]);
    }

    /**
     * Summary of forCategory
     * @param string $category
     * @return \Database\Factories\Admin\SubCategory\SubCategoryFactory
     */
    public function forCategory(string $category): SubCategoryFactory
    {
        $category = $category::inRandomOrder()
            ->where('status', '=', '0')
            ->first();
        return $this->state([
            'category_id'      => $category->id
        ]);
    }
}
