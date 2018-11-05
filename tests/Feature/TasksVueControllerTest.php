<?php

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TasksVueControllerTest extends TestCase{
    use RefreshDatabase,CanLogin;

    /**
     * @test
     */
    public function can_show_vue_tasks()
    {
        $this->login();
        create_example_tasks();

        // 2 EXECUTE
        $response = $this->get('/tasks_vue');

        // 3 ASSERT
        $response->assertSuccessful();

        $response->assertViewIs('tasks_vue');
        $response->assertViewHas('tasks',Task::all());


    }
}
