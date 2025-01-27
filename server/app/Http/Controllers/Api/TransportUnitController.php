<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransportUnit;
use App\Http\Requests\StoreTransportUnitRequest;
use App\Http\Requests\UpdateTransportUnitRequest;
use App\Http\Resources\TransportUnitResource;
use Illuminate\Http\Request;

class TransportUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'type' => 'nullable|in:truck,trailer',
            'page' => 'nullable|integer|min:1',
            'search' => 'nullable|string|max:255',
        ]);

        $type = $request->query('type');
        $search = $request->query('search');

        $query = TransportUnit::query();


        if ($type) {
            $query->where('type', $type);
        }


        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");

                if (is_numeric($search)) {
                    $query->orWhereRaw("CAST(id AS CHAR) LIKE ?", ["%{$search}%"]);
                }
            });
        }


        return $query->paginate(15);
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
