<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current email_verified_at being used by the factory.
     */
    protected static ?string $email_verified_at = null;

     /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if (is_null(static::$password)) {
            static::$password = Hash::make('password'); // Hash the password only once
        }

        if (is_null(static::$email_verified_at)) {
            static::$email_verified_at = Carbon::now()->toDateTimeString();
        }
        
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => self::$email_verified_at,
            'password' => static::$password,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model's is_admin should be true.
     */
    public function admin(): static
    {
        return $this->state([
            'is_admin' => true,
        ]);
    }
}
