<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           
        'company_id' => $this -> faker -> numberBetween(1,10),
        'product_name'=> $this->faker->word,
        'price'=> $this->faker->numberBetween(100,200),
        'stock'=> $this->faker->numberBetween(1,100)
        

        ];
       
    }
}
