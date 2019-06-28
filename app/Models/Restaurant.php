<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Restaurant
 * @package App\Models
 * @property int id
 * @property  int $user_id
 * @property string $name
 * @property string $description
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $county
 * @property string $postcode
 * @property string $cover_image
 */
class Restaurant extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    
    /**
     * define which attributes are mass assignable (for security)
     * @var array  $fillable
     * */
    protected $fillable =[
	    'user_id',
    	'name',
        'description',
        'address1',
        'address2',
        'city',
        'county',
        'postcode',
        'cover_image',
    ];
    
    /**
     * Check the element in question is not empty
     * @param string $element
     * @return boolean
     * */

    public function not_blank(string $element=null) :bool
    {
        if(is_null($element))
        {
        	return false;
        }
    	$element = trim($element);
        return (strlen($element) > 0);
    }

	/**
	 * Combines all the address fields into string
	 * @return string
	 */
	public function fullAddress() :string
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


    // DEFINE Mutators --------------------------------------------------

    // Getter

	/**
	 * Get format restaurant name
	 * @param string|null $value
	 * @return string|null
	 */
	public function getNameAttribute(string $value = null) :?string
    {

    	return !is_null($value) ? ucwords($value) : $value;
    }

	/**
	 * Get format restaurant description
	 * @param string|null $value
	 * @return string|null
	 */
	public function getDescriptionAttribute(string $value = null) :?string
    {
        return !is_null($value) ?ucfirst($value) : $value;
    }

	/**
	 * Get format Restaurant address 1
	 * @param string|null $value
	 * @return string|null
	 */
	public function getAddress1Attribute(string $value = null) :?string
    {
        return !is_null($value) ? ucwords($value) : $value;
    }

	/**
	 * Get format Restaurant address 2
	 * @param string|null $value
	 * @return string|null
	 */
	public function getAddress2Attribute(string $value = null) :?string
    {
        return !is_null($value) ? ucwords($value) : $value;
    }

	/**
	 * Get format Restaurant City
	 * @param string|null $value
	 * @return string|null
	 */
	public function getCityAttribute(string $value = null) :? string
    {
        return !is_null($value) ? ucwords($value) : $value;
    }

	/**
	 * Get format Restaurant County
	 * @param string|null $value
	 * @return string|null
	 */
	public function getCountyAttribute(string $value = null) :?string
    {
        return !is_null($value) ? ucwords($value) : $value;
    }

	/**
	 * Get format Postcode
	 * @param string|null $value
	 * @return string|null
	 */
	public function getPostcodeAttribute(string $value = null) :?string
    {
        return !is_null($value) ? strtoupper($value) : $value;
    }

    // Setter

	/**
	 * Set
	 * @param string $value
	 * @return void
	 */
	public function setNameAttribute(string $value) :void
    {
        $this->attributes['name'] = ucwords($value);
    }

	/**
	 * @param string $value
	 * @return void
	 */
	public function setDescriptionAttribute(string $value) :void
    {
        $this->attributes['description'] = ucfirst($value);
    }

	/**
	 * @param string $value
	 * @return void
	 */
	public function setAddress1Attribute(string $value) :void
    {
        $this->attributes['address1'] = ucwords($value);
    }

	/**
	 * @param string $value
	 * @return void
	 */
	public function setAddress2Attribute(string $value = null) :void
    {
        $this->attributes['address2'] = !is_null($value) ? ucwords($value) :$value;
    }

	/**
	 * @param string $value
	 * @return void
	 */
	public function setCityAttribute(string $value) : void
    {
        $this->attributes['city'] = ucwords($value);
    }

	/**
	 * @param string $value
	 * @return void
	 */
	public function setCountyAttribute(string $value = null) :void
    {
        $this->attributes['county'] = !is_null($value) ? ucwords($value) :$value;
    }

	/**
	 * @param string $value
	 * @return void
	 */
	public function setPostcodeAttribute(string $value) :void
    {
        $this->attributes['postcode'] = strtoupper($value);
    }

    // DEFINE RELATIONSHIPS --------------------------------------------------

	/**
	 * @return HasMany
	 */
	public function reviews() :HasMany
    {
        return $this->hasMany('App\Models\Review');
    }

	/**
	 * @return HasMany
	 */
	public function photos() : HasMany
    {
        return $this->hasMany('App\Models\RestaurantPhoto');
    }

	/**
	 * @return BelongsToMany
	 */
	public function cuisines() :BelongsToMany {
        return $this->belongsToMany('App\Models\Cuisine')->withTimestamps();
    }

	/**
	 * @return BelongsTo
	 */
	public function user() :BelongsTo
    {
      return $this->belongsTo('App\Models\User');
    }
}

