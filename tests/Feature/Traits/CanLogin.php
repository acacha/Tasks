<?php

namespace Tests\Feature\Traits;

use App\User;

trait CanLogin
{
    protected function login(): void
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
    }
}
