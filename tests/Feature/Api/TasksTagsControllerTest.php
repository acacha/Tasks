<?php

namespace Tests\Feature\Api;

use App\Tag;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TasksTagsControllerTest extends TestCase {
    use RefreshDatabase, CanLogin;
    /**
     * @test
     */
    public function can_add_tag_to_task()
    {
        $this->withoutExceptionHandling();
        $this->loginAsTaskManager('api');
        // 1 Prepare
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);

        $tag = Tag::create([
            'name' => 'home',
            'description' => 'bla bla',
            'color' => 'blue'
        ]);
        $tag2 = Tag::create([
            'name' => 'prova',
            'description' => 'bla bla',
            'color' => 'green'
        ]);
        $this->assertCount(0,$task->tags);

        $response = $this->json('PUT','/api/v1/tasks/' . $task->id . '/tags', [
            'tags' => [$tag->id, $tag2->id,'Etiqueta Nova']
        ]);

        $response->assertSuccessful();

        $task = $task->fresh();

        $this->assertCount(3,$task->tags);
        $this->assertEquals('home',$task->tags[0]->name);
        $this->assertTrue($task->tags[0]->is($tag));
        $this->assertEquals($task->tags[0]->id, $tag->id);
        $this->assertEquals('prova',$task->tags[1]->name);
        $this->assertTrue($task->tags[1]->is($tag2));
        $this->assertEquals($task->tags[1]->id, $tag2->id);
        $this->assertEquals('Etiqueta Nova',$task->tags[2]->name);
        $this->assertEquals('grey',$task->tags[2]->color);
        $this->assertNotNull(Tag::where('name','Etiqueta Nova'));

        $response = $this->json('PUT','/api/v1/tasks/' . $task->id . '/tags', [
            'tags' => [$tag->id]
        ]);

        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function can_add_tag_to_task_validation()
    {
        $this->loginAsTaskManager('api');
        // 1 Prepare
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);

        $tag = Tag::create([
            'name' => 'home',
            'description' => 'bla bla',
            'color' => 'blue'
        ]);
        $this->assertCount(0,$task->tags);
        $response = $this->json('PUT','/api/v1/tasks/' . $task->id . '/tags/');

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function regular_user_cannot_add_tag_to_task()
    {
        $this->login('api');
        // 1 Prepare
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);

        $tag = Tag::create([
            'name' => 'home',
            'description' => 'bla bla',
            'color' => 'blue'
        ]);
        $this->assertCount(0,$task->tags);
        $response = $this->json('PUT','/api/v1/tasks/' . $task->id . '/tags/', [
            'tags' => [$tag->id]
        ]);

        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function guest_user_cannot_add_tag_to_task()
    {
        // 1 Prepare
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);

        $tag = Tag::create([
            'name' => 'home',
            'description' => 'bla bla',
            'color' => 'blue'
        ]);
        $this->assertCount(0,$task->tags);
        $response = $this->json('PUT','/api/v1/tasks/' . $task->id . '/tags/', [
            'tags' => [$tag->id]
        ]);

        $response->assertStatus(401);
    }
}
