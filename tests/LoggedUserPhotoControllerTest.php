<?php

namespace Tests\Feature;

use App\Photo;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoggedUserPhotoControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function show_logged_user_photo()
    {
        $user = $this->login();
        $response = $this->get('/user/photo');
        dump($response->baseResponse->getFile()->getPathName());
        $this->assertEquals(storage_path(User::DEFAULT_PHOTO_PATH), $response->baseResponse->getFile()->getPathName());
        $response->assertSuccessful();
    }

    /** @test */
    public function show_user_photo()
    {
        Storage::fake('local');

        Storage::disk('local')->put(
            'tenant_test/user_photos/default.png',
            File::get(base_path('tests/__Fixtures__/photos/users/default.png'))
        );

        $user = factory(User::class)->create();
        $response = $this->get('/user/' . $user->getRouteKey() . '/photo');
        $response->assertSuccessful();
        $this->assertEquals(public_path(User::DEFAULT_PHOTO_PATH), $response->baseResponse->getFile()->getPathName());
//        $this->assertFileEquals(Storage::disk('local')->path('tenant_test/' . User::DEFAULT_PHOTO_PATH), $response->baseResponse->getFile()->getPathName());
        $this->assertFileEquals(public_path(User::DEFAULT_PHOTO_PATH), $response->baseResponse->getFile()->getPathName());

        $user2 = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);

        Storage::disk('local')->put(
            'tenant_test/teacher_photos/sergi.jpg',
            File::get(base_path('tests/__Fixtures__/photos/users/sergi.jpg'))
        );

        $user2->assignPhoto('tenant_test/teacher_photos/sergi.jpg','tenant_test');
        $response = $this->get('/user/' . $user2->getRouteKey() . '/photo');

        $this->assertEquals(Storage::disk('local')->path('tenant_test/user_photos/' . $user2->id . '_pepe-pardo-jeans_pepepardo-at-jeanscom.jpg'), $response->baseResponse->getFile()->getPathName());
        $this->assertFileEquals(Storage::disk('local')->path('tenant_test/user_photos/' . $user2->id . '_pepe-pardo-jeans_pepepardo-at-jeanscom.jpg'), $response->baseResponse->getFile()->getPathName());

        $response->assertSuccessful();

    }



}
