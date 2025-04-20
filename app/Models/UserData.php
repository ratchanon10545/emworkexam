<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $fillable = [
        'profile_path',
        'prefix',
        'firstname',
        'lastname',
        'birthday'
    ];
}
