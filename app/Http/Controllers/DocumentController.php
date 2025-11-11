<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    //
    // GET /api/documents
    public function index()
    {
        $documents = Document::with('files')->get();
        return response()->json($documents);
    }

    // GET /api/documents/{idOrControlNumber}
    public function show($idOrControlNumber)
    {
        $document = Document::with('files')
            ->where('document_id', $idOrControlNumber)
            ->orWhere('document_control_number', $idOrControlNumber)
            ->first();

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        return response()->json($document);
    }

    // POST /api/documents
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document_control_number' => 'required|numeric|unique:documents,document_control_number',
            'date_received' => 'required|date',
            'particular' => 'required|string',
            'office_origin' => 'required|string|max:100',
            'user_id' => 'required|integer',
            'document_form' => 'required|string|max:50',
            'document_type' => 'required|string|max:50',
            'date_of_document' => 'required|date',
            'signatory' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $document = Document::create($request->all());
        return response()->json(['message' => 'Document created successfully', 'data' => $document], 201);
    }

    // PUT/PATCH /api/documents/{id}
    public function update(Request $request, $id)
    {
        $document = Document::find($id);

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        $document->update($request->all());
        return response()->json(['message' => 'Document updated successfully', 'data' => $document]);
    }

    // DELETE /api/documents/{id}
    public function destroy($id)
    {
        $document = Document::find($id);

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        $document->delete();
        return response()->json(['message' => 'Document deleted successfully']);
    }
}
