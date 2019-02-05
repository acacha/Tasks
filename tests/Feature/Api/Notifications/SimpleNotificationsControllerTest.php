<?php

namespace Tests\Feature\Api\Notifications;

use App\User;
use App\Notifications\SimpleNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Notification;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

/**
 * Class SimpleNotificationsControllerTest.
 *
 * @package Tests\Feature
 */
class SimpleNotificationsControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     * @group notifications
     */
    public function notifications_manager_can_send_simple_notifications()
    {
        $this->loginAsNotificationsManager('api');
        $user = factory(User::class)->create();

        Notification::fake();
        $response = $this->json('POST','/api/v1/simple_notifications/',[
            'user' => $user->id,
            'title' => 'Prova de notificació'
        ]);
        $response->assertSuccessful();
        Notification::assertSentTo(
            $user,
            SimpleNotification::class,
            function ($notification) {
                return $notification->title === 'Prova de notificació';
            }
        );
    }
}
