<?php

namespace App\Http\Controllers;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'client_id' => 'required'
        ]);

        $path = $request->file('file')->store('documents');

        return Document::create([
            'client_id' => $request->client_id,
            'file_path' => $path,
            'type' => $request->file('file')->extension()
        ]);
    }
}