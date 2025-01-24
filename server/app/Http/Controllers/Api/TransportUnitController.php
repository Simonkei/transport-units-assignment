<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransportUnit;
use App\Http\Requests\StoreTransportUnitRequest;
use App\Http\Requests\UpdateTransportUnitRequest;
use App\Http\Resources\TransportUnitResource;

class TransportUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TransportUnitResource::collection(TransportUnit::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransportUnitRequest $request)
    {
        $transportUnit = TransportUnit::create($request->validated());

        return TransportUnitResource::make($transportUnit);
    }

    /**
     * Display the specified resource.
     */
    public function show(TransportUnit $transportUnit)
    {
        return TransportUnitResource::make($transportUnit);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransportUnitRequest $request, TransportUnit $transportUnit)
    {
        $validated = $request->validated();
        $transportUnit->update($validated);

        return response()->json($transportUnit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransportUnit $transportUnit)
    {
        //
    }
}
