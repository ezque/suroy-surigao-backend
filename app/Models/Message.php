<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
            'conversation_ID', 
            'sender_ID', 
            'sender_type', 
            'message'];
}
