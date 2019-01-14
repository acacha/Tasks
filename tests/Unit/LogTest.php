<?php

use App\Console\Kernel;
use App\Task;
use App\Log;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class LogTest.
 *
 * @package Tests\Unit\Tenants
 */
class LogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function map()
    {
        $user = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);

        $task = Task::create([
            'name' => 'Comprar pa',
        ]);
        $oldTask = clone($task);
        $task->name = 'Comprar llet';
        $task->save();
        $log = Log::create([
            'text' => "Ha creat la tasca $task->name",
            'time' => Carbon::now(),
            'action_type' => 'update',
            'module_type' => 'Tasks',
            'user_id' => $user->id,
            'loggable_id' => $task->id,
            'loggable_type' => Task::class,
            'new_loggable' => $newLoggable = $task->toJson(),
            'old_loggable' => $oldTask->toJson(),
            'new_value' => 'valor nou',
            'old_value' => 'valor àntic',
            'icon' => 'home',
            'color' => 'teal'
        ]);

        $mappedLog = $log->map();

        $this->assertEquals($log->id,$mappedLog['id']);
        $this->assertEquals('Ha creat la tasca Comprar llet',$mappedLog['text']);
        $this->assertNotNull($mappedLog['time']);
        $this->assertNotNull($mappedLog['human_time']);
        $this->assertNotNull($mappedLog['formatted_time']);
        $this->assertNotNull($mappedLog['timestamp']);
        $this->assertEquals('update',$mappedLog['action_type']);
        $this->assertEquals('update',$mappedLog['action']->name);
        $this->assertEquals('Edició',$mappedLog['action']->text);
        $this->assertEquals('edit',$mappedLog['action']->icon);
        $this->assertEquals('Tasks',$mappedLog['module_type']);
//        dump($mappedLog['module']);
        $this->assertEquals('Tasks',$mappedLog['module']->name);
        $this->assertEquals('Tasques',$mappedLog['module']->text);
        $this->assertEquals('build',$mappedLog['module']->icon);
        $this->assertEquals('/tasques',$mappedLog['module']->href);
        $this->assertEquals($user->id,$mappedLog['user_id']);
        $this->assertEquals($task->id,$mappedLog['loggable_id']);

        $this->assertEquals($mappedLog['loggable'], $task->map(false));

        $this->assertEquals($oldTask->toJson(),$mappedLog['old_loggable']);
        $this->assertEquals($newLoggable,$mappedLog['new_loggable']);
        $this->assertEquals($log->old_value,$mappedLog['old_value']);
        $this->assertEquals($log->new_value,$mappedLog['new_value']);
        $this->assertEquals($user->id,$mappedLog['user_id']);
        $this->assertEquals($user->name,$mappedLog['user_name']);
        $this->assertEquals($user->email,$mappedLog['user_email']);
        $this->assertEquals($user->hashid,$mappedLog['user_hashid']);

        $this->assertEquals('home',$mappedLog['icon']);
        $this->assertEquals('teal',$mappedLog['color']);
    }

    /**
     * @test
     */
    public function scopeModule()
    {
        $this->assertCount(0,Log::module('Tasks')->get());
        sample_logs();
        $this->assertCount(3,Log::module('Tasks')->get());
    }

    /**
     * @test
     */
    public function scopeUser()
    {
        $user = factory(User::class)->create();
        $this->assertCount(0,Log::fromUser($user)->get());
        $this->assertCount(0,Log::fromUser($user->id)->get());
        sample_logs();
        $this->assertCount(0,Log::fromUser($user)->get());
        $this->assertCount(0,Log::fromUser($user->id)->get());
        $user2 = User::findOrFail(2);
        $this->assertCount(1,Log::fromUser($user2)->get());
        $this->assertCount(1,Log::fromUser($user2->id)->get());
    }
}
