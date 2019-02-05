<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\UserNotificationsDestroy;
use App\Http\Requests\Notifications\UserNotificationsIndex;
use App\DatabaseNotification;

/**
 * Class UserUnreadNotificationsController.
 *
 * @package App\Http\Controllers\Api\Notifications
 */
class UserUnreadNotificationsController extends Controller
{
    /**
     * Index.
     *
     * @param UserNotificationsIndex $request
     * @return mixed
     */
    public function index(UserNotificationsIndex $request)
    {
        return $request->user()->unreadNotifications;
    }

    /**
     * destroy.
     *
     * @param UserNotificationsDestroy $request
     * @return mixed
     */
    public function destroy(UserNotificationsDestroy $request, DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return $request->user()->unreadNotifications;
    }

    /**
     * destroyAll.
     *
     * @param UserNotificationsDestroy $request
     * @return mixed
     */
    public function destroyAll(UserNotificationsDestroy $request)
    {
        $request->user()->unreadNotifications->markAsRead();
        return $request->user()->fresh()->unreadNotifications;
    }
}
