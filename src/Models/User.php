<?php

namespace PWWEB\Core\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PWWEB\Core\Traits\Migratable;
use Spatie\Permission\Traits\HasRoles;

/**
 * PWWEB\Core\Models\User Model.
 *
 * Standard User Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @property  \PWWEB\Core\Models\Person person
 * @property  \PWWEB\Core\Models\User\Password\History passwordHistories
 * @property  int person_id
 * @property  string username
 * @property  string email
 * @property  string email_verified_at
 * @property  string password
 * @property  string remember_token
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use Migratable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'id' => 'integer',
        'person_id' => 'integer',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'email' => 'required',
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
     * Constructor.
     *
     * @param array $attributes additional attributes for model initialisation
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('pwweb.core.table_names.users'));
    }

    /**
     * Accessor for person of the user.
     *
     * @return BelongsTo
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(config('pwweb.core.models.person'));
    }

    /**
     * Accessor for previously used passwords.
     *
     * @return HasMany
     */
    public function passwordHistories(): HasMany
    {
        return $this->hasMany(config('pwweb.core.models.user_password_history'));
    }

    /**
     * Accessor for the calculated joined date.
     *
     * @return \DateTime Joined date
     */
    public function getJoinedAttribute(): \DateTime
    {
        return $this->created_at;
    }
}
