<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_name',
        'user_mpbile',
        'user_age',
        'status',
    ];
    protected function UserName():Attribute{
        return Attribute::make(
        get: fn($value)=>strtoupper($value),
        set:fn($value)=>strtolower($value),
 );

}

}
