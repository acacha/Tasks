<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\NotificationsDestroy;
use App\Http\Requests\Notifications\NotificationsDestroyMultiple;
use App\Http\Requests\Notifications\NotificationsIndex;
use App\DatabaseNotification;

/**
 * Class NotificationsController.
 *
 * @package App\Http\Controllers\Api\Notifications
 */
class NotificationsController extends Controller
{
    /**
     * Index.
     *
     * @param NotificationsIndex $request
     * @return mixed
     */
    public function index(NotificationsIndex $request)
    {
        return map_collection(DatabaseNotification::notifications());
    }

    /**
     * destroy
     * @param NotificationsDestroyMultiple $request
     * @throws \Exception
     */
    public function destroy(NotificationsDestroy $request, DatabaseNotification $notification)
    {
        $notification->delete();
    }

    /**
     * destroyMultiple
     * @param NotificationsDestroyMultiple $request
     */
    public function destroyMultiple(NotificationsDestroyMultiple $request)
    {
        DatabaseNotification::destroy($request->notifications);
    }
}
