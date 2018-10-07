<?php

namespace Tests\Feature;

trait PlaceValidationTests
{
    abstract protected function submitValidation($overrides = []);

    protected function validParams($overrides = [])
    {
        return factory('App\Place')->make(array_merge([
            'user_id' => null
        ], $overrides))->toArray();
    }

    /** @test */
    public function address_is_required()
    {
        $this->submitValidation(['address' => null])->assertSessionHasErrors('address');
    }

    /** @test */
    public function latitude_is_optional()
    {
        $this->submitValidation(['lat' => null])->assertSessionHasNoErrors();
    }

    /** @test */
    public function latitude_must_be_valid_if_provided()
    {
        $this->submitValidation(['lat' => 'abc'])->assertSessionHasErrors('lat');
        $this->assertEquals('The given latitude is not valid.', session('errors')->first('lat'));
        $this->submitValidation(['lat' => -91])->assertSessionHasErrors('lat');
        $this->submitValidation(['lat' => 91])->assertSessionHasErrors('lat');
        $this->submitValidation()->assertSessionHasNoErrors();
    }

    /** @test */
    public function longitude_is_optional()
    {
        $this->submitValidation(['lng' => null])->assertSessionHasNoErrors();
    }

    /** @test */
    public function longitude_must_be_valid_if_provided()
    {
        $this->submitValidation(['lng' => 'abc'])->assertSessionHasErrors('lng');
        $this->assertEquals('The given longitude is not valid.', session('errors')->first('lng'));
        $this->submitValidation(['lng' => -91])->assertSessionHasErrors('lng');
        $this->submitValidation(['lng' => 91])->assertSessionHasErrors('lng');
        $this->submitValidation()->assertSessionHasNoErrors();
    }

    /** @test */
    public function description_is_required()
    {
        $this->submitValidation(['description' => null])->assertSessionHasErrors('description');
    }
}
