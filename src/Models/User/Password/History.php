<?php

namespace PWWEB\Core\Models\User\Password;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PWWEB\Core\Traits\Migratable;

/**
 * PWWEB\Core\Models\User\Password\History Model.
 *
 * Standard User Password History Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @property int user_id
 * @property string password
 */

class History extends Model
{
    use Migratable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'user_id',
        'password'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'password' => 'string'
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'password' => 'required'
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

        $this->setTable(config('pwweb.core.table_names.user_password_histories'));
    }

    /**
     * Accessor for user of the historic password entry.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('pwweb.core.models.user'));
    }
}
