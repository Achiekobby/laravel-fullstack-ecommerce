<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clients\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name_parts = explode(' ', fake()->name());
        $user_ids = User::query()->pluck('id')->toArray();
        return [
            "first_name"=>$name_parts[0],
            "last_name"=>$name_parts[count($name_parts)-1],
            "user_id"=>fake()->randomElement($user_ids),
            "phone_number"=>fake()->phoneNumber(),
            "address"=>fake()->address(),
            "state"=>fake()->state(),
            "city"=>fake()->city(),
            "country"=>fake()->country(),
            "geolocation"=>["long"=>1234.34, "lat"=>6876.54]
        ];
    }
}
