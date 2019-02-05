<?php

namespace Tests\Feature\Tenants\Api\People;

use App\Models\Person;
use App\Models\User;
use App\Notifications\SampleNotification;
use App\Notifications\SimpleNotification;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Notification;
use Tests\BaseTenantTest;
use Tests\Feature\Tenants\Traits\CanLogin;

/**
 * Class SimpleNotificationsControllerTest.
 *
 * @package Tests\Feature
 */
class SimpleNotificationsControllerTest extends BaseTenantTest
{
    use RefreshDatabase, CanLogin;

    /**
     * Refresh the in-memory database.
     *
     * @return void
     */
    protected function refreshInMemoryDatabase()
    {
        $this->artisan('migrate',[
            '--path' => 'database/migrations/tenant'
        ]);

        $this->app[Kernel::class]->setArtisan(null);
    }

    /**
     * @test
     * @group notifications
     */
    public function notifications_manager_can_send_simple_notifications()
    {
        $this->withoutExceptionHandling();
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
        $result = json_decode($response->getContent());
//        dump($result);
//        $user = $user->fresh();
//        dd($user->notifications);
//        $this->assertCount(3,$result);
//        $this->assertEquals('Notification 1',$result[0]->data->title);
//        $this->assertEquals(SampleNotification::class,$result[0]->type);
//        $this->assertEquals('Notification 2',$result[1]->data->title);
//        $this->assertEquals(SampleNotification::class,$result[2]->type);
//        $this->assertEquals('Notification 3',$result[2]->data->title);
//        $this->assertEquals(SampleNotification::class,$result[2]->type);
    }
}
