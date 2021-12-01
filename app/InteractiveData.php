<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InteractiveData extends Model
{
    
protected $fillable=[
    'name', 'lastname','email','address','text'
];
}
