<?php

namespace Tests\Feature\Api\Notifications;

use App\Notifications\SimpleNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;

/**
 * Class UserNotificationsControllerTest.
 *
 * @package Tests\Feature
 */
class UserNotificationsControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     * @group notifications
     */
    public function user_can_get_his_owned_notifications()
    {
        $user = $this->login('api');
        set_sample_notifications_to_user($user);
        $response = $this->json('GET','/api/v1/user/notifications/');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(3,$result);
        $this->assertEquals('Notification 1',$result[0]->data->title);
        $this->assertEquals(SimpleNotification::class,$result[0]->type);
        $this->assertEquals('Notification 2',$result[1]->data->title);
        $this->assertEquals(SimpleNotification::class,$result[2]->type);
        $this->assertEquals('Notification 3',$result[2]->data->title);
        $this->assertEquals(SimpleNotification::class,$result[2]->type);
    }

    /**
     * @test
     * @group notifications
     */
    public function user_can_get_his_owned_notifications_zero_notifications()
    {
        $this->login('api');
        $response = $this->json('GET','/api/v1/user/notifications/');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(0,$result);
    }

    /**
     * @test
     * @group notifications
     */
    public function guest_user_cannot_get_his_owned_notifications()
    {
        $response = $this->json('GET','/api/v1/user/notifications/');
        $response->assertStatus(401);
    }
}
