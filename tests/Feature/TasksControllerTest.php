<?php

// PSR-4
namespace Tests\Feature;

use App\Task;
use App\User;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function can_show_tasks()
    {
//        $this->withoutExceptionHandling();

        //1 Prepare
        create_example_tasks();

        $this->login();

//        $this->actingAs($user,'api');


//        dd(Task::find(1));

        // 2 execute
        $response = $this->get('/tasks');
//        dd($response->getContent());

        //3 Comprovar
        $response->assertSuccessful();
        $response->assertSee('Tasques');

        $response->assertSee('comprar pa');
        $response->assertSee('comprar llet');
        $response->assertSee('Estudiar PHP');

        // Comprovar que es veuen les tasques que hi ha a la
        // base dades

    }

    /**
     * @test
     */
    public function can_store_task()
    {
        $this->login();
        $response = $this->post('/tasks',[
            'name' => 'Comprar llet'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('tasks',['name' => 'Comprar llet']);
    }

    /**
     * @test
     */
    public function cannot_delete_an_unexisting_task()
    {
        $this->login();
        $response = $this->delete('/tasks/1');
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_delete_task()
    {
        $this->login();

        $task = Task::create([
            'name' => 'Comprar llet'
        ]);

        $response = $this->delete('/tasks/' . $task->id);

        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks',['name' => 'Comprar llet']);

    }

    /**
     * @test
     */
    public function can_edit_a_task()
    {
        $this->login();
        $task = Task::create([
            'name' => 'asdasdasd',
            'completed' => false
        ]);
        $response = $this->put('/tasks/' . $task->id,$newTask = [
            'name' => 'Comprar pa',
            'completed' => true
        ]);
        $response->assertStatus(302);

        $task = $task->fresh();
        $this->assertEquals($task->name,'Comprar pa');
        $this->assertEquals($task->completed,true);
    }
    
    /**
     * @test
     */
    public function cannot_edit_an_unexisting_task()
    {
        $this->login();
        $response = $this->put('/tasks/1',[]);
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_show_edit_form()
    {
        $this->login();
        $task = Task::create([
            'name' => 'Comprar pa',
            'completed' => false
        ]);
        $response = $this->get('/task_edit/' . $task->id);
        $response->assertSuccessful();

        $response->assertSee('Comprar pa');
    }

    /**
     * @test
     */
    public function cannot_show_edit_form_unexisting_task()
    {
        $this->login();
        $response = $this->get('/task_edit/1');
        $response->assertStatus(404);
    }
}
