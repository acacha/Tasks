<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

/**
 * Class NotificationsControllerTest.
 *
 * @package Tests\Feature
 */
class NotificationsControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     * @group notifications
     */
    public function show_notifications_module()
    {
        factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);
        $user = $this->loginAsSuperAdmin();
        set_sample_notifications_to_user($user);
        sample_notifications();

        $response = $this->get('/notifications');
        $response->assertSuccessful();

        $response->assertViewIs('notifications.index');
        $response->assertViewHas('userNotifications', function ($returnedUserNotifications) {
            return
                count($returnedUserNotifications) === 3 &&
                $returnedUserNotifications[0]->data['title'] === 'Notification 1' &&
                $returnedUserNotifications[1]->data['title'] === 'Notification 2' &&
                $returnedUserNotifications[2]->data['title'] === 'Notification 3';
        });
        $response->assertViewHas('notifications', function ($returnedNotifications) {
            return
                count($returnedNotifications) === 5;
        });
        $response->assertViewHas('users', function ($returnedUsers) use ($user) {
            return
                count($returnedUsers) === 4 &&
                $returnedUsers[0]['name'] === 'Pepe Pardo Jeans' &&
                $returnedUsers[0]['email'] === 'pepepardo@jeans.com' &&
                $returnedUsers[1]['name'] === $user->name &&
                $returnedUsers[1]['email'] === $user->email;
        });
    }

    /**
     * @test
     * @group notifications
     */
    public function regular_user_can_show_notifications_module()
    {
        $this->withoutExceptionHandling();
        factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);
        $user = $this->login();
        set_sample_notifications_to_user($user);
        sample_notifications();

        $response = $this->get('/notifications');
        $response->assertSuccessful();

        $response->assertViewIs('notifications.index');
        $response->assertViewHas('userNotifications', function ($returnedUserNotifications) {
            return
                count($returnedUserNotifications) === 3 &&
                $returnedUserNotifications[0]->data['title'] === 'Notification 1' &&
                $returnedUserNotifications[1]->data['title'] === 'Notification 2' &&
                $returnedUserNotifications[2]->data['title'] === 'Notification 3';
        });
        $response->assertViewHas('notifications', function ($returnedNotifications) {
            return
                count($returnedNotifications) === 0;
        });
        $response->assertViewHas('users', function ($returnedUsers) {
            return
                count($returnedUsers) === 0;
        });
    }

    /**
     * @test
     * @group notifications
     */
    public function guest_user_cannot_show_notifications_module()
    {
        $response = $this->get('/notifications');
        $response->assertRedirect('login');
    }

}
