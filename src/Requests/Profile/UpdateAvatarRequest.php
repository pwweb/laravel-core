<?php

namespace PWWEB\Core\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

/**
 * PWWEB\Core\Requests\Profile\UpdateAvatarRequest UpdateProfileRequest.
 *
 * The update request class for the Profile (including user and person)
 * Class UpdateProfileRequest
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class UpdateAvatarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $base = [
            'avatar'       => 'image',
        ];

        return $base;
    }
}
