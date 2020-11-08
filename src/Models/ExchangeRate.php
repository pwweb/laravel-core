<?php

namespace PWWEB\Core\Models;

use Eloquent as Model;
use PWWEB\Core\Contracts\ExchangeRate as ExchangeRateContract;
use PWWEB\Core\Traits\Migratable;

/**
 * App\Models\PWWEB\Core\Models\ExchangeRate Model.
 *
 * Standard Currency Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @property \PWWEB\Core\Models\Currency $curency
 * @property float $rate
 */
class ExchangeRate extends Model implements ExchangeRateContract
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
        'curency_id',
        'rate',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'rate' => 'decimal',
    ];

    /**
     * Validation rules.
     *
     * @var string[]
     */
    public static $rules = [
        'curency_id' => 'required',
        'rate' => 'required',
    ];

    /**
     * Constructor.
     *
     * @param array $attributes additional attributes for model initialisation
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('pwweb.core.table_names.exchange_rates'));
        parent::__construct($attributes);
    }

    /**
     * Accessor for linked Currencies model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function currency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config('pwweb.core.models.currency'), 'id');
    }
}
