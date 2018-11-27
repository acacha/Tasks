<?php

namespace Tests\Feature;

use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function guest_user_cannot_show_tags()
    {
        $response = $this->get('/tags');
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function regular_user_cannot_show_tags()
    {
        $this->login();
        $response = $this->get('/tags');
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function superadmin_can_show_tags()
    {
        $this->loginAsSuperAdmin();
        create_example_tags();
        $response = $this->get('/tags');
        $response->assertSuccessful();
        $response->assertViewIs('tags');
        $response->assertViewHas('tags',function ($tags) {
            return count($tags) === 3 &&
                $tags[0]['name'] === 'Tag1' &&
                $tags[1]['name'] === 'Tag2' &&
                $tags[2]['name'] === 'Tag3';
        });
    }

    /**
     * @test
     */
    public function tags_manager_can_show_tags()
    {
        $this->loginAsTagsManager();
        create_example_tags();
        $this->login();
        $response = $this->get('/tags');
        $response->assertSuccessful();
        $response->assertSee('Tasques');

        $response->assertSee('comprar pa');
        $response->assertSee('comprar llet');
        $response->assertSee('Estudiar PHP');
    }

    /**
     * @test
     */
    public function users_with_role_tasks_can_show_tags()
    {
//        $this->withoutExceptionHandling();

        create_example_tags();
        $this->login();
        $response = $this->get('/tags');
        $response->assertSuccessful();
        $response->assertSee('Tasques');

        $response->assertSee('comprar pa');
        $response->assertSee('comprar llet');
        $response->assertSee('Estudiar PHP');
    }
}
