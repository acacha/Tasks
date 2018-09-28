<?php

// PSR-4
namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_show_tasks()
    {
//        $this->withoutExceptionHandling();

        //1 Prepare
        Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);

        Task::create([
            'name' => 'comprar llet',
            'completed' => false
        ]);

        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => false
        ]);

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
//        $this->withoutExceptionHandling();

        $response = $this->post('/tasks',[
            'name' => 'Comprar llet'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('tasks',['name' => 'Comprar llet']);

    }

    /**
     * @test
     */
    public function cannnot_delete_an_unexisting_task()
    {
        $response = $this->delete('/tasks/1');
        $response->assertStatus(404);
    }

    /**
     * @test
     */
//    public function user_without_permissions_cannnot_delete_tasks()
//    {
//        $response = $this->delete('/tasks/1');
//        $response->assertStatus(403);
//    }


    /**
     * @test
     */
    public function can_delete_task()
    {
        $this->withoutExceptionHandling();

        // 1
        $task = Task::create([
            'name' => 'Comprar llet'
        ]);

        // 2
        $response = $this->delete('/tasks/' . $task->id);

        // 3
        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks',['name' => 'Comprar llet']);

    }
}
