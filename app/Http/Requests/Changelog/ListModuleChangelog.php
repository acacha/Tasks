<?php

namespace App\Http\Requests\Changelog;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ListModuleChangelog.
 *
 * @package App\Http\Requests
 */
class ListModuleChangelog extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('logs.module.list',$this->module);
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
