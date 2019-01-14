<?php

namespace Tests\Feature\Tenants\Api\Incidents;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BaseTenantTest;
use Illuminate\Contracts\Console\Kernel;

/**
 * Class ChangelogUserControllerTest.
 *
 * @package Tests\Feature\Tenants\Api
 */
class ChangelogUserControllerTest extends BaseTenantTest {

    use RefreshDatabase;

    /**
     * Refresh the in-memory database.
     *
     * @return void
     */
    protected function refreshInMemoryDatabase()
    {
        $this->artisan('migrate',[
            '--path' => 'database/migrations/tenant'
        ]);

        $this->app[Kernel::class]->setArtisan(null);
    }

    /**
     * @test
     */
    public function can_list_logs_for_an_specific_user()
    {
        $logs = sample_logs();
        $user = User::findOrFail(1);
        $this->actingAs($user,'api');

        $response =  $this->json('GET','/api/v1/changelog/user/' . $user->id);
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(1,$result);

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
