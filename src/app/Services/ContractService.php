<?php

namespace App\Services;

use App\Models\Contract;

class ContractService
{
    public function list()
    {
        return Contract::latest()->get();
    }

    public function create(array $data)
    {
        return Contract::create($data);
    }

    public function find($id)
    {
        return Contract::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $contract = Contract::findOrFail($id);
        $contract->update($data);

        return $contract;
    }

    public function delete($id)
    {
        Contract::findOrFail($id)->delete();

        return response()->noContent();
    }
}