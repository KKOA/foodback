<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class User
 * @package App
 * @property int $id
 * @property string $first_name
 * @property string $last_Name
 * @property string $username
 * @property string $email
 * @property string $password
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'first_name', 'last_name','username','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array $hidden
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // DEFINE RELATIONSHIPS --------------------------------------------------

	/**
	 * @return HasMany
	 */
	public function restaurants() : HasMany
    {
        return $this->hasMany('App\Models\Restaurant');
    }
}
