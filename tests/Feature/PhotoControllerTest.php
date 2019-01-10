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
        Storage::fake('local');

        $user = $this->login();
        $response = $this->post('/photo',[
            'photo' => UploadedFile::fake()->image('photo.jpg')
        ]);
        $response->assertSuccessful();

        Storage::disk('local')->assertExists($photoUrl = 'photos/' . $user->id);

        $photo = Photo::first();
        $this->assertEquals($photoUrl, $photo->url);
        $this->assertNotNull($photo->user);
        $this->assertEquals($user->id, $photo->user->id);
        $user = $user->fresh();
        $this->assertNotNull($user->photo);
        $this->assertEquals($photoUrl, $user->photo->url);
    }

}
