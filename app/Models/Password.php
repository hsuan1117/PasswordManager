<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;


class Password extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'content'
    ];
}
