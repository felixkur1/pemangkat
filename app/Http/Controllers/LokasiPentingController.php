<?php

namespace App\Http\Controllers;

use App\Models\LokasiPenting;
use App\Http\Controllers\Controller;
use Hamcrest\Description;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LokasiPentingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_guest(Request $request)
    {
        $query = LokasiPenting::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%'.strtolower($request->input('title')).'%');
        }

        $sort = $request->input('sort', 'newest');
        if ($sort == 'newest') {
            $query->orderBy('updated_at', 'desc');
        } else {
            $query->orderBy('updated_at', 'asc');
        }

        $lokasi_penting = $query->paginate(10);

        return view('guest.lokasi-penting.index', compact('lokasi_penting'));
    }

    public function index_admin(Request $request) {
        $query = LokasiPenting::query();

        if ($request->filled('location_name')) {
            $query->where('location_name', 'like', '%'.strtolower($request->input('location_name')).'%');
        }

        $sort = $request->input('sort', 'newest');
        if ($sort == 'newest') {
            $query->orderBy('updated_at', 'desc');
        } else {
            $query->orderBy('updated_at', 'asc');
        }

        $lokasi = $query->paginate(10);

        return view('admin.lokasi-penting.index', compact('lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'location_name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg', 
            'description' => 'required',
            'link_gmaps' => 'required',
        ]);

        $imageUrl = $request->file('image')->store('images/location', 'public');

        LokasiPenting::create([
            'location_name' => $request->location_name,
            'image_url' => $imageUrl,
            'description' => $request->description,
            'link_gmaps' => $request->link_gmaps,
        ]);

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menambahkan lokasi',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LokasiPenting $lokasi) {
        $request->validate([
            'location_name' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'description' => 'required',
            'link_gmaps' => 'required',
        ]);

        $lokasi->location_name = $request->input('location_name');  
        $lokasi->description = $request->input('description');
        $lokasi->link_gmaps = $request->input('link_gmaps');
        
        if ($request->hasFile('image')) {
            if ($lokasi->image_url) {
                Storage::delete($lokasi->image_url);
            }
            
            $imageUrl = $request->file('image')->store('images/location', 'public');
            $lokasi->image_url = $imageUrl;
        }
        
        $lokasi->save();

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil memperbarui lokasi',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LokasiPenting $lokasi) {
        if ($lokasi->image_url && Storage::exists($lokasi->image_url)) {
            Storage::delete($lokasi->image_url);
        }

        $lokasi->delete();

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menghapus lokasi',
        ]);
    }
}
