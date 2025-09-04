<?php

namespace Database\Factories;

use App\Models\admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class adminFactory extends Factory
{
    protected $model = admin::class;
    
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'password' => Hash::make('123'),
            'role' => 'siswa'
        ];
    }

    public function dataadmin1()
    {
        return $this->state([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role'     => 'admin',
        ]);
    }

    public function dataadmin2()
    {
        return $this->state([
            'username' => 'guru',
            'password' => Hash::make('guru'),
            'role'     => 'guru',
        ]);
    }
}
