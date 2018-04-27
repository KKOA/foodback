<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    protected $fillable =[
        'name',
        'description',
        'address1',
        'address2',
        'city',
        'county',
        'postcode'];

    public function not_blank($element)
    {
        $element = trim($element);
        return (strlen($element) > 0);
    }
    public function full_address()
    {
        $parts = [
            $this->address1,
            $this->address2,
            $this->city,
            $this->county,
            $this->postcode
        ];
        $address = array_filter($parts, [$this,'not_blank']);
        return implode(', ',$address);
    }

    // DEFINE RELATIONSHIPS --------------------------------------------------
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}

