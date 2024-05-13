<?php

namespace Database\Factories;

use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    protected $model = UserProfile::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'maiden_name' => $this->faker->lastName,
            'age' => $this->faker->numberBetween(18, 100),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'phone' => $this->faker->phoneNumber,
            'birth_date' => $this->faker->date,
            'image' => $this->faker->imageUrl(),
            'height' => $this->faker->randomFloat(2, 50, 250),
            'weight' => $this->faker->randomFloat(2, 20, 200),
            'eye_color' => $this->faker->colorName,
            'domain' => $this->faker->domainName,
            'ip' => $this->faker->ipv4,
            'mac_address' => $this->faker->macAddress,
            'university' => $this->faker->sentence,
            'ein' => $this->faker->ean13,
            'ssn' => $this->faker->ssn,
            'user_agent' => $this->faker->userAgent,
        ];
    }
}
