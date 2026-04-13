<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Services\PropertyService;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    protected $service;

    public function __construct(PropertyService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {
        $property = Property::create($request->all());

        return response()->json($property, 201);
    }

    public function index()
    {
        return response()->json(Property::all(), 200);
    }

    public function show($id)
    {
        return $this->service->find($id);
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
