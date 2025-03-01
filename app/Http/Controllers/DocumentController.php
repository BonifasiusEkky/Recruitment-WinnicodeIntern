<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'cv' => 'nullable|file|mimes:pdf,docx|max:2048',
            'portfolio' => 'nullable|file|mimes:pdf,docx|max:2048',
            'additional' => 'nullable|file|mimes:pdf,docx|max:2048'
        ]);

        $user = auth()->user();
        $document = Document::updateOrCreate(
            ['user_id' => $user->id],
            [
                'cv' => $request->file('cv') ? $request->file('cv')->store('documents') : null,
                'portfolio' => $request->file('portfolio') ? $request->file('portfolio')->store('documents') : null,
                'additional' => $request->file('additional') ? $request->file('additional')->store('documents') : null,
            ]
        );

        return response()->json(['message' => 'Documents uploaded successfully']);
    }
}
