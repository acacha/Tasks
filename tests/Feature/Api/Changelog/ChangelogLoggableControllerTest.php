<?php

namespace Tests\Feature\Tenants\Api\Tasks;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * Class ChangelogLoggableControllerTest.
 *
 * @package Tests\Feature\Tenants\Api
 */
class ChangelogLoggableControllerTest extends TestCase {

    use RefreshDatabase;

    /**
     * @test
     */
    public function show_404_for_an_unexisting_loggable()
    {
        $response = $this->json('GET', '/api/v1/changelog/loggable/incidents/1');
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function guest_users_cannot_list_logs_for_an_specific_loggable()
    {
        $incident = Task::create([
            'subject' => 'No funciona res Aula 3',
            'description' => 'Bla bla bla'
        ]);
        $response = $this->json('GET', '/api/v1/changelog/loggable/incidents/' . $incident->id);
        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function regular_user_cannot_list_logs_for_an_specific_loggable()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user,'api');
        $incident = Task::create([
            'subject' => 'No funciona res Aula 3',
            'description' => 'Bla bla bla'
        ]);
        $response = $this->json('GET', '/api/v1/changelog/loggable/incidents/' . $incident->id);
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function regular_user_can_list_logs_for_an_specific_owned_loggable()
    {
        $logs = sample_logs();
        $user = User::first();
        $this->actingAs($user,'api');
        $incident = Task::first();
        $incident->assignUser($user);
        $response = $this->json('GET', '/api/v1/changelog/loggable/incidents/' . $incident->id);
        $response->assertStatus(200);
        $result = json_decode($response->getContent());
        $this->assertCount(3,$result);
        $this->assertEquals($logs[0]->id,$result[0]->id);
        $this->assertEquals($logs[0]->text,$result[0]->text);
        $this->assertNotNull($result[0]->time);
        $this->assertNotNull($result[0]->human_time);
        $this->assertNotNull($result[0]->timestamp);
        $this->assertEquals($logs[0]->action_type, $result[0]->action_type);
        $this->assertEquals($logs[0]->user_id, $result[0]->user_id);
        $this->assertEquals($logs[0]->user->name, $result[0]->user_name);
        $this->assertEquals($logs[0]->user->email, $result[0]->user_email);
        $this->assertEquals($logs[0]->user->hashid, $result[0]->user_hashid);
        $this->assertEquals($logs[0]->icon, $result[0]->icon);
        $this->assertEquals($logs[0]->color, $result[0]->color);
    }

    /**
     * @test
     */
    public function loggable_manager_can_list_logs_for_an_specific_loggable()
    {
        $logs = sample_logs();
        $user = factory(User::class)->create();
        $role = Role::firstOrCreate(['name' => 'TasksManager']);
        Config::set('auth.providers.users.model', User::class);
        $user->assignRole($role);
        $this->actingAs($user,'api');
        $incident = Task::first();
        $incident->assignUser($user);
        $response = $this->json('GET', '/api/v1/changelog/loggable/incidents/' . $incident->id);
        $response->assertStatus(200);
        $result = json_decode($response->getContent());
        $this->assertCount(3,$result);
        $this->assertEquals($logs[0]->id,$result[0]->id);
        $this->assertEquals($logs[0]->text,$result[0]->text);
        $this->assertNotNull($result[0]->time);
        $this->assertNotNull($result[0]->human_time);
        $this->assertNotNull($result[0]->timestamp);
        $this->assertEquals($logs[0]->action_type, $result[0]->action_type);
        $this->assertEquals($logs[0]->user_id, $result[0]->user_id);
        $this->assertEquals($logs[0]->user->name, $result[0]->user_name);
        $this->assertEquals($logs[0]->user->email, $result[0]->user_email);
        $this->assertEquals($logs[0]->user->hashid, $result[0]->user_hashid);
        $this->assertEquals($logs[0]->icon, $result[0]->icon);
        $this->assertEquals($logs[0]->color, $result[0]->color);
    }

    /**
     * @test
     */
    public function cannot_list_logs_for_an_unexisting_user()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user,'api');

        $response =  $this->json('GET','/api/v1/changelog/user/nonexistinguser');
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function guest_cannot_list_logs_for_an_specific_user()
    {
        $user = factory(User::class)->create();
        $response =  $this->json('GET','/api/v1/changelog/user/' . $user->id);
        $response->assertStatus(401);
    }

}
