<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $hidden = ['id', 'type', 'created_at', 'updated_at'];
}
