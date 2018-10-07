<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\App\Attachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeletePlacesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_delete_a_place()
    {
        $this->delete(route('places.destroy', 1))->assertStatus(302);
    }

    /** @test */
    public function none_owner_can_delete_a_place()
    {
        $place = factory('App\Place')->create();
        $this->actingAs(factory('App\User')->create());
        $this->delete(route('places.destroy', $place))->assertStatus(403);
    }

    /** @test */
    public function owner_can_delete_his_own_place()
    {
        $this->actingAs($user = factory('App\User')->create());
        $place = factory('App\Place')->create(['user_id' => $user->id]);
        $this->delete(route('places.destroy', $place))->assertStatus(302);
        $this->assertCount(0, $user->fresh()->places);
    }

    /** @test */
    public function place_images_will_be_remove_after_it_gets_deleted()
    {
        Storage::fake('public');

        $user = factory('App\User')->create();
        $place = factory('App\Place')->create(['user_id' => $user->id]);

        $attachment = Attachment::createFromUploadedFile(
            $image = UploadedFile::fake()->create('cover.jpg'),
            'places/' . $place->id
        );

        $place->images()->save($attachment);
        storage::disk('public')->assertExists($attachment->path);

        $this->actingAs($user, 'api');
        $this->delete(route('places.destroy', $place));

        $this->assertCount(0, $user->fresh()->places);
        Storage::disk('public')->assertMissing($attachment->path);
    }
}
