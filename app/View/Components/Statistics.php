<?php

namespace App\View\Components;

use App\Models\Statistic;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Statistics extends Component
{
    public $total_jiwa = 4524;
    public $kepala_keluarga = 1497;
    public $laki_laki = 2334;
    public $perempuan = 2190;

    public $education_data;
    public $business_data;
    public $religion_data;
    public $race_data;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->total_jiwa = Statistic::query()->where('category', '=', 'demografi')->where('label', '=', 'Total Jiwa')->first()->jumlah;
        $this->kepala_keluarga = Statistic::query()->where('category', '=', 'demografi')->where('label', '=', 'Kepala Keluarga')->first()->jumlah;
        $this->laki_laki = Statistic::query()->where('category', '=', 'demografi')->where('label', '=', 'Laki-Laki')->first()->jumlah;
        $this->perempuan = Statistic::query()->where('category', '=', 'demografi')->where('label', '=', 'Perempuan')->first()->jumlah;

        // $this->education_data = [

        //     ['label' => 'Belum Sekolah', 'jumlah' => 1040],
        //     ['label' => 'Tamat SD/Sederajat', 'jumlah' => 2225],
        //     ['label' => 'Tamat SMP/Sederajat', 'jumlah' => 733],
        //     ['label' => 'Tamat SMA/Sederajat', 'jumlah' => 452],
        //     ['label' => 'Diploma 1/D1', 'jumlah' => 0],
        //     ['label' => 'Diploma 2/D2', 'jumlah' => 1],
        //     ['label' => 'Diploma 3/D3', 'jumlah' => 10],
        //     ['label' => 'Sarjana/S1', 'jumlah' => 26],
        //     ['label' => 'Sarjana/S2', 'jumlah' => 0],
        //     ['label' => 'Sarjana/S3', 'jumlah' => 0],
        // ];

        // $this->business_data = [
        //     ['label' => 'Petani/Pekebun', 'jumlah' => 560],
        //     ['label' => 'Buruh Tani', 'jumlah' => 231],
        //     ['label' => 'Buruh Bangunan', 'jumlah' => 250],
        //     ['label' => 'Wiraswasta/Pedagang', 'jumlah' => 25],
        //     ['label' => 'Pegawai Negeri (PNS)', 'jumlah' => 5],
        //     ['label' => 'Pedagang', 'jumlah' => 25],
        //     ['label' => 'Pengrajin', 'jumlah' => 0],
        //     ['label' => 'Peternak', 'jumlah' => 47],
        //     ['label' => 'Nelayan/Pencari Ikan', 'jumlah' => 5],
        //     ['label' => 'TNI', 'jumlah' => 3],
        //     ['label' => 'Lain-lain (jasa)', 'jumlah' => 0],
        // ];

        // $this->religion_data = [
        //     ['label' => 'Islam', 'jumlah' => 3149],
        //     ['label' => 'Buddha', 'jumlah' => 1065],
        //     ['label' => 'Katholik', 'jumlah' => 76],
        //     ['label' => 'Hindu', 'jumlah' => 0],
        //     ['label' => 'Kristen', 'jumlah' => 82],
        //     ['label' => 'Kong Hu Chu', 'jumlah' => 300],
        // ];

        // $this->race_data = [
        //     ['label' => 'Melayu', 'jumlah' => 3100],
        //     ['label' => 'Cina', 'jumlah' => 1065],
        //     ['label' => 'Lainnya', 'jumlah' => 49],
        // ];

        $statistics = Statistic::all();

        // Kelompokkan data berdasarkan kategori
        $grouped = $statistics->groupBy('category');
    
        // Map data ke dalam format yang sesuai
        $this->education_data = $this->mapData($grouped->get('pendidikan'));
        $this->business_data = $this->mapData($grouped->get('pekerjaan'));
        $this->religion_data = $this->mapData($grouped->get('agama'));
        $this->race_data = $this->mapData($grouped->get('suku'));
    }

    /**
     * Utility function untuk memetakan data menjadi array dengan 'label' dan 'jumlah'.
     */
    private function mapData($data)
    {
        if (!$data) {
            return [];
        }

        return $data->map(function ($item) {
            return [
                'label' => $item->label,
                'jumlah' => $item->jumlah,
            ];
        })->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.statistics');
    }
}
