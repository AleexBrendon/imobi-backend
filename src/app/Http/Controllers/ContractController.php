<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Services\ContractService;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function __construct(
        protected ContractService $service
    ) {}

    public function index()
    {
        return $this->service->list();
    }

    public function store(Request $request)
    {
        $contract = Contract::create($request->all());

        return response()->json($contract, 201);
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
