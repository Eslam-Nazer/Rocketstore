<?php

namespace Database\Factories\Admin\Color;

use App\Models\Color;
use App\Enum\StatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Color>
 */
class ColorFactory extends Factory
{

    /**
     * Summary of model
     * @var class-string<\App\Models\Color>
     */
    protected $model = Color::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colorName = fake()->colorName() . ' ' . fake()->safeColorName();
        return [
            'name'          => $colorName,
            'code'          => fake()->hexColor(),
            'status'        => fake()->randomElement([StatusEnum::Active, StatusEnum::Inactive]),
            'created_at'    => now(),
        ];
    }

    /**
     * Summary of forUser
     * @param string $user
     * @param int $id
     * @return \Database\Factories\Admin\Color\ColorFactory
     */
    public function forUser(string $user, int $id = null): ColorFactory
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
