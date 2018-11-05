<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends TestCase
{
    /** @test */
    public function can_register_a_user()
    {

        // Afegir register_alt a fitxer routers/web.php
        // Afegir Controller RegisterAltController i metode store
        // Dins del store:
        // 1) Objecte Request per la validació
        // 2) User::Create
        // 3) Login
        // 4) Redirect a /home

        $this->assertNull(Auth::user());
        // Execution
        $response = $this->post('/register_alt', $user = [
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNotNull(Auth::user());

        // Comprovat s'ha creat el usuari
        $this->assertEquals($user->email,Auth::user()->email);
        $this->assertEquals($user->name,Auth::user()->name);
        $this->assertEquals(bcrypt($user->password),Auth::user()->password);
    }
}
