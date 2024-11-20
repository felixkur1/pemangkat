<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    public function index_admin(Request $request) {
        $query = Employee::query();

        if ($request->filled('full_name')) {
            $query->where('full_name', 'like', '%'.strtolower($request->input('full_name')).'%');
        }

        $sort = $request->input('sort', 'newest');
        if ($sort == 'newest') {
            $query->orderBy('updated_at', 'desc');
        } else {
            $query->orderBy('updated_at', 'asc');
        }

        $pegawai = $query->paginate(10);

        return view('admin.pegawai.index', compact('pegawai'));
    }

    
    public function store(Request $request) {
        $request->validate([
            'full_name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:1024', // Assuming image uploads
        ]);

        $imageUrl = $request->file('image')->store('images/employees', 'public');

        Employee::create([
            'full_name' => $request->full_name,
            'image_url' => $imageUrl,
        ]);

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menambahkan pegawai',
        ]);
    }

    public function update(Request $request, Employee $employee) {
        $request->validate([
            'full_name' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
        ]);

        // Update the employee's name
        $employee->full_name = $request->input('full_name');

        // Check if an image file is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($employee->image_url) {
                Storage::delete($employee->image_url);
            }

            // Store the new image and update the image_url field
            $imageUrl = $request->file('image')->store('images/employees', 'public');
            $employee->image_url = $imageUrl;
        }

        // Save the updated employee data
        $employee->save();

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil memperbarui pegawai',
        ]);

    }

    public function destroy(Employee $employee) {
        if ($employee->image_url && Storage::exists($employee->image_url)) {
            Storage::delete($employee->image_url);
        }

        $employee->delete();

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menghapus pegawai',
        ]);
    }
}
