<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Cuisine
 * @package App\Models
 * @property string name
 */
class Cuisine extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
	/**
	 * @var array $fillable
	 */
	protected $fillable =['name'];
    

    // DEFINE Mutators --------------------------------------------------
    
    // Getter
	/**
	 * @param $value
	 * @return string
	 */
	public function getNameAttribute($value) :?string
    {

    	return !is_null($value) ? ucwords($value) : $value;
    }

    // Setter

	/**
	 * @param $value
	 * @return void
	 */
	public function setNameAttribute(string $value = null) :void
    {
        $this->attributes['name'] = !is_null($value) ? ucwords($value) : $value;
    }

    // DEFINE RELATIONSHIPS --------------------------------------------------

	/**
	 * @return BelongsToMany
	 */
	public function restaurants() :BelongsToMany
	{
        return $this->belongsToMany('App\Models\Restaurant')->withTimestamps();
    }
}
