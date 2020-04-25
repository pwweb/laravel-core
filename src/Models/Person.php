<?php

namespace PWWEB\Core\Models;

use Illuminate\Database\Eloquent\Model;
use PWWEB\Core\Enums\Gender;
use PWWEB\Core\Enums\Title;
use PWWEB\Core\Traits\Migratable;
use PWWEB\Localisation\Contracts\Address as AddressContract;
use PWWEB\Localisation\Models\Address;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * App\Core\Models\Person Model.
 *
 * Standard Person Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

class Person extends Model implements HasMedia
{
    use Migratable;
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'middle_name', 'surname', 'maiden_name', 'gender', 'dob', 'nationality_id',
    ];

    /**
     * The attributes that are to be parsed as dates.
     *
     * @var array
     */
    protected $dates = [
        'dob',
    ];

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'system_persons';

    /**
     * Accessor for address data.
     *
     * @return array
     */
    public function addresses()
    {
        return $this->morphToMany(
            Address::class,
            'model',
            config('pwweb.localisation.table_names.model_has_address')
        );
    }

    /**
     * Accessor for user data.
     *
     * @return object
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Register additional media conversions.
     *
     * @param \Spatie\MediaLibrary\Models\Media $media Media object
     *
     * @return void
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    /**
     * Accessor for Age.
     *
     * @return string
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->dob)->age;
    }

    /**
     * Accessor for avatar.
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
        $mediaObject = $this->getMedia('avatars')->last();

        if (null !== $mediaObject) {
            return $mediaObject->getUrl('thumb');
        }

        return '/img/placeholder.png';
    }

    /**
     * Accessor for profile types.
     *
     * @return string
     */
    public function getDescriptionAttribute()
    {
        $description = [];

        /*
         * Removing this functionality for the time being.
            if (null !== $this->volunteer) {
            $description[] = __('Volunteer');
            }
         */

        if (true === $this->user->hasRole('administrator')) {
            return __('Administrator');
        }

        if (true === empty($description)) {
            return __('User');
        }

        return implode(', ', $description);
    }

    /**
     * Format the title attribute based on the corresponding enum.
     *
     * @param integer $value Title enum number
     *
     * @return \PWWEB\Core\Enums\Title
     */
    public function getTitleAttribute($value) : Title
    {
        $title = Title::make((int) $value);

        return $title;
    }

    /**
     * Format the gender attribute based on the corresponding enum.
     *
     * @param integer $value Gender enum number
     *
     * @return \PWWEB\Core\Enums\Gender
     */
    public function getGenderAttribute($value) : Gender
    {
        $gender = Gender::make((int) $value);

        return $gender;
    }

    /**
     * Retrieve the home address for the person.
     *
     * @param mixed $value Current value
     *
     * @return AddressContract
     */
    public function getHomeAttribute($value) : ?AddressContract
    {
        return $this->addresses->filter(
            function ($address, $key) {
                if (true === $address->primary) {
                    return true;
                }
            }
        )->first();
    }
}
