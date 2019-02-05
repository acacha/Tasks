<?php

namespace App\Http\Requests\Notifications;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NotificationsDestroyMultiple.
 *
 * @package App\Http\Requests
 */
class NotificationsDestroyMultiple extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('notifications.destroyMultiple');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'notifications' => 'required'
        ];
    }
}
