<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Vault extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description'
    ];
}
