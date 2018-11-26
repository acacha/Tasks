<?php

namespace Tests\Feature\Api;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function task_manager_can_show_a_task()
    {
        $this->loginAsTaskManager('api');
        $task = factory(Task::class)->create();

        $response = $this->json('GET','/api/v1/tasks/' . $task->id);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->completed, (boolean) $result->completed);
    }

    /**
     * @test
     */
    public function superadmin_can_show_a_task()
    {
        $this->loginAsSuperAdmin('api');
        $task = factory(Task::class)->create();

        $response = $this->json('GET','/api/v1/tasks/' . $task->id);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->completed, (boolean) $result->completed);
    }

    /**
     * @test
     */
    public function regular_user_cannot_show_a_task()
    {
        $this->login('api');
        $task = factory(Task::class)->create();

        $response = $this->json('GET','/api/v1/tasks/' . $task->id);
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function tasks_manager_can_delete_task()
    {
        $this->loginAsTaskManager('api');
        $task = factory(Task::class)->create();

        $response = $this->json('DELETE','/api/v1/tasks/' . $task->id);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($result->name, $task->name);

        $this->assertNull(Task::find($task->id));
    }

    /**
     * @test
     */
    public function superadmin_can_delete_task()
    {
        $this->loginAsSuperAdmin('api');
        $task = factory(Task::class)->create();

        $response = $this->json('DELETE','/api/v1/tasks/' . $task->id);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($result->name, $task->name);

        $this->assertNull(Task::find($task->id));
    }

    /**
     * @test
     */
    public function user_can_delete_owned_task()
    {
        $user = $this->login('api');
        $task = factory(Task::class)->create();
        $task->assignUser($user);
        $response = $this->json('DELETE','/api/v1/tasks/' . $task->id);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($result->name, $task->name);

        $this->assertNull(Task::find($task->id));
    }

    /**
     * @test
     */
    public function regular_user_cannot_delete_task()
    {
        $this->login('api');
        $task = factory(Task::class)->create();

        $response = $this->json('DELETE','/api/v1/tasks/' . $task->id);

        $result = json_decode($response->getContent());
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function cannot_create_tasks_without_name()
    {
//        $this->loginAsTaskManager('api');
        $this->loginWithPermission('api','tasks.store');
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
//        $this->withoutExceptionHandling();
        $user = $this->login('api');
//        $user->name = 'Sergi Tur Badenas';
//        $user->save();
        // TODO assign permission to $user
//        $user->givePermissionTo('task.store');

//        Gate::define('task.store',function($user) {
////            return $user->name === 'Sergi Tur Badenas';
////            dd($user->name);
//            dd('PROVA');
//        });


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
        $this->login('api');

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
        $this->login('api');

        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet'
        ]);

        // 2
        $response = $this->json('PUT','/api/v1/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa'
        ]);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();

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
        $this->login('api');

        $oldTask = factory(Task::class)->create();
        $response = $this->json('PUT','/api/v1/tasks/' . $oldTask->id, [
            'name' => ''
        ]);

        $response->assertStatus(422);
    }
}
