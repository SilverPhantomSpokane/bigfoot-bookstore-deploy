<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
    return [
        'department_id' => \App\Models\Department::factory(),       // will create a department if it doesn't exist yet
        'name' => ucfirst($this->faker->words(2, true)),            // e.g.: "Blue Hoodie"
        'price' => $this->faker->randomFloat(2, 5, 200),            // from $5.00 to $200.00
        'description' => $this->faker->sentence(),                  // short description
        'item_number' => $this->faker->unique()->numerify('ITEM-#####'), // unique item number
        'image' => 'https://picsum.photos/seed/' . $this->faker->word() . '/400/400',// random image
    ];
    }
}
