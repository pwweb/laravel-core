<?php

namespace PWWEB\Core\Requests\Tax;

use Illuminate\Foundation\Http\FormRequest;
use PWWEB\Core\Models\Tax\Location;

/**
 * PWWEB\Core\Requests\Tax\CreateLocationRequest CreateLocationRequest.
 *
 * The update request class for the Tax Location
 * Class CreateLocationRequest
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class CreateLocationRequest extends FormRequest
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
        return (config('pwweb.core.models.tax.location'))::$rules;
    }
}
