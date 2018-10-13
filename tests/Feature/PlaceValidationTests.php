<?php

namespace Tests\Feature;

trait PlaceValidationTests
{
    abstract protected function submitForm($overrides = []);

    protected function validParams($overrides = [])
    {
        return factory('App\Place')
            ->make(array_merge(['user_id' => null], $overrides))
            ->toArray();
    }

    /** @test */
    public function address_is_required()
    {
        $this->submitForm(['address' => null])->assertSessionHasErrors('address');
    }

    /** @test */
    public function latitude_is_optional()
    {
        $this->submitForm(['lat' => null])->assertSessionHasNoErrors();
    }

    /** @test */
    public function latitude_must_be_valid_if_provided()
    {
        $this->submitForm(['lat' => 'abc'])->assertSessionHasErrors('lat');
        $this->assertEquals('The given latitude is not valid.', session('errors')->first('lat'));
        $this->submitForm(['lat' => -91])->assertSessionHasErrors('lat');
        $this->submitForm(['lat' => 91])->assertSessionHasErrors('lat');
        $this->submitForm()->assertSessionHasNoErrors();
    }

    /** @test */
    public function longitude_is_optional()
    {
        $this->submitForm(['lng' => null])->assertSessionHasNoErrors();
    }

    /** @test */
    public function longitude_must_be_valid_if_provided()
    {
        $this->submitForm(['lng' => 'abc'])->assertSessionHasErrors('lng');
        $this->assertEquals('The given longitude is not valid.', session('errors')->first('lng'));
        $this->submitForm(['lng' => -91])->assertSessionHasErrors('lng');
        $this->submitForm(['lng' => 91])->assertSessionHasErrors('lng');
        $this->submitForm()->assertSessionHasNoErrors();
    }

    /** @test */
    public function description_is_required()
    {
        $this->submitForm(['description' => null])->assertSessionHasErrors('description');
    }
}
