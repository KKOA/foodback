<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon as Carbon;


/**
 * Class Review
 * @package App\Models
 * @property int $id
 * @property int $restaurant_id
 * @property string $comment
 * @property int $rating
 */
class Review extends Model
{
    
    // MASS ASSIGNMENT -------------------------------------------------------
    
    /**
     * define which attributes are mass assignable (for security)
     * @var array $fillable
     * */
    protected $fillable = 
    [
	    'restaurant_id',
        'comment',
        'rating',
        'updated_at'
    ];

    // DEFINE Mutators --------------------------------------------------

	/**
	 *
	 * @param string|null $value
	 * @return string|null
	 */
	public function getCommentAttribute(string $value = null) :?string
    {
    	return !is_null($value) ?ucfirst($value) : $value;
    }

	/**
	 * @param string $value
	 * @return void
	 */
	public function setCommentAttribute(string $value) :void
    {
		$this->attributes['comment'] = ucfirst($value);
    }

	/**
	 * @param string $date
	 * @return string
	 */
	public function getUpdatedAtAttribute(string $date) :string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('h:i A l jS F Y');
    }

    //  DEFINE RELATIONSHIPS --------------------------------------------------

	/**
	 * @return BelongsTo
	 */
	public function restaurant() :BelongsTo {
        return $this->belongsTo('App\Models\Restaurant');
    }
}
