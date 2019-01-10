<?php

use App\Photo;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhotoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function setUser()
    {
        $photo = Photo::create([
            'url' => '/photo1.png',
        ]);
        $this->assertNull($photo->user);
        $photo->setUser($user = factory(User::class)->create());
        $photo = $photo->fresh();
        $this->assertNotNull($photo->user);
        $this->assertEquals($photo->user->name, $user->name);
    }

    /**
     * @test
     */
    public function map()
    {
        $photo = Photo::create([
            'url' => '/photo1.png',
        ]);
        $mappedPhoto = $photo->map();
        $this->assertEquals($mappedPhoto['id'],1);
        $this->assertEquals($mappedPhoto['url'],'/photo1.png');
    }
}
