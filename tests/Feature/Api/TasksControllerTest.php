<?php

namespace Tests\Feature\Api;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_show_a_task()
    {
        $task = factory(Task::class)->create();

        $response = $this->json('GET','/api/v1/tasks/' . $task->id);

        $result = json_decode($response->getContent());
        dd($result);
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->completed, (boolean) $result->completed);
    }

    /**
     * @test
     */
    public function can_delete_task()
    {
        // 1
        $task = factory(Task::class)->create();

        // 2
        $response = $this->json('DELETE','/api/v1/tasks/' . $task->id);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('', $result);

//        $this->assertDatabaseMissing('tasks', $task);
        $this->assertNull(Task::find($task->id));
    }

    /**
     * @test
     */
    public function cannot_create_tasks_without_name()
    {
        // Peticions HTTP és normal no és XHR -> Ajax
//        $response = $this->post('/api/v1/tasks/',[
//            'name' => ''
//        ]);
        // XHR -> JSON
        $response = $this->json('POST','/api/v1/tasks/',[
            'name' => ''
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function can_create_task()
    {
        $response = $this->json('POST','/api/v1/tasks/',[
            'name' => 'Comprar pa'
        ]);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();

//        $this->assertDatabaseHas('tasks', [ 'name' => 'Comprar pa' ]);
        $this->assertNotNull($task = Task::find($result->id));
        $this->assertEquals('Comprar pa',$result->name);
        $this->assertFalse($result->completed);
    }

    /**
     * @test
     */
    public function can_list_tasks()
    {
        //1
        create_example_tasks();

        $response = $this->json('GET','/api/v1/tasks');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertCount(3,$result);

        $this->assertEquals('comprar pa', $result[0]->name);
        $this->assertFalse((boolean)$result[0]->completed);

        $this->assertEquals('comprar llet', $result[1]->name);
        $this->assertFalse((boolean) $result[1]->completed);

        $this->assertEquals('Estudiar PHP', $result[2]->name);
        $this->assertTrue((boolean) $result[2]->completed);
    }

    /**
     * @test
     */
    public function can_edit_task()
    {
        // 1
        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet'
        ]);

        // 2
        $response = $this->json('PUT','/api/v1/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa'
        ]);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();

//        $this->assertDatabaseMissing('tasks', $oldTask);
//        $this->assertDatabaseHas('tasks', $newtask);

        $newTask = $oldTask->refresh();
        $this->assertNotNull($newTask);
        $this->assertEquals('Comprar pa',$result->name);
        $this->assertFalse((boolean) $newTask->completed);
    }

    /**
     * @test
     */
    public function cannot_edit_task_without_name()
    {
        // 1
        $oldTask = factory(Task::class)->create();

        // 2
        $response = $this->json('PUT','/api/v1/tasks/' . $oldTask->id, [
            'name' => ''
        ]);

        // 3
        $response->assertStatus(422);
    }


}
