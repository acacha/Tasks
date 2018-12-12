<?php

namespace Tests\Unit;

use App\Mail\TestDinamicEmail;
use App\Mail\TestEmail;
use App\Mail\TestTextEmail;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase {
    use RefreshDatabase;

    /**
     * @test
     */
    public function send_markdown_email()
    {
        $user = factory(User::class)->create();
        Mail::to($user)->send(new TestEmail());
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function send_markdown_email_dinamic()
    {
        $user = factory(User::class)->create();
        Mail::to($user)->send(new TestDinamicEmail($user));
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function send_test_email()
    {
        $user = factory(User::class)->create();
        Mail::to($user)->send(new TestTextEmail());
        $this->assertTrue(true);
    }
}
