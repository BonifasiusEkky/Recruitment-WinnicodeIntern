<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fillDoc()
    {
        /** @var \App\Models\User $user */
    $user = auth()->user();
    $user->load('document');
    if (!$user->profile) {
        return redirect()->route('profile.edit')->with('error', 'Please complete your profile before uploading documents.');
    }
    return view('profile.fill-doc', compact('user'));
    }

    public function storeDoc(Request $request)
    {
        try {
            // Flag untuk mengecek apakah dokumen sudah ada
            $documentExists = !!auth()->user()->document;

            // Validasi file
            $request->validate([
                'curriculum_vitae' => 'required_if:document_exists,' . ($documentExists ? 'true' : 'false') . '|file|mimes:pdf|max:2048',
                'transcript' => 'required_if:document_exists,' . ($documentExists ? 'true' : 'false') . '|file|mimes:pdf|max:2048',
                'id_card' => 'required_if:document_exists,' . ($documentExists ? 'true' : 'false') . '|file|mimes:pdf|max:2048',
                'certificate' => 'nullable|file|mimes:pdf|max:5120',
            ], [
                'curriculum_vitae.required_if' => 'Curriculum Vitae is required.',
                'transcript.required_if' => 'Transcript is required.',
                'id_card.required_if' => 'ID Card is required.',
            ]);

            // Ambil atau buat dokumen baru untuk pengguna
            $document = auth()->user()->document ?: new Document();
            $document->user_id = auth()->id();

            // Mapping field ke folder penyimpanan
            $fieldFolders = [
                'curriculum_vitae' => 'documents/cv',
                'transcript' => 'documents/transcript',
                'id_card' => 'documents/id_card',
                'certificate' => 'documents/certificate',
            ];

            // Proses setiap file yang diunggah
            foreach (['curriculum_vitae', 'transcript', 'id_card', 'certificate'] as $field) {
                if ($request->hasFile($field)) {
                    // Buat folder jika belum ada
                    Storage::disk('public')->makeDirectory($fieldFolders[$field]);

                    // Simpan file baru
                    $path = $request->file($field)->store($fieldFolders[$field], 'public');

                    // Hapus file lama jika ada
                    if ($document->$field) {
                        Storage::disk('public')->delete($document->$field);
                    }

                    // Simpan path file ke dokumen
                    $document->$field = $path;

                    Log::info("Uploaded $field:", ['path' => $path]);
                }
            }

            // Simpan dokumen ke database
            $document->save();

            return redirect()->route('profile.fill-doc')->with('success', 'Documents uploaded successfully!');
        } catch (\Exception $e) {
            Log::error('Error uploading documents:', ['error' => $e->getMessage()]);
            return redirect()->route('profile.fill-doc')->with('error', 'Failed to upload documents: ' . $e->getMessage());
        }
    }
}