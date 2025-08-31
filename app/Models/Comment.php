<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
        protected $fillable = [
            'user_ID', 
            'spot_ID', 
            'parent_ID', 
            'comment'];

}
