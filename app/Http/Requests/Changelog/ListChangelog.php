<?php

namespace App\Http\Requests\Changelog;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ListChangelog.
 *
 * @package App\Http\Requests
 */
class ListChangelog extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('changelog.list');
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
