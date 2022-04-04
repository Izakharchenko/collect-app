<?php declare(strict_types=1);

namespace Tests\Feature\API;

use App\Models\Manufacturer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManufacturerTest extends TestCase
{
    use RefreshDatabase;

    private $route = 'manufacturer.';

    public function testGetAllManufacturers(): void
    {
        $response = $this->getJson(route($this->route . 'index'));
        $response->assertOk()->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                ]
            ]
        ]);
    }

    public function testCanStoreManufacturer(): void
    {
        $manufacturer = Manufacturer::factory()->make();

        $response = $this->postJson(route($this->route . 'store'), $manufacturer->toArray());

        $response->assertCreated();
        $this->assertDatabaseHas('manufacturers', $manufacturer->toArray());
    }

    public function testCanShowManufacture(): void
    {
        $manufacturer = Manufacturer::factory()->create();

        $response = $this->getJson(
            route($this->route . 'show', $manufacturer->id)
        );

        $response
            ->assertOk()
            ->assertExactJson([
                'data' => [
                    'name' => $manufacturer->name
                ]
            ]);
    }

    public function testCanDeleteManufacturer(): void
    {
        $manufacturer = Manufacturer::factory()->create();

        $this->deleteJson(route($this->route . 'destroy', $manufacturer));

        $this->assertModelMissing($manufacturer);
    }
}
