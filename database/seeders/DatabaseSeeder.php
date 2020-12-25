<?php

namespace Database\Seeders;

use App\Models\Password;
use App\Models\Vault;
use App\Models\VaultPassword;
use App\Models\VaultUser;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory(1)->create();
        $vault = Vault::factory()->create();
        $password = Password::factory()->create([
            'type' => "password",
            'content' => json_encode([])
        ]);
        VaultPassword::factory()->create([
            'vault' => $vault['id'],
            'password' => $password['id']
        ]);

        VaultUser::factory()->create([
           'user' => $user[0]->id,
           'vault' => $vault['id'],
           'permission' => "ADMIN"
        ]);
    }
}
