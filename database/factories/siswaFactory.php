<?php

namespace Database\Factories;

use App\Models\admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class siswaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'tb'   => $this->faker->numberBetween(140, 180),
            'bb'   => $this->faker->numberBetween(35, 80),
            'id'   => admin::factory()->create(['role'=>'siswa'])->id,
        ];
    }
}
