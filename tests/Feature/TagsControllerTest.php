<?php

namespace Tests\Feature;

use App\Task;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function guest_user_cannot_index_tags()
    {
        $response = $this->get('/tags');
        $response->assertRedirect('login');
    }

    /**
     * @test
     */
    public function regular_user_cannot_index_tags()
    {
        $this->login();
        $response = $this->get('/tags');
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function superadmin_can_index_tags()
    {
        create_example_tags();

        $user  = $this->loginAsSuperAdmin();
        $response = $this->get('/tags');
        $response->assertSuccessful();
        $response->assertViewIs('tags');
        $response->assertViewHas('tags', function($tags) {
            return count($tags)===3 &&
                $tags[0]['name']==='Tag1' &&
                $tags[1]['name']==='Tag2' &&
                $tags[2]['name']==='Tag3';
        });
    }

    /**
     * @test
     */
    public function tag_manager_can_index_tags()
    {
        create_example_tags();

        $this->loginAsTagsManager();
        $response = $this->get('/tags');
        $response->assertSuccessful();
        $response->assertViewIs('tags');
        $response->assertViewHas('tags', function($tags) {
            return count($tags)===3 &&
                $tags[0]['name']==='Tag1' &&
                $tags[1]['name']==='Tag2' &&
                $tags[2]['name']==='Tag3';
        });
    }

    /**
     * @test
     */
    public function tags_user_cannot_index_tags()
    {
        create_example_tags();

        $user = $this->loginAsTasksUser();
        Task::create([
            'name' => 'Tasca usuari logat',
            'completed' => false,
            'description' => 'Jorl',
            'user_id' => $user->id
        ]);

        $response = $this->get('/tags');
        $response->assertStatus(403);
    }
}
