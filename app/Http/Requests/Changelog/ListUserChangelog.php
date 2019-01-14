<?php

namespace App\Http\Requests\Changelog;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ListUserChangelog.
 *
 * @package App\Http\Requests
 */
class ListUserChangelog extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('logs.user.list',$this->user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
