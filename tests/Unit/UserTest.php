<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Stubs\FakeModel;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_check_if_user_owns_a_model()
    {
        $user = factory('App\User')->create();
        $fakeModel = new FakeModel();
        $this->assertFalse($user->owns($fakeModel));
        $fakeModel->user_id = $user->id;
        $this->assertTrue($user->owns($fakeModel));
    }
}
