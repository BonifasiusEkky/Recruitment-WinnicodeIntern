<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function storeDoc(Request $request)
    {
        // Validasi file jika ada yang diunggah
        $request->validate([
            'curriculum_vitae' => 'nullable|file|mimes:pdf|max:2048', // 2MB, tidak wajib
            'transcript' => 'nullable|file|mimes:pdf|max:2048', // 2MB, tidak wajib
            'id_card' => 'nullable|file|mimes:pdf|max:2048', // 2MB, tidak wajib
            'certificate' => 'nullable|file|mimes:pdf|max:5120', // 5MB, opsional
        ]);

        // Ambil atau buat dokumen baru untuk pengguna
        $document = auth()->user()->document ?: new Document();
        $document->user_id = auth()->id();

        // Proses setiap file yang diunggah
        if ($request->hasFile('curriculum_vitae')) {
            // Hapus file lama jika ada
            if ($document->curriculum_vitae) {
                Storage::disk('public')->delete($document->curriculum_vitae);
            }
            $path = $request->file('curriculum_vitae')->store('documents', 'public');
            $document->curriculum_vitae = $path;
        }

        if ($request->hasFile('transcript')) {
            if ($document->transcript) {
                Storage::disk('public')->delete($document->transcript);
            }
            $path = $request->file('transcript')->store('documents', 'public');
            $document->transcript = $path;
        }

        if ($request->hasFile('id_card')) {
            if ($document->id_card) {
                Storage::disk('public')->delete($document->id_card);
            }
            $path = $request->file('id_card')->store('documents', 'public');
            $document->id_card = $path;
        }

        if ($request->hasFile('certificate')) {
            if ($document->certificate) {
                Storage::disk('public')->delete($document->certificate);
            }
            $path = $request->file('certificate')->store('documents', 'public');
            $document->certificate = $path;
        }

        // Simpan dokumen ke database
        $document->save();

        return redirect()->back()->with('success', 'Documents uploaded successfully!');
    }
}