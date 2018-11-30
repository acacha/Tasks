<?php

namespace Tests\Feature;

use App\Task;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function guest_user_cannot_index_tasks()
    {
        $response = $this->get('/tasques');
        $response->assertRedirect('login');
    }

    /**
     * @test
     */
    public function regular_user_cannot_index_tasks()
    {
        $this->login();
        $response = $this->get('/tasques');
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function superadmin_can_index_tasks()
    {
        create_example_tasks();

        $this->loginAsSuperAdmin();
        $response = $this->get('/tasques');
        $response->assertSuccessful();
        $response->assertViewIs('tasques');
        $response->assertViewHas('tasks', function($tasks) {
            return count($tasks)===3 &&
                $tasks[0]['name']==='comprar pa' &&
                $tasks[1]['name']==='comprar llet' &&
                $tasks[2]['name']==='Estudiar PHP';
        });
    }

    /**
     * @test
     */
    public function task_manager_can_index_tasks()
    {
        create_example_tasks();

        $this->loginAsTaskManager();
        $response = $this->get('/tasques');
        $response->assertSuccessful();
        $response->assertViewIs('tasques');
        $response->assertViewHas('tasks', function($tasks) {
            return count($tasks)===3 &&
                $tasks[0]['name']==='comprar pa' &&
                $tasks[1]['name']==='comprar llet' &&
                $tasks[2]['name']==='Estudiar PHP';
        });
    }

    /**
     * @test
     */
    public function tasks_user_can_index_tasks()
    {
        create_example_tasks();

        $user = $this->loginAsTasksUser();
        Task::create([
            'name' => 'Tasca usuari logat',
            'completed' => false,
            'description' => 'Jorl',
            'user_id' => $user->id
        ]);

        $response = $this->get('/tasques');
        $response->assertSuccessful();

        $response->assertViewIs('tasques');
        $response->assertViewHas('tasks', function($tasks) {
            return count($tasks)===1 &&
                $tasks[0]['name']==='Tasca usuari logat';
        });
        $response->assertViewHas('users');
        $response->assertViewHas('uri');
    }
}
