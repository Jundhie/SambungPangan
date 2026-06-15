<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telepon' => fake()->phoneNumber(),
            'role' => 'restoran',
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function administrator(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'administrator',
        ]);
    }

    public function restoran(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'restoran',
        ]);
    }

    public function pengelolaPangan(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'pengelola_pangan',
        ]);
    }
}
