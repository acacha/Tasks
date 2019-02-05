<?php

namespace App\Http\Requests\Notifications;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SimpleNotificationsStore
 * @package App\Http\Requests
 */
class SimpleNotificationsStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('notifications.simple.store');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user' => 'required',
            'title' => 'required|max:140'
        ];
    }
}
