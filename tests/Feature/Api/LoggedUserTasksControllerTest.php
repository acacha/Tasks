<?php

namespace Tests\Feature\Api;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class LoggedUserTasksControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function can_list_logged_user_tasks()
    {
        $this->withoutExceptionHandling();
        // 1 Preparació
        $user = $this->login('api');

        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();

        $tasks = [$task1,$task2,$task3];
        $user->addTasks($tasks);

        // 2 execute
        $response = $this->json('GET','/api/v1/user/tasks');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertCount(3,$result);
        $this->assertEquals($result[0]->id, $task1->id);
        $this->assertEquals($result[1]->id, $task2->id);
        $this->assertEquals($result[2]->id, $task3->id);
    }

    /**
     * @test
     */
    public function cannot_list_logged_user_tasks_if_user_is_not_logged()
    {
        $this->markTestSkipped('TODO');
        $this->login();
        $response = $this->json('GET','/user/tasks');
        $response->assertStatus(401);
    }
}
