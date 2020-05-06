<?php

namespace PWWEB\Core\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

/**
 * PWWEB\Core\Requests\Profile\UpdatePasswordRequest UpdatePasswordRequest.
 *
 * The update request class for the user password.
 * Class UpdatePasswordRequest
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class UpdatePasswordRequest extends FormRequest
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
            'current'  => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        return $base;
    }
}
