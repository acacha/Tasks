<?php

namespace App\Http\Requests\Changelog;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ListLoggableChangelog.
 *
 * @package App\Http\Requests
 */
class ListLoggableChangelog extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('logs.loggable.list',$this->loggable);
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
