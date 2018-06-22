<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    protected $fillable =['name'];
    

    // DEFINE Mutators --------------------------------------------------
    
    // Getter
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    // Setter
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function restaurants() {
        return $this->belongsToMany('App\Restaurant')->withTimestamps();
    }
}
