<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'position' => ['latitud'=>$this->faker->latitude(), 'longitud'=>$this->faker->longitude()],
            'status'=>$this->faker->boolean,
            'date_start'=>$this->faker->dateTimeBetween('0 years', '+1 years'),
            'date_end'=>$this->faker->dateTimeBetween('+1 years', '+2 years'),
            'url_image'=>$this->faker->imageUrl(),
        ];
    }
}
