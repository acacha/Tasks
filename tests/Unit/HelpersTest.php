<?php

namespace Tests\Unit;

use Tests\TestCase;

class HelpersTest extends TestCase
{
    /**
     * @test
     */
    public function create_primary_user()
    {
        create_primary_user();

        $user = User::where('email','sergiturbadenas@gmail.com')->first();

        $this->assertEquals($user->name, 'Sergi Tur Badenas');
        $this->assertEquals($user->email, 'sergiturbadenas@gmail.com');
        $this->assertEquals($user->password, env('PRIMARY_USER_PASSWORD','123456'));
    }
}
