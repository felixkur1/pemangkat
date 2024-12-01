<?php

namespace App\View\Components;

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
        $this->education_data = [
            ['label' => 'Belum Sekolah', 'jumlah' => 1040],
            ['label' => 'Tamat SD/Sederajat', 'jumlah' => 2225],
            ['label' => 'Tamat SMP/Sederajat', 'jumlah' => 733],
            ['label' => 'Tamat SMA/Sederajat', 'jumlah' => 452],
            ['label' => 'Diploma 1/D1', 'jumlah' => 0],
            ['label' => 'Diploma 2/D2', 'jumlah' => 1],
            ['label' => 'Diploma 3/D3', 'jumlah' => 10],
            ['label' => 'Sarjana/S1', 'jumlah' => 26],
            ['label' => 'Sarjana/S2', 'jumlah' => 0],
            ['label' => 'Sarjana/S3', 'jumlah' => 0],
        ];

        $this->business_data = [
            ['label' => 'Petani/Pekebun', 'jumlah' => 560],
            ['label' => 'Buruh Tani', 'jumlah' => 231],
            ['label' => 'Buruh Bangunan', 'jumlah' => 250],
            ['label' => 'Wiraswasta/Pedagang', 'jumlah' => 25],
            ['label' => 'Pegawai Negeri (PNS)', 'jumlah' => 5],
            ['label' => 'Pedagang', 'jumlah' => 25],
            ['label' => 'Pengrajin', 'jumlah' => 0],
            ['label' => 'Peternak', 'jumlah' => 47],
            ['label' => 'Nelayan/Pencari Ikan', 'jumlah' => 5],
            ['label' => 'TNI', 'jumlah' => 3],
            ['label' => 'Lain-lain (jasa)', 'jumlah' => 0],
        ];

        $this->religion_data = [
            ['label' => 'Islam', 'jumlah' => 3149],
            ['label' => 'Buddha', 'jumlah' => 1065],
            ['label' => 'Katholik', 'jumlah' => 76],
            ['label' => 'Hindu', 'jumlah' => 0],
            ['label' => 'Kristen', 'jumlah' => 82],
            ['label' => 'Kong Hu Chu', 'jumlah' => 300],
        ];

        $this->race_data = [
            ['label' => 'Melayu', 'jumlah' => 3100],
            ['label' => 'Cina', 'jumlah' => 1065],
            ['label' => 'Lainnya (Jawa/Bugis)', 'jumlah' => 49],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.statistics');
    }
}
