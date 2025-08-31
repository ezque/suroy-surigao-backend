<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = [
        'user_ID', 
        'name', 
        'registrationDate',
        'description',
        'location',
        'contact_num',
        'verification_status',
        'status'
    ];
}
