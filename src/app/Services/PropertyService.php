<?php

namespace App\Services;

use App\Models\Property;

class PropertyService
{
    public function list()
    {
        return Property::latest()->get();
    }

    public function create(array $data)
    {
        return Property::create($data);
    }

    public function find($id)
    {
        return Property::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $property = Property::findOrFail($id);
        $property->update($data);

        return $property;
    }

    public function delete($id)
    {
        Property::findOrFail($id)->delete();

        return response()->noContent();
    }
}