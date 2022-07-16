<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode_barang' => $this->faker->numerify('brg-######'),
            'nama_barang' => $this->faker->randomElement(['amplop A', 'amplop B', 'amplop C']),
            'lokasi' => $this->faker->randomElement(['cimahi', 'bandung']),
            'tersedia' => $this->faker->randomNumber(2, true),
            'satuan' => $this->faker->randomElement(['pak', 'karung'])
        ];
    }
}
