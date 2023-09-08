<?php

namespace Database\Factories;

use App\models\SuperAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuperAdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'company_name' => $this->faker->unique()->company(),
            'year' => $this->faker->year(),
            'company_headquarters' => $this->faker->city(),
            'what_company_does' => $this->faker->sentence()
        ];
    }
}
