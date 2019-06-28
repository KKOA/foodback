<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * Class RestaurantPhoto
 * @package App
 */
class RestaurantPhoto extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)

	/**
	 * @var array $fillable
	 */
	protected $fillable =['filename'];
    
    // DEFINE Mutators --------------------------------------------------
        
    // DEFINE RELATIONSHIPS --------------------------------------------------

	/**
	 * @return BelongsTo
	 */
	public function restaurant() :BelongsTo {
        return $this->belongsTo('App\Models\Restaurant');
    }
}
