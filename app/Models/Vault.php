<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Vault extends Model
{

    protected $fillable = [
        'id',
        'name',
        'description'
    ];

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
