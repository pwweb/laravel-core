<?php

namespace PWWEB\Core\Models;

use App\Traits\Migratable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PWWEB\Localisation\Traits\HasAddresses;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\System\User Model.
 *
 * Standard User Model.
 *
 * @author    Frank Pillukeit <frank@sportly.io>
 * @copyright 2020 sportly.io
 * @license   https://sportly.io/license.md Proprietary and confidential
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use Migratable;
    use HasAddresses;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'system_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be cast to Carbon dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at',
    ];

    /**
     * Accessor for person of the user.
     *
     * @return object
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Accessor for the calculated joined date.
     *
     * @return string Joined date
     */
    public function getJoinedAttribute()
    {
        return $this->created_at;
    }
}
