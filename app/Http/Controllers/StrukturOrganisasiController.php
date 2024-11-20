<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\OrgGroup;
use App\Models\OrgStructure;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
{
    public function index_guest() {
        $orgGroups = OrgGroup::with('structures.employee')->get();

        return view('guest.struktur-organisasi.index', compact('orgGroups'));
    }

    public function index_admin() {
        $orgGroups = OrgGroup::with('structures.employee')->get();
        $employees = Employee::all();

        return view('admin.struktur-organisasi.index', compact('orgGroups', 'employees'));
    }

    public function store_group(Request $request) {
        $request->validate([
            'group' => 'required|string'
        ]);

        OrgGroup::create([
            'title' => $request->group
        ]);

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menambahkan kelompok',
        ]);

    }

    public function update_group(Request $request, OrgGroup $orgGroup) {
        $request->validate([
            'title' => 'required|string',
        ]);

        $orgGroup->title = $request->title;
        $orgGroup->save();
        
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil memperbarui kelompok',
        ]);
    }

    public function destroy_group(OrgGroup $orgGroup) {
        $orgGroup->delete();

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menghapus kelompok',
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'group_id' => 'required|exists:org_groups,id',
            'employee_id' => 'required|exists:employees,id',
            'position' => 'required|string|max:255',
        ]);

        OrgStructure::create([
            'group_id' => $request->group_id,
            'employee_id' => $request->employee_id,
            'position' => $request->position,
        ]);

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menambahkan pegawai dalam kelompok',
        ]);
    }

    public function update(Request $request, OrgStructure $orgStructure) {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'position' => 'required|string|max:255',
        ]);

        $orgStructure->employee_id = $request->employee_id;
        $orgStructure->position = $request->position;

        $orgStructure->save();

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil memperbarui pegawai',
        ]);
    }

    public function destroy(OrgStructure $orgStructure) {
        $orgStructure->delete();
        
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil memperbarui pegawai',
        ]);
    }
}
