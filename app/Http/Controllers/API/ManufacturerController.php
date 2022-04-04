<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Resources\ManufacturerResource;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ManufacturerResource::collection(Manufacturer::select('name')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManufacturerRequest $request)
    {
        $validated = $request->validated();

        Manufacturer::create($validated);

        return response()->json(['message' => 'Created'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturer $manufacturer)
    {
        return new ManufacturerResource($manufacturer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(StoreManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $validated = $request->validated();

        Manufacturer::update($validated);

        return response()->json(['message' => 'Updated'], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        $isDeleted = $manufacturer->delete();
        if ($isDeleted) {
            return response()->json(['message' => 'Deleted'], 203);
        }
        return response()->json(['message' => 'Not allowed'], 403);
    }
}
