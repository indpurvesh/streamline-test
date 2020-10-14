<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $user;

    public function createUser()
    {
        
        User::factory(1)->create([
           'email' => 'test@test.com'
        ]);

        $this->user = User::whereEmail('test@test.com')->first();

        return $this;
    }
}
