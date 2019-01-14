<?php

namespace App\Http\Controllers\Api\Changelog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Changelog\ListLoggableChangelog;
use App\Log;
use App\User;

/**
 * Class ChangelogLoggableController.
 *
 * @package App\Http\Controllers\Tenant\Api\Changelog
 */
class ChangelogLoggableController extends Controller
{
    /**
     * ListLoggableChangelog.
     *
     * @param ListLoggableChangelog $request
     * @param $tenant
     * @param User $user
     * @return mixed
     */
    public function index(ListLoggableChangelog $request, $tenant, $loggable)
    {
        return map_collection(Log::fromLoggable($loggable)->get());
    }
}
