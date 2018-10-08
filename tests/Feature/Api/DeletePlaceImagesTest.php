<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Facades\App\Attachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeletePlaceImagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_delete_a_place_image()
    {
        $place = factory('App\Place')->create();
        $this->deleteJson(route('places.images.destroy', ['place' => $place, 'image' => 'valid_image.jpg']))->assertStatus(401);
    }

    /** @test */
    public function none_owner_can_delete_a_place_image()
    {
        $place = factory('App\Place')->create();
        $this->actingAs(factory('App\User')->create(), 'api');
        $this->deleteJson(route('places.images.destroy', ['place' => $place, 'image' => 'valid_image.jpg']))->assertStatus(403);
    }

    /** @test */
    public function owner_can_delete_a_place_image()
    {
        Storage::fake('public');
        $image = UploadedFile::fake()->create('cover.jpg');
        $user = factory('App\User')->create();
        $place = factory('App\Place')->create(['user_id' => $user->id]);
        $attachment = Attachment::createFromUploadedFile($image, 'places/' . $place->id);
        $place->images()->save($attachment);
        $path = $attachment->path;
        storage::disk('public')->assertExists($path);
        $this->actingAs($user, 'api');
        $this->deleteJson(route('places.images.destroy', ['place' => $place]), ['path' => $path]);

        $this->assertCount(0, $place->fresh()->images);
        storage::disk('public')->assertMissing($path);
    }

    /** @test */
    public function it_can_handle_when_image_with_given_path_not_found()
    {
        $user = factory('App\User')->create();
        $place = factory('App\Place')->create(['user_id' => $user->id]);
        $this->actingAs($user, 'api');
        $response = $this->deleteJson(route('places.images.destroy', ['place' => $place]), ['path' => 'none_existing.jpg'])->assertStatus(200);
    }
}
