<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;


class Item extends Model
{
    protected $casts = [
        'payload' => 'array',
    ];

    protected $fillable = [
        'vault_id',
        'payload'
    ];
}
