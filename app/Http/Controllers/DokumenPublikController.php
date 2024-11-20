<?php

namespace App\Http\Controllers;

use App\Models\PublicDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenPublikController extends Controller
{
    public function index_guest(Request $request) {
        $query = PublicDocument::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%'.strtolower($request->input('title')).'%');
        }

        $sort = $request->input('sort', 'newest');
        if ($sort == 'newest') {
            $query->orderBy('updated_at', 'desc');
        } else {
            $query->orderBy('updated_at', 'asc');
        }

        $dokumenPublik = $query->paginate(10);

        return view('guest.dokumen-publik.index', compact('dokumenPublik'));
    }

    public function index_admin(Request $request) {
        $query = PublicDocument::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%'.strtolower($request->input('title')).'%');
        }

        $sort = $request->input('sort', 'newest');
        if ($sort == 'newest') {
            $query->orderBy('updated_at', 'desc');
        } else {
            $query->orderBy('updated_at', 'asc');
        }

        $dokumenPublik = $query->paginate(10);

        $currentYear = date("Y");
        $years = array_reverse(range(2000, $currentYear));

        return view('admin.dokumen-publik.index', compact('dokumenPublik', 'years'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'year' => 'required|digits:4|integer',
            'description' => 'required|string',
            'document' => 'required|file|mimes:doc,docx,pdf,xls,xlsx',
        ]);

        $file = $request->file('document');
        $documentUrl = $file->store('documents/public', 'public');
        $fileType = $file->getClientMimeType();

        PublicDocument::create([
            'title' => $request->title,
            'year' => $request->year,
            'description' => $request->description,
            'type' => $fileType,
            'document_url' => $documentUrl,
        ]);

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menambahkan dokumen',
        ]);
    }

    public function update(Request $request, PublicDocument $publicDocument) {
        $request->validate([
            'title' => 'required|string',
            'year' => 'required|digits:4|integer',
            'description' => 'required|string',
        ]);

        $publicDocument->title = $request->title;
        $publicDocument->year = $request->year;
        $publicDocument->description = $request->description;

        // Save the updated employee data
        $publicDocument->save();

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil memperbarui dokumen publik',
        ]);
    }

    public function download(PublicDocument $publicDocument) {
        $filePath = storage_path('app/public/'.$publicDocument->document_url);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        $filename = preg_replace('/[^\w\-]+/', '_', $publicDocument->title).'.'.$extension;
        return response()->download($filePath, $filename);
    }

    public function destroy(PublicDocument $publicDocument) {
        if ($publicDocument->document_url && Storage::exists($publicDocument->document_url)) {
            Storage::delete($publicDocument->document_url);
        }

        $publicDocument->delete();

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menghapus dokumen publik',
        ]);
    }
}
