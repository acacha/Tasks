<?php

namespace App\Http\Controllers\Api\Changelog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Changelog\ListModuleChangelog;
use App\Log;
use App\Module;

/**
 * Class ChangelogModuleController.
 *
 * @package App\Http\Controllers\Tenant\Api\Changelog
 */
class ChangelogModuleController extends Controller
{
    /**
     * ListModuleChangelog.
     *
     * @param ListModuleChangelog $request
     * @param $tenant
     * @param Module $module
     * @return mixed
     */
    public function index(ListModuleChangelog $request, $tenant, Module $module)
    {
        return map_collection(Log::module($module->name)->get());
    }
}
