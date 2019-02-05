<?php

namespace App\Http\Requests\Notifications;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NotificationsIndex.
 *
 * @package App\Http\Requests
 */
class NotificationsIndex extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('notifications.index');
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
