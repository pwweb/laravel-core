<?php

namespace PWWEB\Core\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PWWEB\Core\Models\User as UserModel;

/**
 * PWWEB\Core\Requests\UpdateProfileRequest UpdateProfileRequest.
 *
 * The update request class for the Profile (including user and person)
 * Class UpdateProfileRequest
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class UpdateProfileRequest extends FormRequest
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
        $id = '';
        if (true === isset($this->user->id)) {
            $id = ',email,'.$this->user->id;
        }

        $base = [
            'title'       => 'integer',
            'name'        => 'string|max:255|required',
            'middle_name' => 'string|max:255|nullable',
            'surname'     => 'string|max:255|required',
            'maiden_name' => 'string|max:255|nullable',
            'dob'         => 'date',
            'gender'      => 'integer',
            // 'nationality' => 'integer|min:1',
            // 'email'       => 'required|string|email|max:255|unique:'.UserModel::getTableName().$id,
        ];

        return $base;
    }

    /**
     * Method to overwrite the default messages in case validation fails.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'    => __('A name is required.'),
            'surname.required' => __('A surname is required.'),
        ];
    }
}
