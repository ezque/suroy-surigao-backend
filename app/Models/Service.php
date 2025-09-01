<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'agency_ID', 
        'description', 
        'image_path',
        'capacity',
        'prize',
        'duration'
    ];
}
