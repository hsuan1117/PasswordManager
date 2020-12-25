<?php

namespace Database\Factories;

use App\Models\Vault;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VaultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vault::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'name' => "Personal Vault",
        ];
    }
}
