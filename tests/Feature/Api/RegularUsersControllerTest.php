<?php

namespace Tests\Feature\Api;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegularUsersControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_list_regular_users()
    {
        $user1 = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);
        $user2 = factory(User::class)->create([
            'name' => 'Pepa Parda Jeans',
            'email' => 'pepaparda@jeans.com'
        ]);
        $user3 = factory(User::class)->create([
            'name' => 'Pepa Pig',
            'email' => 'pepapig@dibus.com'
        ]);
        $user3->admin = true;
        $user3->save();
        $this->actingAs($user1,'api');
        $response = $this->json('GET','/api/v1/regular_users');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(2,$result);
        $this->assertEquals($result[0]->name,'Pepe Pardo Jeans');
        $this->assertEquals($result[0]->email,'pepepardo@jeans.com');
        $this->assertEquals($result[0]->avatar,'https://www.gravatar.com/avatar/' . md5('pepepardo@jeans.com'));
        $this->assertEquals($result[1]->name,'Pepa Parda Jeans');
        $this->assertEquals($result[1]->email,'pepaparda@jeans.com');
        $this->assertEquals($result[1]->avatar,'https://www.gravatar.com/avatar/' . md5('pepaparda@jeans.com'));
//        $this->assertNull($result[2]);
    }
}
