<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatisticsController extends Controller
{
    public function updateDemografi(Request $request, Statistic $statistic)
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
            'message' => 'Berhasil mengubah demografi',
        ]);
    }

    public function updatePendidikan(Request $request, Statistic $statistic) {
        $validator = Validator::make($request->all(), [
            'belum_sekolah' => 'integer|required',
            'sd' => 'integer|required',
            'smp' => 'integer|required',
            'sma' => 'integer|required',
            'd1' => 'integer|required',
            'd2' => 'integer|required',
            'd3' => 'integer|required',
            's1' => 'integer|required',
            's2' => 'integer|required',
            's3' => 'integer|required',
        ]);

    }

    public function updatePekerjaan(Request $request, Statistic $statistic) {
        $validator = Validator::make($request->all(), [
            'petani_pekebun' => 'integer|required',
            'buruh_tani' => 'integer|required',
            'buruh_bangunan' => 'integer|required',
            'wiraswasta' => 'integer|required',
            'pns' => 'integer|required',
            'pedagang' => 'integer|required',
            'pengrajin' => 'integer|required',
            'peternak' => 'integer|required',
            'nelayan' => 'integer|required',
            'tni' => 'integer|required',
            'lain' => 'integer|required',
        ]);
    }

    public function updateAgama(Request $request, Statistic $statistic) {
        $validator = Validator::make($request->all(), [
            'islam' => 'integer|required',
            'buddha' => 'integer|required',
            'katholik' => 'integer|required',
            'hindu' => 'integer|required',
            'kristen' => 'integer|required',
            'kong_hu_chu' => 'integer|required',
        ]);
    }

    public function updateSuku(Request $request, Statistic $statistic) {
        $validator = Validator::make($request->all(), [
            'melayu' => 'integer|required',
            'cina' => 'integer|required',
            'lainnya' => 'integer|required',
        ]);
    }
}
