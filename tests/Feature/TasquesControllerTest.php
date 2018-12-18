<?php

namespace Tests\Feature;

use App\Task;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasquesControllerTest extends TestCase
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
        $this->withoutExceptionHandling();
        create_example_tasks_with_tags();

        $user  = $this->loginAsSuperAdmin();
        $response = $this->get('/tasques');
        $response->assertSuccessful();
        $response->assertViewIs('tasques');
        $response->assertViewHas('tasks', function($tasks) {
            return count($tasks)===6 &&
                $tasks[0]['name']==='comprar pa' &&
                $tasks[1]['name']==='comprar llet' &&
                $tasks[2]['name']==='Estudiar PHP';
        });
        $response->assertViewHas('users', function($users) use ($user) {
            return count($users)===3 &&
                $users[2]['id']=== $user->id &&
                $users[2]['name']=== $user->name &&
                $users[2]['email']=== $user->email &&
                $users[2]['gravatar']=== $user->gravatar &&
                $users[2]['admin']=== $user->admin;
        });
        $response->assertViewHas('tags', function($tags) use ($user) {
            return count($tags)===2 &&
                $tags[0]['id']=== 1 &&
                $tags[0]['name']=== 'Tag1' &&
                $tags[0]['description']=== 'bla bla bla' &&
                $tags[0]['color']=== 'blue';
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
            return count($tasks)===6 &&
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
