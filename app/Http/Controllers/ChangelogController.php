<?php

namespace App\Http\Controllers;

use App\Http\Requests\Changelog\ListChangelog;
use App\Log;
use App\User;

/**
 * Class ChangelogController.
 *
 * @package App\Http\Controllers\Tenant\Web
 */
class ChangelogController extends Controller
{
    /**
     * Index.
     *
     * @param ListChangelog $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ListChangelog $request)
    {
        $logs = map_collection(Log::with(
            'user'
        )->get()->loadMorph(
            'loggable', [ // could instead be named loadMixed()? loadMorphed()?
                \App\Models\Incident::class => ['user','closer','comments','tags','assignees']
            ]
        ));
        // loadMorph allows eager load different fields/properties depending on type of polimorphic relation

        $users = User::all();
        return view('changelog.index', compact('logs','users'));
    }
}
