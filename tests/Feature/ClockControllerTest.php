<?php

namespace Tests\Feature;

use Config;
use Event;
use File;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Storage;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use URL;

/**
 * Class ClockControllerTest.
 *
 * @package Tests\Feature
 */
class ClockControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /** @test */
    public function show_user_photo()
    {
       $this->login('web');

       $response = $this->get('/clock');

       $response->assertSuccessful();
       $response->assertViewIs('clock.index');
    }

}
