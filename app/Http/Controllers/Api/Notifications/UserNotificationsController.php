<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\UserNotificationsIndex;

/**
 * Class UserNotificationsController.
 *
 * @package App\Http\Controllers\Api\Notifications
 */
class UserNotificationsController extends Controller
{
    /**
     * Index.
     *
     * @param UserNotificationsIndex $request
     * @return mixed
     */
    public function index(UserNotificationsIndex $request)
    {
        return $request->user()->notifications;
    }
}
