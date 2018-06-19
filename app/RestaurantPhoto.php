<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantPhoto extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    protected $fillable =['filename'];
    
    // DEFINE Mutators --------------------------------------------------
        
    // DEFINE RELATIONSHIPS --------------------------------------------------
}
