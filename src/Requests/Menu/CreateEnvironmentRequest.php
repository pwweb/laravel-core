<?php

namespace PWWEB\Core\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;
use PWWEB\Core\Models\Menu\Environment;

/**
 * PWWEB\Core\Requests\Menu\CreateEnvironmentRequest CreateEnvironmentRequest.
 *
 * The create request class for the Environment
 * Class CreateEnvironmentRequest
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class CreateEnvironmentRequest extends FormRequest
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
        return Environment::$rules;
    }
}