<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    
     protected $fillable = [
        'first_friend', 'second_friend'
    ];
    public $timestamps = false;
}
