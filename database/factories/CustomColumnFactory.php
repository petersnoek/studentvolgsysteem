<?php

namespace Database\Factories;

use App\Models\ColumnType;
use App\Models\CustomColumn;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomColumnFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomColumn::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'column_type_id' => ColumnType::first()->id,
        ];
    }
}
