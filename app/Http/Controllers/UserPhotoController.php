<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Storage;

/**
 * Class UserPhotoController.
 *
 * @package App\Http\Controllers
 */
class UserPhotoController extends Controller
{
    /**
     * Show user photo.
     *
     * @param Request $request
     * @param $tenant
     * @param User $user
     * @return
     */
    public function show(Request $request, $tenant, User $user)
    {
        if (! $user->photo || ! Storage::disk('local')->exists($user->photo)) {
            return response()->file(public_path(User::DEFAULT_PHOTO_PATH));
        }
        return response()->file(Storage::disk('local')->path($user->photo));
    }

    /**
     * Download.
     *
     * @param Request $request
     * @param $tenant
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request, $tenant, User $user)
    {
        if (! $user->photo || ! Storage::disk('local')->exists($user->photo)) {
            return response()->download(Storage::disk('local')->path(
                $this->basePath($tenant,User::DEFAULT_PHOTO_PATH)));
        }
        return response()->download(Storage::disk('local')->path($user->photo));
    }

    /**
     * Tenant base path
     *
     * @param $tenant
     * @param $path
     * @return string
     */
    protected function basePath($tenant , $path)
    {
        return $tenant. '/' . $path;
    }

}
