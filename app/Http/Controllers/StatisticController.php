<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatisticController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'string|required',
            'label' => 'string|required',
            'jumlah' => 'integer|required',
        ]);

        $data = $validator->validate();

        Statistic::create([
            'category' => $request->category,
            'label' => $request->label,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil menambahkan statistik',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateDemografi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'total_jiwa' => 'integer|required',
            'kepala_keluarga' => 'integer|required',
            'laki_laki' => 'integer|required',
            'perempuan' => 'integer|required',
        ]);

        $data = $validator->validate();

        Statistic::updateOrCreate([
            'category' => 'demografi',
            'label' => 'Total Jiwa',
        ], [
            'jumlah' => $data['total_jiwa'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'demografi',
            'label' => 'Kepala Keluarga',
        ], [
            'jumlah' => $data['kepala_keluarga'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'demografi',
            'label' => 'Laki-Laki',
        ], [
            'jumlah' => $data['laki_laki'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'demografi',
            'label' => 'Perempuan',
        ], [
            'jumlah' => $data['perempuan'],
        ]);

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil mengubah statistik demografi',
        ]);
    }

    public function update(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'statistik.*.label' => 'required',
            'statistik.*.jumlah' => 'required',
            'category' => 'required'
        ], [
            'statistik.*.value.required' => 'Label tidak boleh kosong.',
        ]);

        // Cek apakah validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors()) // Menyimpan pesan error ke dalam $errors untuk ditampilkan di view
                ->withInput()
                ->with([
                    'type' => 'error', // Menyertakan tipe pesan 'error' untuk memudahkan identifikasi di view
                    'message' => 'input tidak boleh kosong',
                ]);
        }

        foreach ($request->statistik as $statisticId => $statisticData) {
            $statistic = Statistic::find($statisticId);
            $statistic->category = $request->category;
            $statistic->label = $statisticData['label'];
            $statistic->jumlah = $statisticData['jumlah'];
            $statistic->save();
        }

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil memperbarui statistik'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Statistic $statistic)
    {
        $statistic->delete();

        return redirect()->back()->with([
            'type' => 'success', 
            'message' => 'Berhasil menghapus statistik',
        ]);
    }
}
