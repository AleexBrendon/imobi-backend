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
        $data = $request->all();
        $data['company_id'] = $request->user()->company_id;

        $property = Property::create($data);

        return response()->json($property, 201);
    }

    public function index(Request $request)
    {
        return response()->json(
            Property::where('company_id', $request->user()->company_id)->get(),
            200
        );
    }

    public function show(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $this->authorizeProperty($property, $request);

        return $property;
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $this->authorizeProperty($property, $request);

        $property->update($request->all());

        return response()->json($property);
    }

    public function destroy(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $this->authorizeProperty($property, $request);

        $property->delete();

        return response()->noContent();
    }

    private function authorizeProperty($property, Request $request)
    {
        if ($property->company_id !== $request->user()->company_id) {
            abort(403);
        }
    }
}
