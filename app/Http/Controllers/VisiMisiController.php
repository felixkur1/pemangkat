<?php

namespace App\Http\Controllers;

use App\Models\VisionMission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisiMisiController extends Controller
{
    public function index_admin() {
        $vision = VisionMission::vision()->first();
        $missions = VisionMission::missions()->get();

        return view('admin.visi-misi.index', compact('vision', 'missions'));
    }

    public function index_guest() {
        $vision = VisionMission::vision()->first();
        $missions = VisionMission::missions()->get();

        return view('guest.visi-misi.index', compact('vision', 'missions'));
    }

    public function store(Request $request) {
        if ($request->input('mission') != null) {
            VisionMission::create([
                'type' => 'misi',
                'value' => $request->input('mission'),
            ]);
    
            return redirect()->back()->with([
                'type' => 'success', 
                'message' => 'Berhasil menambahkan misi',
            ]);
        }

        return redirect()->back()->with([
            'type' => 'error', 
            'message' => 'Misi tidak boleh kosong',
        ]);
    }

    public function update_visi(Request $request) {
        $validator = Validator::make($request->all(), [
            'vision' => 'required|string',
        ], [
            'vision.required' => 'Visi tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with([
                    'type' => 'error',
                    'message' => 'Visi tidak boleh kosong'
                ]);
        }

        $vision = VisionMission::vision()->first();

        if ($vision == null) {
            $vision = VisionMission::create([
                'id' => 0,
                'type' => 'visi',
                'value' => $request->input('vision'),
            ])->save();
        } else {
            $vision->value = $request->input('vision');
            $vision->save();
        }

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil memperbarui visi'
        ]);

    }

    public function update_misi(Request $request) {
        $validator = Validator::make($request->all(), [
            'missions.*.value' => 'required|string'
        ], [
            'missions.*.value.required' => 'Misi tidak boleh kosong.'
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors()) // Menyimpan pesan error ke dalam $errors untuk ditampilkan di view
                ->withInput()
                ->with([
                    'type' => 'error', // Menyertakan tipe pesan 'error' untuk memudahkan identifikasi di view
                    'message' => 'Misi tidak boleh kosong',
                ]);
        }

        $type = 'misi';
        foreach ($request->input('missions') as $missionId => $missionData) {
            $mission = VisionMission::find($missionId);
            $mission->value = $missionData['value'];
            $mission->save();
        }

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil memperbarui '.$type
        ]);
    }

    public function destroy(VisionMission $mission) {
        $mission->delete();

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menghapus misi',
        ]);
    }
}
