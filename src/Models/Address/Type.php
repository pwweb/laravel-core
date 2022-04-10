<?php

namespace PWWEB\Core\Models\Address;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use PWWEB\Core\Contracts\Address\Type as AddressTypeContract;
use PWWEB\Core\Traits\Migratable;

/**
 * PWWEB\Core\Models\Address\Type Model.
 *
 * Standard Address Type Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 *
 * @property  \Illuminate\Database\Eloquent\Collection addresses
 * @property  string name
 * @property  bool global
 */
class Type extends Model implements AddressTypeContract
{
    use Migratable;
    use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that should be casted to Carbon dates.
     *
     * @var string[]
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * The attributes that can be filled.
     *
     * @var string[]
     */
    public $fillable = [
        'name',
        'global',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'global' => 'boolean',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'string|required',
        'global' => 'boolean|required',
    ];

    /**
     * Constructor.
     *
     * @param  array  $attributes  additional attributes for model initialisation
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('pwweb.core.table_names.address_types'));
        parent::__construct($attributes);
    }

    /**
     * Accessor for linked Address model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function addresses(): HasMany
    {
        return $this->hasMany(config('pwweb.core.models.address'), 'type_id');
    }
}
