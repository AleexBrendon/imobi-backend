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

    public function index( Request $request)
    {
        return Contract::where('company_id', $request->user()->company_id)->get();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['company_id'] = $request->user()->company_id;

        $contract = Contract::create($data);

        return response()->json($contract, 201);
    }

    public function show(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);

        $this->authorizeContract($contract, $request);

        return $contract;
    }

    public function update(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);

        $this->authorizeContract($contract, $request);

        $contract->update($request->all());

        return response()->json($contract);
    }

    public function destroy(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);

        $this->authorizeContract($contract, $request);

        $contract->delete();

        return response()->noContent();
    }

    private function authorizeContract($contract, Request $request)
    {
        if ($contract->company_id !== $request->user()->company_id) {
            abort(403);
        }
    }
}
