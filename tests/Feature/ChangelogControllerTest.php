<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * Class ChangelogControllerTest.
 *
 * @package Tests\Feature
 */
class ChangelogControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_changelog()
    {
//        $this->withoutExceptionHandling();
        $logs = sample_logs();
        $user = factory(User::class)->create();
        $role = Role::firstOrCreate(['name' => 'ChangelogManager']);
        $user->assignRole($role);
        $this->actingAs($user);
        $response = $this->get('/changelog');
        $response->assertSuccessful();
        $response->assertViewIs('changelog.index');
        $response->assertViewHas('logs', function ($returnedLogs) use ($logs) {
            return
                $returnedLogs[0]['user_name']=== $logs[0]['user']->name &&
                $returnedLogs[0]['color'] === 'teal' &&
                $returnedLogs[0]['action_type'] === 'store' &&
                $returnedLogs[0]['text'] === "Ha creat la tasca TODO_LINK_TASCA" &&
                $returnedLogs[0]['icon'] === 'home' &&
                $returnedLogs[1]['text'] === "Ha modificat la tasca TODO_LINK_TASCA" &&
                $returnedLogs[1]['action_type'] === 'update' &&
                $returnedLogs[2]['text'] === "Ha modificat la tasca TODO_LINK_TASCA" &&
                $returnedLogs[2]['action_type'] === 'update' &&
                $returnedLogs[3]['text'] === "BLA BLA BLA";
        });
        $response->assertViewHas('users');
    }

    /** @test */
    public function guest_cannot_show_changelog()
    {
        $response = $this->get('/changelog');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function regular_user_cannot_show_changelog()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get('/changelog');
        $response->assertStatus(403);
    }

}
