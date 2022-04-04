<?php

namespace Tests\Unit\Http\Requests;

use App\Models\Manufacturer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManufacturerRequestTest extends TestCase
{
    use RefreshDatabase;

    private $route = 'manufacturer.';

    public function testNameIsRequired()
    {
        $validateTypeField = 'name';
        $brokenRule = null;

        $manufacturer = Manufacturer::factory()->make([$validateTypeField => $brokenRule]);

        $this->postJson(
            route($this->route . 'store'),
            $manufacturer->toArray()
        )->assertJsonValidationErrors($validateTypeField);

        $existsManufacturer = Manufacturer::factory()->create();
        $newManufacturer = Manufacturer::factory()->make([$validateTypeField => $brokenRule]);

        $this->putJson(
            route($this->route . 'update', $existsManufacturer), $newManufacturer->toArray()
        )->assertJsonValidationErrors($validateTypeField);
    }
}
