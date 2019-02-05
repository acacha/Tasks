<?php

namespace Tests\Feature;

use App\User;
use Config;
use Event;
use Illuminate\Http\Testing\File as TestFile;
use File;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;
use Storage;
use Tests\TestCase;
use URL;

/**
 * Class UserPhotoControllerTest.
 *
 * @package Tests\Feature
 */
class UserPhotoControllerTest extends TestCase
{
    use RefreshDatabase;

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

    /** @test */
    public function can_download_user_photo()
    {
        Storage::fake('local');

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $user2 = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'peppardo@jeans.com'
        ]);
        Storage::disk('local')->put(
            'tenant_test/teacher_photos/sergi.jpg',
            File::get(base_path('tests/__Fixtures__/photos/users/sergi.jpg'))
        );

        $user2->assignPhoto('tenant_test/teacher_photos/sergi.jpg','tenant_test');
        $response = $this->get('/user/' . $user2->getRouteKey() . '/photo/download');

        $response->assertSuccessful();
        $baseResponse = $response->baseResponse;
        $this->assertEquals(get_class($baseResponse),'Symfony\Component\HttpFoundation\BinaryFileResponse');
        $file = $response->baseResponse->getFile();
        $this->assertEquals(get_class($file),'Symfony\Component\HttpFoundation\File\File');
        $this->assertEquals($file->getFileName(),'2_pepe-pardo-jeans_peppardo-at-jeanscom.jpg');

    }

    /** @test */
    public function store_user_photo()
    {
        Storage::fake('local');
        Event::fake();

        $manager = factory(User::class)->create();
        $role = Role::firstOrCreate(['name' => 'TeachersManager']);
        Config::set('auth.providers.users.model', User::class);
        $manager->assignRole($role);
        $this->actingAs($manager,'api');

        $user = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);

        $this->assertNull($user->photo);
        $response = $this->json('POST','/api/v1/user/' . $user->id . '/photo', [
            'photo' => UploadedFile::fake()->image('photo.png')
        ]);
        $response->assertSuccessful();
        $path = $response->getContent();
        $user = $user->fresh();
        $this->assertEquals($user->photo,$path);
        $this->assertEquals($user->photo_hash,md5($path));
        Storage::disk('local')->assertExists($path);
        Event::assertDispatched(UserPhotoUploaded::class, function ($e) use ($path) {
            return $e->path === $path;
        });
    }

    /** @test */
    public function store_user_photo_validation()
    {
        $manager = factory(User::class)->create();
        $role = Role::firstOrCreate(['name' => 'TeachersManager']);
        Config::set('auth.providers.users.model', User::class);
        $manager->assignRole($role);
        $this->actingAs($manager,'api');

        $user = factory(User::class)->create();

        $response = $this->json('POST','/api/v1/user/' . $user->id . '/photo', []);

        $response->assertStatus(422);
        $result =json_decode($response->getContent());
        $this->assertEquals($result->message,'Les dades proporcionades no són vàlides');
        $this->assertEquals($result->errors->photo[0],'El camp photo és obligatori.');


        $file = \Illuminate\Http\Testing\File::create('not-an_image.pdf');

        $response = $this->json('POST','/api/v1/user/' . $user->id . '/photo', [
            'photo' => $file
        ]);
        $response->assertStatus(422);
        $result =json_decode($response->getContent());
        $this->assertEquals($result->message,'Les dades proporcionades no són vàlides');
        $this->assertEquals($result->errors->photo[0],'photo ha de ser una imatge.');

    }

    /** @test */
    public function user_cannot_store_user_photo()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user,'api');
        $response = $this->json('POST','/api/v1/user/' . $user->id . '/photo', [
            'photo' => ''
        ]);
        $response->assertStatus(403);
    }

    /** @test */
    public function delete_user_photo()
    {
        Storage::fake('local');
        Event::fake();

        $manager = factory(User::class)->create();
        $role = Role::firstOrCreate(['name' => 'UsersManager']);
        Config::set('auth.providers.users.model', User::class);
        $manager->assignRole($role);
        $this->actingAs($manager,'api');

        $file = TestFile::create($filename = '1_sergi-tur-badenas_sergiturbadenas-at-gmailcom.png');
        $result1 = Storage::disk('local')->putFileAs('iesebre/user_photos', $file, $filename);

        $user = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);
        $user->photo = $path = 'iesebre/user_photos/' . $filename;
        $user->photo_hash =md5($path);
        $user->save();
        Storage::disk('local')->assertExists($path);

        $response = $this->json('DELETE','/api/v1/user/' . $user->id . '/photo');
        $response->assertSuccessful();
        $result = $response->getContent();
        $user = $user->fresh();
        $this->assertNull($user->photo);

        $this->assertEquals($result,$path);
        Storage::disk('local')->assertMissing($path);

        Event::assertDispatched(UserPhotoRemoved::class, function ($e) use ($path) {
            return $e->path === $path;
        });
    }

    /** @test */
    public function regular_user_cannot_delete_user_photo()
    {
        $regularuser = factory(User::class)->create();
        $this->actingAs($regularuser,'api');

        $user = factory(User::class)->create();
        $response = $this->json('DELETE','/api/v1/user/' . $user->id . '/photo');
        $response->assertStatus(403);
    }

}
