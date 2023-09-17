<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Record;
use App\Models\Vehicle;

class RecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Record::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'vehicle_id' => Vehicle::factory(),
            'leave_at' => $this->faker->dateTime(),
            'total' => $this->faker->randomFloat(2, 0, 999999.99),
        ];
    }
}
