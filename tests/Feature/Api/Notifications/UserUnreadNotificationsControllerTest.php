<?php

namespace Tests\Feature\Tenants\Api\Notifications;

use App\User;
use App\Notifications\SimpleNotification;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Feature\Traits\CanLogin;

/**
 * Class UserUnreadNotificationsControllerTest.
 *
 * @package Tests\Feature
 */
class UserUnreadNotificationsControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     * @group notifications
     */
    public function user_can_get_his_owned_unread_notifications()
    {
        $user = $this->login('api');
        set_sample_notifications_to_user($user);
        $user->notifications[1]->markAsRead();
        $response = $this->json('GET','/api/v1/user/unread_notifications/');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(2,$result);
        $this->assertEquals('Notification 1',$result[0]->data->title);
        $this->assertEquals(SimpleNotification::class,$result[0]->type);
        $this->assertEquals('Notification 3',$result[1]->data->title);
        $this->assertEquals(SimpleNotification::class,$result[1]->type);
    }

    /**
     * @test
     * @group notifications
     */
    public function guest_user_can_get_his_owned_unread_notifications()
    {
        $response = $this->json('GET','/api/v1/user/unread_notifications/');
        $response->assertStatus(401);
    }


    /**
     * @test
     * @group notifications
     */
    public function user_can_mark_notification_as_readed()
    {
        $user = $this->login('api');
        set_sample_notifications_to_user($user);
        $response = $this->json('DELETE','/api/v1/user/unread_notifications/' . $user->notifications[1]->id);
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(2,$result);
        $this->assertEquals('Notification 1',$result[0]->data->title);
        $this->assertEquals(SimpleNotification::class,$result[0]->type);
        $this->assertEquals('Notification 3',$result[1]->data->title);
        $this->assertEquals(SimpleNotification::class,$result[1]->type);
    }

    /**
     * @test
     * @group notifications
     */
    public function guest_user_cannot_mark_notification_as_readed()
    {
        sample_notifications();
        $response = $this->json('DELETE','/api/v1/user/unread_notifications/' . User::first()->unreadNotifications->first()->id);
        $response->assertStatus(401);
    }

    /**
     * @test
     * @group notifications
     */
    public function user_can_mark_all_notification_as_readed()
    {
        $user = $this->login('api');
        set_sample_notifications_to_user($user);
        $response = $this->json('DELETE','/api/v1/user/unread_notifications/all');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(0,$result);
    }

    /**
     * @test
     * @group notifications
     */
    public function guest_user_cannot_mark_all_notification_as_readed()
    {
        $user = factory(User::class)->create();
        set_sample_notifications_to_user($user);
        $response = $this->json('DELETE','/api/v1/user/unread_notifications/all');
        $response->assertStatus(401);
    }
}
