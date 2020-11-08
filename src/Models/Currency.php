<?php

namespace PWWEB\Core\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use PWWEB\Core\Contracts\Currency as CurrencyContract;
use PWWEB\Core\Traits\Migratable;

/**
 * App\Models\PWWEB\Core\Models\Currency Model.
 *
 * Standard Currency Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @property  string name
 * @property  string iso
 * @property  int numeric_code
 * @property  string entity_code
 * @property  bool active
 * @property  bool standard
 */
class Currency extends Model implements CurrencyContract
{
    use Migratable;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that can be filled.
     *
     * @var string[]
     */
    public $fillable = [
        'name',
        'iso',
        'numeric_code',
        'entity_code',
        'active',
        'standard',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'iso' => 'string',
        'numeric_code' => 'integer',
        'entity_code' => 'string',
        'active' => 'boolean',
        'standard' => 'boolean',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'iso' => 'required',
        'numeric_code' => 'required',
        'entity_code' => 'required',
        'active' => 'required',
        'standard' => 'required',
    ];

    /**
     * Constructor.
     *
     * @param array $attributes additional attributes for model initialisation
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('pwweb.core.table_names.currencies'));
        parent::__construct($attributes);
    }

    /**
     * Accessor for ExchangeRate data.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exchangeRate(): HasMany
    {
        return $this->hasMany(config('pwweb.core.models.exchange_rate'));
    }
}
