<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePlacesTest extends TestCase
{
    use RefreshDatabase, PlaceValidationTests;

    protected function submitForm($overrides = [])
    {
        $user = factory('App\User')->create();
        $place = factory('App\Place')->create(['user_id' => $user->id]);
        $this->actingAs($user);
        return $this->put(route('places.update', $place), $this->validParams($overrides));
    }

    /** @test */
    public function guest_cannot_view_place_update_from()
    {
        $place = factory('App\Place')->create();
        $this->get(route('places.edit', $place))->assertStatus(302);
    }

    /** @test */
    public function none_owner_cannot_view_place_update_form()
    {
        $this->actingAs(factory('App\User')->create());
        $place = factory('App\Place')->create();
        $this->get(route('places.edit', $place))->assertStatus(403);
    }

    /** @test */
    public function owner_can_view_their_own_update_place_form()
    {
        $user = factory('App\User')->create();
        $place = factory('App\Place')->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $this->get(route('places.edit', $place))->assertViewIs('places.edit');
    }

    /** @test */
    public function owner_can_update_their_places()
    {
        $this->withoutExceptionHandling();
        $user = factory('App\User')->create();
        $place = factory('App\Place')->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $this->put(route('places.update', $place), $validParams = $this->validParams());
        $this->assertArraySubset(
            array_only($validParams, ['address', 'lat', 'lng', 'description']),
            $place->fresh()->toArray()
        );
    }
}
