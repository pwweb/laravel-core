<?php

namespace PWWEB\Core\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use PWWEB\Core\Contracts\Address as AddressContract;
use PWWEB\Core\Exceptions\AddressDoesNotExist;
use PWWEB\Core\LocalisationRegistrar;
use PWWEB\Core\Traits\Migratable;

/**
 * PWWEB\Core\Models\Address Model.
 *
 * Standard Address Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 *
 * @property  \PWWEB\Core\Models\SystemLocalisationCountry country
 * @property  \PWWEB\Core\Models\SystemAddressType type
 * @property  int country_id
 * @property  int type_id
 * @property  string street
 * @property  string street2
 * @property  string city
 * @property  string state
 * @property  string postcode
 * @property  number lat
 * @property  number lng
 * @property  bool primary
 */
class Address extends Model implements AddressContract
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
        'country_id',
        'type_id',
        'street',
        'street2',
        'city',
        'state',
        'postcode',
        'lat',
        'lng',
        'primary',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'country_id' => 'integer',
        'type_id' => 'integer',
        'street' => 'string',
        'street2' => 'string',
        'city' => 'string',
        'state' => 'string',
        'postcode' => 'string',
        'lat' => 'float',
        'lng' => 'float',
        'primary' => 'boolean',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'country_id' => 'required',
        'type_id' => 'required',
        'primary' => 'required',
    ];

    /**
     * Constructor.
     *
     * @param  array  $attributes  additional attributes for model initialisation
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('pwweb.core.table_names.addresses'));
        parent::__construct($attributes);
    }

    /**
     * Accessor for linked Country model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function country(): BelongsTo
    {
        return $this->belongsTo(config('pwweb.core.models.country'), 'country_id');
    }

    /**
     * Accessor for linked Address type model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function type(): BelongsTo
    {
        return $this->belongsTo(config('pwweb.core.models.address_type'), 'type_id');
    }

    /**
     * Find an address by its id.
     *
     * @param  int  $id  ID to be used to retrieve the address
     *
     * @todo Refactor. This needs to go into the repository.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     *
     * @throws \PWWEB\Core\Exceptions\AddressDoesNotExist
     */
    public static function findById(int $id)
    {
        $address = static::getAddresses(['id' => $id])->first();

        if (null === $address) {
            throw AddressDoesNotExist::withId($id);
        }

        return $address;
    }

    /**
     * Find an address by its type.
     *
     * @param  string  $type  Address type to be used to retrieve the address
     *
     * @todo Refactor. This needs to go into the repository.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     *
     * @throws \PWWEB\Core\Exceptions\AddressDoesNotExist
     */
    public static function findByType(string $type)
    {
        $address = static::getAddresses(['type' => $type])->first();

        if (null === $address) {
            throw AddressDoesNotExist::withType($type);
        }

        return $address;
    }

    /**
     * Get the current cached addresses.
     *
     * @param  array  $params  additional parameters for the database query
     * @return Collection collection of addresses
     */
    protected static function getAddresses(array $params = []): Collection
    {
        $addresses = app(LocalisationRegistrar::class)
            ->setAddressClass(static::class)
            ->getAddresses($params);

        return $addresses;
    }
}
