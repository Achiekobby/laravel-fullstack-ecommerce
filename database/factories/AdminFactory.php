<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $role = ["admin","super_admin"];
        $name_parts = explode(" ",fake()->name);

        return [
            "uuid"              =>Str::uuid(),
            'first_name'        => $name_parts[0],
            'last_name'         => $name_parts[count($name_parts) -1],
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'role'              => fake()->randomElement($role),
            'phone_number'      => fake()->unique()->phoneNumber(),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
        ];
    }
}
