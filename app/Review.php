<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon as Carbon;

class Review extends Model
{
    
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    protected $fillable = 
    [
        'comment', 'rating', 'restaurant_id','updated_at'
    ];

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('h:i A l jS F Y');
    }

    // // DEFINE RELATIONSHIPS --------------------------------------------------
    public function restaurant() {
        return $this->belongsTo('App\Restaurant');
    }
}
