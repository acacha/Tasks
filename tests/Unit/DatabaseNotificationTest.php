<?php

namespace Tests\Unit;

use App\DatabaseNotification;
use App\Notifications\SimpleNotification;
use App\User;
use Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class DatabaseNotificationTest.
 *
 * @package Tests\Unit
 */
class DatabaseNotificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function mapSimple()
    {
        $user = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);
        $user->notify(new SimpleNotification('Notificació exemple'));
        $notification = DatabaseNotification::first();

        $mappedNotification = $notification->mapSimple();

        $this->assertTrue(is_valid_uuid($mappedNotification['id']));
        $this->assertEquals('App\Notifications\SimpleNotification',$mappedNotification['type']);
        $this->assertEquals(User::class, $mappedNotification['notifiable_type']);
        $this->assertEquals(1, $mappedNotification['notifiable_id']);
        $this->assertEquals('Notificació exemple', $mappedNotification['data']['title']);
        $this->assertEquals('notifications', $mappedNotification['api_uri']);
        $this->assertNull($mappedNotification['read_at']);
        $this->assertNotNull($mappedNotification['created_at']);
        $this->assertNotNull($mappedNotification['updated_at']);
        $this->assertNotNull($mappedNotification['created_at_timestamp']);
        $this->assertNotNull($mappedNotification['updated_at_timestamp']);
        $this->assertNotNull($mappedNotification['created_at_formatted']);
        $this->assertNotNull($mappedNotification['updated_at_formatted']);
        $this->assertNotNull($mappedNotification['created_at_human']);
        $this->assertNotNull($mappedNotification['updated_at_human']);

        $notification->markAsRead();

        $notification = $notification->fresh();
        $mappedNotification = $notification->map();
        $this->assertNotNull($mappedNotification['read_at']);
        $this->assertNotNull($mappedNotification['read_at_timestamp']);
        $this->assertNotNull($mappedNotification['read_at_formatted']);
        $this->assertNotNull($mappedNotification['read_at_diff']);
    }

    /**
     * @test
     */
    public function map()
    {
        $user = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);
        $user->notify(new SimpleNotification('Notificació exemple'));
        $notification = DatabaseNotification::first();

        $mappedNotification = $notification->map();

        $this->assertTrue(is_valid_uuid($mappedNotification['id']));
        $this->assertEquals('App\Notifications\SimpleNotification',$mappedNotification['type']);
        $this->assertTrue($user->is($mappedNotification['notifiable']));
        $this->assertEquals(User::class, $mappedNotification['notifiable_type']);
        $this->assertEquals(1, $mappedNotification['notifiable_id']);
        $this->assertEquals('Notificació exemple', $mappedNotification['data']['title']);
        $this->assertEquals('notifications', $mappedNotification['api_uri']);
        $this->assertNull($mappedNotification['read_at']);
        $this->assertNotNull($mappedNotification['created_at']);
        $this->assertNotNull($mappedNotification['updated_at']);
        $this->assertNotNull($mappedNotification['created_at_timestamp']);
        $this->assertNotNull($mappedNotification['updated_at_timestamp']);
        $this->assertNotNull($mappedNotification['created_at_formatted']);
        $this->assertNotNull($mappedNotification['updated_at_formatted']);
        $this->assertNotNull($mappedNotification['created_at_human']);
        $this->assertNotNull($mappedNotification['updated_at_human']);

        $hashids = new \Hashids\Hashids(config('tasks.salt'));
        $this->assertEquals($hashids->encode(1), $mappedNotification['user_hashid']);
        $this->assertEquals('Pepe Pardo Jeans', $mappedNotification['user_name']);

        $notification->markAsRead();

        $notification = $notification->fresh();
        $mappedNotification = $notification->map();
        $this->assertNotNull($mappedNotification['read_at']);
        $this->assertNotNull($mappedNotification['read_at_timestamp']);
        $this->assertNotNull($mappedNotification['read_at_formatted']);
        $this->assertNotNull($mappedNotification['read_at_diff']);

    }

}
