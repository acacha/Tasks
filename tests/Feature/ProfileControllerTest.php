<?php

namespace Tests\Feature;

use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function show_user_profile()
    {
        $user = $this->login();
        $response = $this->get('/profile');
        $response->assertSuccessful();
        $response->assertViewIs('profile');
        $response->assertViewHas('user', function($returnedUser) use ($user) {
            return $returnedUser->name === $user->name;
        });
    }

}
