<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\VaultUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VaultUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VaultUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user'=>1,
            'vault'=>Str::uuid(),
            'permission'=>"ADMIN"
        ];
    }
}
