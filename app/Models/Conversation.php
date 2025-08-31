<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
   protected $fillable = [
            'user_ID', 
            'agency_ID', 
            'admin_ID'];
}
