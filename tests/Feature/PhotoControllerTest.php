<?php

namespace Tests\Feature;

use App\Photo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhotoControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function upload_photo()
    {
//        $this->withoutExceptionHandling();
        Storage::fake('local');
        Storage::fake('google');

        $user = $this->login();
        $response = $this->post('/photo',[
            'photo' => UploadedFile::fake()->image('photo.jpg')
        ]);
        $response->assertRedirect();

        Storage::disk('local')->assertExists($photoUrl = 'photos/' . $user->id . '.jpg');
        Storage::disk('google')->assertExists('/' . $user->id . '.jpg');

        $photo = Photo::first();
        $this->assertEquals($photoUrl, $photo->url);
        $this->assertNotNull($photo->user);
        $this->assertEquals($user->id, $photo->user->id);
        $user = $user->fresh();
        $this->assertNotNull($user->photo);
        $this->assertEquals($photoUrl, $user->photo->url);
    }

    /**
     * @test
     */
    public function upload_photo_update()
    {
        $user = $this->login();
        $photoUrl = 'photos/' . $user->id . '.jpg';
        Photo::create([
            'url' => $photoUrl,
            'user_id' => $user->id
        ]);

        Storage::fake('local');

        $response = $this->post('/photo',[
            'photo' => UploadedFile::fake()->image('photo.jpg')
        ]);
        $response->assertRedirect();

        Storage::disk('local')->assertExists($photoUrl);

        $photo = Photo::first();
        $this->assertEquals($photoUrl, $photo->url);
        $this->assertNotNull($photo->user);
        $this->assertEquals($user->id, $photo->user->id);
        $user = $user->fresh();
        $this->assertNotNull($user->photo);
        $this->assertEquals($photoUrl, $user->photo->url);
    }

}
