<?php

namespace PWWEB\Core\Requests\User\Password;

use Illuminate\Foundation\Http\FormRequest;
use PWWEB\Core\Models\User\Password\History;

/**
 * PWWEB\Core\Requests\User\Password\CreateHistoryRequest CreateHistoryRequest.
 *
 * The create request class for the History
 * Class CreateHistoryRequest
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class CreateHistoryRequest extends FormRequest
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
        return (config('pwweb.core.models.user_password_history'))::$rules;
    }
}
