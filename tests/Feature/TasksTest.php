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
        $response = $this->get('/tasks');
//        dd($response->getContent());

        $response->assertSuccessful();
        $response->assertSee('Tasques');

    }
}
