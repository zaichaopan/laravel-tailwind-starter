<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadPlaceImagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_upload_images_to_a_place()
    {
        $place = factory('App\Place')->create();
        $this->postJson(route('places.images.store', $place))->assertStatus(401);
    }

    /** @test */
    public function none_owner_cannot_upload_images_to_a_place()
    {
        $place = factory('App\Place')->create();
        $this->actingAs(factory('App\User')->create(), 'api');
        $this->postJson(route('places.images.store', $place))->assertStatus(403);
    }

    /** @test */
    public function owner_can_upload_images_to_a_place()
    {
        Storage::fake('public');
        $image = UploadedFile::fake()->image('avatar.jpg');
        $this->actingAs($user = factory('App\User')->create(), 'api');
        $place = factory('App\Place')->create(['user_id' => $user->id]);
        $this->assertCount(0, $place->images);
        $this->postJson(route('places.images.store', $place), ['image' => $image]);
        $this->assertCount(1, $images = $place->fresh()->images);
        storage::disk('public')->assertExists($images->first()->path);
    }
}
