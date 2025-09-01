<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable = [
        'user_ID', 
        'firstName', 
        'lastName',
        'phone_num',
        'gender'
    ];
}

