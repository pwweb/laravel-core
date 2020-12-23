<?php

namespace PWWEB\Core\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use PWWEB\Core\Contracts\Address as AddressContract;
use PWWEB\Core\Enums\Gender;
use PWWEB\Core\Enums\Title;
use PWWEB\Core\Traits\HasAddresses;
use PWWEB\Core\Traits\Migratable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * PWWEB\Core\Models\Person Model.
 *
 * Standard Person Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @property  \PWWEB\Core\Models\Country nationality
 * @property  \Illuminate\Database\Eloquent\Collection users
 * @property  int nationality_id
 * @property  string title
 * @property  string name
 * @property  string middle_name
 * @property  string surname
 * @property  string maiden_name
 * @property  string gender
 * @property  string dob
 * @property  string display_name
 * @property  string display_middle_name
 * @property  string select_name
 * @property  MorphToMany addresses
 */
class Person extends Model implements HasMedia
{
    use Migratable;
    use InteractsWithMedia;
    use HasAddresses;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * The attributes that are to be parsed as dates.
     *
     * @var array
     */
    protected $dates = [
        'dob',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nationality_id',
        'title',
        'name',
        'middle_name',
        'surname',
        'maiden_name',
        'gender',
        'dob',
        'display_name',
        'display_middle_name',
        'select_name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nationality_id' => 'integer',
        'title' => 'string',
        'name' => 'string',
        'middle_name' => 'string',
        'surname' => 'string',
        'maiden_name' => 'string',
        'gender' => 'string',
        'dob' => 'date',
        'display_name' => 'string',
        'display_middle_name' => 'string',
        'select_name' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'surname' => 'required',
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
        $this->setTable(config('pwweb.core.table_names.persons'));
        parent::__construct($attributes);
    }

    /**
     * Accessor for nationality.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function nationality(): BelongsTo
    {
        return $this->belongsTo(config('pwweb.core.models.country'), 'nationality_id');
    }

    /**
     * Accessor for address data.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function addresses(): MorphToMany
    {
        return $this->morphToMany(
            config('pwweb.core.models.address'),
            'model',
            config('pwweb.core.table_names.model_has_address')
        );
    }

    /**
     * Accessor for user data.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(config('pwweb.core.models.user'));
    }

    /**
     * Register additional media conversions.
     *
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media Media object
     *
     * @return void
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);

        $this->addMediaConversion('passport')
            ->crop(Manipulations::CROP_CENTER, 205, 256)
            ->sharpen(10);
    }

    /**
     * Accessor for Age.
     *
     * @return int
     */
    public function getAgeAttribute(): int
    {
        return Carbon::parse($this->dob)->age;
    }

    /**
     * Accessor for avatar.
     *
     * @return string
     */
    public function getAvatarAttribute(): string
    {
        $mediaObject = $this->getMedia('avatars')->last();

        if (null !== $mediaObject && true === file_exists($mediaObject->getPath('thumb'))) {
            return $mediaObject->getUrl('thumb');
        }

        return '/img/placeholder.png';
    }

    /**
     * Format the title attribute based on the corresponding enum.
     *
     * @param int $value Title enum number
     *
     * @return \PWWEB\Core\Enums\Title
     */
    public function getTitleAttribute($value): Title
    {
        $title = Title::make((int) $value);

        return $title;
    }

    /**
     * Format the gender attribute based on the corresponding enum.
     *
     * @param int $value Gender enum number
     *
     * @return \PWWEB\Core\Enums\Gender
     */
    public function getGenderAttribute($value): Gender
    {
        $gender = Gender::make((int) $value);

        return $gender;
    }

    /**
     * Retrieve the home address for the person.
     *
     * @return AddressContract
     */
    public function getHomeAttribute(): ?AddressContract
    {
        return $this->addresses->filter(
            function ($address) {
                if (true === $address->primary) {
                    return true;
                }
            }
        )->first();
    }
}
