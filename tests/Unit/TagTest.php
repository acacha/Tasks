<?php

namespace Tests\Unit;

use App\File;
use App\Tag;
use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function map()
    {
        $tag = Tag::create([
            'name' => 'Tag1',
            'color' => 'blue',
            'description' => 'bla bla bla',
        ]);
        $mappedTag = $tag->map();
        $this->assertEquals($mappedTag['id'],1);
        $this->assertEquals($mappedTag['name'],'Tag1');
        $this->assertEquals($mappedTag['description'],'bla bla bla');
        $this->assertNotNull($mappedTag['created_at']);
        $this->assertNotNull($mappedTag['created_at_formatted']);
        $this->assertNotNull($mappedTag['created_at_human']);
        $this->assertNotNull($mappedTag['created_at_timestamp']);
        $this->assertNotNull($mappedTag['updated_at']);
        $this->assertNotNull($mappedTag['updated_at_human']);
        $this->assertNotNull($mappedTag['updated_at_formatted']);
        $this->assertNotNull($mappedTag['updated_at_timestamp']);
        $this->assertEquals($mappedTag['full_search'],'1 Tag1 blue bla bla bla');

    }

    /**
     * @test
     */
    public function can_add_a_task_to_tag()
    {
//        $tag->addTask($task); // On $task vull sigui id o model
//        $tag->addTasks($tasks);  // On $tasks  sigui vector de ids o de model

        // 1 Prepare
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);
        $task2 = Task::create([
            'name' => 'Comprar llet'
        ]);

        $tag = Tag::create([
            'name' => 'home',
            'description' => 'bla bla',
            'color' => 'blue'
        ]);


        // execució
        $tag->addTask($task);

        // Assertion
        $tasks = $tag->tasks;

        $this->assertTrue($tasks[0]->is($task));

        // execució
        $tag->addTask($task2->id);

//        // Assertion
//        $tasks = $tag->tasks;
//        $this->assertTrue($tasks[1]->is($task2));
    }
}
