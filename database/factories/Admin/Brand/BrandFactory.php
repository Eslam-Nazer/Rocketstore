<?php

namespace Database\Factories\Admin\Brand;

use App\Enum\StatusEnum;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{

    /**
     * Summary of model
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();
        $slug = Str::slug(strtolower($name));
        return [
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
     * @return \Database\Factories\Admin\Brand\BrandFactory
     */
    public function forUser(string $user, int $id = null): BrandFactory
    {
        $user = ($id !== null) ?
            $user::find($id) :
            $user::inRandomOrder()
            ->where('is_admin', '=', '1')
            ->first();

        return $this->state([
            'created_by'        => $user->id
        ]);
    }
}
