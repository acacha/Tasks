<?php

namespace Tests\Feature\Tenants\Api;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Console\Kernel;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

/**
 * Class GitControllerTest.
 *
 * @package Tests\Feature\Tenants\Api
 */
class GitControllerTest extends TestCase{

    use RefreshDatabase, CanLogin;

    /** @test */
    public function superadmin_refresh_git_info()
    {
        $this->loginAsSuperAdmin('api');
        $result = $this->json('GET','/api/v1/git/info');
        $result->assertSuccessful();
    }

    /** @test */
    public function guest_user_cannot_refresh_git_info()
    {
        $result = $this->json('GET','/api/v1/git/info');
        $result->assertStatus(401);
    }

    /** @test */
    public function regular_user_cannot_refresh_git_info()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user,'api');
        $result = $this->json('GET','/api/v1/git/info');
        $result->assertStatus(403);
    }

}
