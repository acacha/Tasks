<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_register_a_user()
    {
        $this->withoutExceptionHandling();
        initialize_roles();
        $this->assertNull(Auth::user());
        // Execution
        $response = $this->post('/register', $user = [
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/home');

        // Comprovat s'ha creat el usuari
        $this->assertEquals($user['email'],Auth::user()->email);
        $this->assertEquals($user['name'],Auth::user()->name);
//        $this->assertEquals(bcrypt($user['password']),Auth::user()->password);

        $this->assertNotNull(Auth::user());

        $this->assertTrue(Hash::check($user['password'],Auth::user()->password));

        $this->assertTrue(Auth::user()->hasRole('Tasks'));
    }
}
