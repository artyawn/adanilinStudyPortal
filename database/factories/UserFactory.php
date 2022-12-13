<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fio' => $this->faker->name(),
            'birth_date' => $this->faker->date(),
            'group_id' => Group::factory(),
            'email' => $this->faker->email(),
            'password' => Hash::make($this->faker->password()),
            'address' => [
                'city' => $this->faker->city(),
                'street' => $this->faker->streetAddress(),
                'home' => $this->faker->numberBetween(1,100)
            ],
            'role' => Role::getRandom()
        ];
    }
}
