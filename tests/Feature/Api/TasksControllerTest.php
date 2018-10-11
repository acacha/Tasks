<?php

namespace Tests\Feature\Api;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase;

    // CRUD -> CRU -> CREATE RETRIEVE UPDATE DELETE
    // BREAD -> PA -> BROWSE READ EDIT ADD DELETE
    /**
     * @test
     */
    public function can_show_a_task()
    {
        $this->withoutExceptionHandling();
        // routes/api.php
        // http://tasks.test/api/v1/tasks
        // HTTP -> GET | POST | PUT | DELETE

        // 1 PREPARE
        // Task:create()
        $task = factory(Task::class)->create();

        // 2
        $response = $this->get('/api/v1/tasks/' . $task->id);

        $result = json_decode($response->getContent());

        // 3
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->completed, (boolean) $result->completed);

    }

}