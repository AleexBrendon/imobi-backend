<?php

namespace App\Http\Controllers;

use App\Services\DocumentService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct(
        protected DocumentService $service
    ) {}

    public function index()
    {
        return $this->service->list();
    }

    public function show($id)
    {
        return $this->service->find($id);
    }

    public function store(Request $request)
    {
        $document = $this->service->upload($request);

        return response()->json($document, 200);
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return response()->noContent();
    }
}
