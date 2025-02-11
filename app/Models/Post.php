<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'text','user_id'];
}

