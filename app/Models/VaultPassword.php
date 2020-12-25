<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaultPassword extends Model
{
    use HasFactory;

    protected $fillable = [
        'vault', //Vault UUID
        'password' //Password Content UUID
    ];
}
