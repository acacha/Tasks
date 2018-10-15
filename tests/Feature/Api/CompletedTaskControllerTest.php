<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompletedTaskControllerTest extends TestCase {
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_complete_a_task()
    {
        //1
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);
        //2
        $response = $this->json('POST','/completed_task/' . $task->id);
        //3 Dos opcions: 1) Comprovar base de dades directament
        // 2) comprovar canvis al objecte $task
        $task = $task->fresh();
        $this->assertEquals($task->completed, true);
    }

    /**
     * @test
     */
    public function cannot_complete_a_unexisting_task()
    {
        $response = $this->json('POST','/completed_task/1');
        //3 Assert
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_uncomplete_a_task()
    {
        //1
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => true
        ]);
        //2
        $response = $this->json('DELETE','/completed_task/' . $task->id);
        //3 Dos opcions: 1) Comprovar base de dades directament
        // 2) comprovar canvis al objecte $task
        $task = $task->fresh();
        $this->assertEquals($task->completed, false);
    }

    /**
     * @test
     */
    public function cannot_uncomplete_a_unexisting_task()
    {
        // 1 -> no cal fer res
        // 2 Execute
        $response= $this->delete('/completed_task/1');
        //3 Assert
        $response->assertStatus(404);
    }
}