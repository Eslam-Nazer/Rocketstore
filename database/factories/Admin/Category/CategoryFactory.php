<?php

namespace Database\Factories\Admin\Category;

use App\Enum\StatusEnum;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Summary of model
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->catchPhrase();
        $lsug = Str::slug(strtolower($name));
        return [
            'id'                => null,
            'name'              => $name,
            'slug'              => $lsug,
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
     * @return \Database\Factories\Admin\Category\CategoryFactory
     */
    public function forUser(string $user, int $id = null): CategoryFactory
    {
        $user = ($id !== null) ?
            $user::find($id) :
            $user::inRandomOrder()
            ->where('is_admin', '=', '1')
            ->first();
        return $this->state([
            'created_by'        => $user->id,
        ]);
    }
}
