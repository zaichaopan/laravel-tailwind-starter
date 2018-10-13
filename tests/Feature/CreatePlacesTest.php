<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\App\Attachment;
use App\Events\PlaceWasCreated;
use Illuminate\Http\UploadedFile;
use App\Listeners\MovePlaceImages;
use Illuminate\Events\CallQueuedListener;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\{Event, Queue, Storage};

class CreatePlacesTest extends TestCase
{
    use RefreshDatabase, PlaceValidationTests;

    protected function submitForm($overrides = [])
    {
        $this->actingAs($user = factory('App\User')->create());
        return $this->post(route('places.store'), $this->validParams($overrides));
    }

    /** @test */
    public function guest_cannot_view_place_creation_form()
    {
        // 302 is redirect, 401 unauthenticated, unauthorized 403
        $this->get(route('places.create'))->assertStatus(302);
    }

    /** @test */
    public function authenticated_user_can_view_place_creation_form()
    {
        $this->actingAs(factory('App\User')->create());
        $this->get(route('places.create'))
            ->assertStatus(200)
            ->assertViewIs('places.create');
    }

    /** @test */
    public function guest_cannot_post_place_creation_data()
    {
        $this->post(route('places.store', []))->assertStatus(302);
    }

    /** @test */
    public function images_are_optional()
    {
        $this->actingAs(factory('App\User')->create());
        $this->post(route('places.store'), $this->validParams(['images' => null]))->assertSessionHasNoErrors();
    }

    /** @test */
    public function images_must_be_valid_array_of_string_if_provided()
    {
        $this->actingAs(factory('App\User')->create());
        $this->post(route('places.store'), $this->validParams(['images' => 'abc']))->assertSessionHasErrors('images');
        $this->assertEquals('The images must be an array.', session('errors')->first('images'));
        $this->post(route('places.store'), $this->validParams(['images' => []]))->assertSessionHasErrors('images');
        $this->assertEquals('The images must have at least 1 items.', session('errors')->first('images'));
    }

    /** @test */
    public function authenticated_user_can_create_a_place_without_images()
    {
        $this->actingAs($user = factory('App\User')->create());
        $response = $this->post(route('places.store'), $validParams = $this->validParams());
        $this->assertCount(1, $places = $user->places()->get());
        $this->assertArraySubset(
            array_only($validParams, ['address', 'lat', 'lng', 'description']),
            $places->first()->toArray()
        );
    }

    /** @test */
    public function authenticated_user_can_create_a_place_with_images()
    {
        $attachment = factory('App\Attachment')->create();
        $this->actingAs($user = factory('App\User')->create());
        $this->post(route('places.store'), $this->validParams(['images' => [$attachment->path]]));
        $place = $user->places()->first();
        $this->assertCount(1, $images = $place->images);
        $this->assertEquals($attachment->path, $images->first()->path);
    }

    /** @test */
    public function temporary_images_of_a_place_will_be_moved_from_tmp_to_its_root_dir()
    {
        Storage::fake('public');

        $attachment = Attachment::createFromUploadedFile(
            UploadedFile::fake()->create('cover.jpg'),
            config('app.tmp_dir')
        );

        Storage::disk('public')->assertExists($tmpPath = $attachment->path);

        $this->actingAs($user = factory('App\User')->create());
        $this->post(route('places.store'), $this->validParams(['images' => [$tmpPath]]));

        Storage::disk('public')->assertMissing($tmpPath);
        $attachment = $attachment->fresh();

        $this->assertEquals(
            $user->places()->first()->imageRootDir() . '/' . $attachment->name,
            $attachment->path
        );

        storage::disk('public')->assertExists($attachment->path);
    }

    /** @test */
    public function a_place_creation_announcement_is_made_when_a_place_is_created()
    {
        Event::fake();
        $attachment = factory('App\Attachment')->create();
        $this->actingAs($user = factory('App\User')->create());
        $this->post(route('places.store'), $this->validParams(['images' => [$attachment->path]]));
        $place = $user->places()->first();
        Event::assertDispatched(PlaceWasCreated::class, function ($event) use ($place) {
            return $event->place->id === $place->id;
        });
    }

    /** @test */
    public function moving_place_images_to_its_root_is_queued_when_a_place_is_created()
    {
        Queue::fake();
        $attachment = factory('App\Attachment')->create();
        $this->actingAs($user = factory('App\User')->create());
        $this->post(route('places.store'), $this->validParams(['images' => [$attachment->path]]));
        $place = $user->places()->first();
        Queue::assertPushed(CallQueuedListener::class, function ($job) {
            return $job->class == MovePlaceImages::class;
        });
    }

    /** @test */
    public function invalid_images_will_not_be_associated_with_a_place()
    {
        $this->actingAs($user = factory('App\User')->create());
        $this->post(route('places.store'), $this->validParams(['images' => ['none_existing.jpg']]));
        $place = $user->places()->first();
        $this->assertCount(0, $images = $place->images);
    }

    /** @test */
    public function duplicate_images_will_not_be_associated()
    {
        $attachment = factory('App\Attachment')->create();
        $this->actingAs($user = factory('App\User')->create());
        $this->post(route('places.store'), $this->validParams([
            'images' => [$attachment->path, $attachment->path]
         ]));
        $place = $user->places()->first();
        $this->assertCount(1, $images = $place->images);
    }
}
