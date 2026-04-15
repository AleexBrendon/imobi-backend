<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Services\DocumentService;

class DocumentController extends Controller
{
    public function __construct(
        protected DocumentService $service
    ) {}

    public function index(Request $request)
    {
        return Document::where('company_id', $request->user()->company_id)->get();
    }

    public function show(Request $request, $id)
    {
        $doc = Document::findOrFail($id);

        $this->authorizeDocument($doc, $request);

        return $doc;
    }

    public function store(Request $request)
    {
        $document = $this->service->upload($request);

        $document->company_id = $request->user()->company_id;
        $document->save();

        return response()->json($document, 200);
    }

    public function destroy(Request $request, $id)
    {
        $doc = Document::findOrFail($id);

        $this->authorizeDocument($doc, $request);

        $this->service->delete($id);

        return response()->noContent();
    }

    private function authorizeDocument($doc, Request $request)
    {
        if ($doc->company_id !== $request->user()->company_id) {
            abort(403);
        }
    }
}
