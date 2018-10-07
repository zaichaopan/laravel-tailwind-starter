<?php

namespace Tests\Unit\Middlewares;

use Tests\TestCase;
use Tests\Stubs\FakeModel;
use Illuminate\Http\Request;
use App\Http\Middleware\RedirectIfNotOwner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RedirectIfNotOwnerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_will_be_redirect_back()
    {
        $redirectIfNotOwner = new RedirectIfNotOwner;
        $request = Request::create('/need_to_be_owner', 'GET');
        $response = $redirectIfNotOwner->handle($request, function () {
        }, '');
        $this->assertEquals(302, $response->getStatusCode());
    }

    /** @test */
    public function request_will_be_redirect_back_if_an_eloquent_model_cannot_retrieved()
    {
        $this->actingAs(factory('App\User')->create());
        $redirectIfNotOwner = new RedirectIfNotOwner;
        $request = Request::create('/need_tob_be_owner', 'GET');
        $request->model = 'invalid';
        $response = $redirectIfNotOwner->handle($request, function () {
        }, 'model');
        $this->assertEquals(302, $response->getStatusCode());
    }

    /** @test */
    public function none_owner_will_get_403()
    {
        $user = factory('App\User')->create();
        $mockedUser = \Mockery::mock($user);
        $mockedUser->shouldReceive('owns')->andReturn(false);
        $request = Request::create('/need_to_be_owner', 'GET');
        $mockedRequest = \Mockery::mock($request);
        $mockedRequest->shouldReceive('user')->andReturn($mockedUser);
        $mockedRequest->model = new FakeModel();
        $redirectIfNotOwner = new RedirectIfNotOwner;
        // abort response status code is different from exception get code
        try {
            $response = $redirectIfNotOwner->handle($mockedRequest, function () {
            }, 'model');
        } catch (\Exception $e) {
            $this->assertEquals(new HttpException(403, 'Unauthorized action!'), $e);
        }
    }

    /** @test */
    public function owner_can_process_to_next()
    {
        $user = factory('App\User')->create();
        $mockedUser = \Mockery::mock($user);
        $mockedUser->shouldReceive('owns')->andReturn(true);
        $request = Request::create('/need_to_be_owner', 'GET');
        $mockedRequest = \Mockery::mock($request);
        $mockedRequest->shouldReceive('user')->andReturn($mockedUser);
        $mockedRequest->model = new FakeModel();
        $redirectIfNotOwner = new RedirectIfNotOwner;
        $response = $redirectIfNotOwner->handle($mockedRequest, function () {
        }, 'model');
        $this->assertEquals(null, $response);
    }
}
