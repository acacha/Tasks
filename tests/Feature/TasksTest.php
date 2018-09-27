<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    /**
     * @test
     */
    public function todo()
    {
        $this->withoutExceptionHandling();

        //1 Prepare
        Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);

        // 2 execute
        $response = $this->get('/tasks');
//        dd($response->getContent());

        //3 Comprovar
        $response->assertSuccessful();
        $response->assertSee('Tasques');

        // Comprovar que es veuen les tasques que hi ha a la
        // base dades

    }
}
