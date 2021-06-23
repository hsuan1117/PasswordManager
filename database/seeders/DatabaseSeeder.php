<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Vault;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Features\SM4;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $sm4 = new SM4();
        $key = bin2hex(Str::limit(sm3("DEFAULT"),16));

        $user = User::create([
            'name' => 'Hsuan',
            'email' => 'admin@admin.com',
            'password' => Hash::make('adminadmin'),
            'role' => User::ROLE_ROOT
        ]);
        $vault = $user->vaults()->create([
            'name' => 'Default',
            'description' => 'Test Vault'
        ]);
        //$item = new Item
        $vault->items()->create([
            'payload'=>[
                'type' => 'website',
                'name' => 'Facebook',
                'secret'=>$sm4->setKey($key)->encryptData(json_encode([
                    "ka"=>"ak"
                ]))
            ]
        ]);

    }
}
