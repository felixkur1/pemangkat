<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\HomepageContent;
use App\Models\Statistic;
use Illuminate\Support\Facades\Validator;
use DOMDocument;
use DOMElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_guest()
    {
        $greetings = HomepageContent::query()->where('name', '=', 'sambutan')->first();
        $history  = HomepageContent::query()->where('name', '=', 'sejarah')->first();
        $profile_video  = HomepageContent::query()->where('name', '=', 'video-profil')->first();
        $articles = Article::query()->where('published_at', '!=', null)->where('highlighted', '=', true)->limit(5)->get();

        return view('guest.beranda.index', compact('greetings', 'profile_video', 'history', 'articles'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index_admin()
    {
        $greetings = HomepageContent::query()->where('name', '=', 'sambutan')->first();
        $profile_video  = HomepageContent::query()->where('name', '=', 'video-profil')->first();
        $history  = HomepageContent::query()->where('name', '=', 'sejarah')->first();

        $total_jiwa = Statistic::query()->where('category', '=', 'demografi')->where('label', '=', 'Total Jiwa')->first();
        $kepala_keluarga = Statistic::query()->where('category', '=', 'demografi')->where('label', '=', 'Kepala Keluarga')->first();
        $laki_laki = Statistic::query()->where('category', '=', 'demografi')->where('label', '=', 'Laki-Laki')->first();
        $perempuan = Statistic::query()->where('category', '=', 'demografi')->where('label', '=', 'Perempuan')->first();

        $belum_sekolah = Statistic::query()->where('category', '=', 'pendidikan')->where('label', '=', 'Belum Sekolah')->first();
        $sd = Statistic::query()->where('category', '=', 'pendidikan')->where('label', '=', 'SD')->first();
        $smp = Statistic::query()->where('category', '=', 'pendidikan')->where('label', '=', 'SMP')->first();
        $sma = Statistic::query()->where('category', '=', 'pendidikan')->where('label', '=', 'SMA')->first();
        $d1 = Statistic::query()->where('category', '=', 'pendidikan')->where('label', '=', 'D1')->first();
        $d2 = Statistic::query()->where('category', '=', 'pendidikan')->where('label', '=', 'D2')->first();
        $d3 = Statistic::query()->where('category', '=', 'pendidikan')->where('label', '=', 'D3')->first();
        $s1 = Statistic::query()->where('category', '=', 'pendidikan')->where('label', '=', 'S1')->first();
        $s2 = Statistic::query()->where('category', '=', 'pendidikan')->where('label', '=', 'S2')->first();
        $s3 = Statistic::query()->where('category', '=', 'pendidikan')->where('label', '=', 'S3')->first();

        $petani_pekebun = Statistic::query()->where('category', '=', 'pekerjaan')->where('label', '=', 'Petani/Pekebun')->first();
        $buruh_tani = Statistic::query()->where('category', '=', 'pekerjaan')->where('label', '=', 'Buruh Tani')->first();
        $buruh_bangunan = Statistic::query()->where('category', '=', 'pekerjaan')->where('label', '=', 'Buruh Bangunan')->first();
        $wiraswasta = Statistic::query()->where('category', '=', 'pekerjaan')->where('label', '=', 'Wiraswasta')->first();
        $pns = Statistic::query()->where('category', '=', 'pekerjaan')->where('label', '=', 'PNS')->first();
        $pedagang = Statistic::query()->where('category', '=', 'pekerjaan')->where('label', '=', 'Pedagang')->first();
        $pengrajin = Statistic::query()->where('category', '=', 'pekerjaan')->where('label', '=', 'Pengrajin')->first();
        $peternak = Statistic::query()->where('category', '=', 'pekerjaan')->where('label', '=', 'Peternak')->first();
        $nelayan = Statistic::query()->where('category', '=', 'pekerjaan')->where('label', '=', 'Nelayan')->first();
        $tni = Statistic::query()->where('category', '=', 'pekerjaan')->where('label', '=', 'TNI')->first();
        $lain = Statistic::query()->where('category', '=', 'pekerjaan')->where('label', '=', 'Lainnya')->first();

        $islam = Statistic::query()->where('category', '=', 'agama')->where('label', '=', 'Islam')->first();
        $buddha = Statistic::query()->where('category', '=', 'agama')->where('label', '=', 'Buddha')->first();
        $katholik = Statistic::query()->where('category', '=', 'agama')->where('label', '=', 'Katholik')->first();
        $hindu = Statistic::query()->where('category', '=', 'agama')->where('label', '=', 'Hindu')->first();
        $kristen = Statistic::query()->where('category', '=', 'agama')->where('label', '=', 'Kristen')->first();
        $kong_hu_chu = Statistic::query()->where('category', '=', 'agama')->where('label', '=', 'Kong Hu Chu')->first();

        $melayu = Statistic::query()->where('category', '=', 'suku')->where('label', '=', 'Melayu')->first();
        $cina = Statistic::query()->where('category', '=', 'suku')->where('label', '=', 'Cina')->first();
        $lain_suku = Statistic::query()->where('category', '=', 'suku')->where('label', '=', 'Lainnya')->first();

        return view('admin.beranda.index', compact(
            'greetings', 'history', 'profile_video',
            'total_jiwa', 'kepala_keluarga', 'laki_laki', 'perempuan',
            'belum_sekolah', 'sd', 'smp', 'sma', 'd1', 'd2', 'd3', 's1', 's2', 's3',
            'petani_pekebun', 'buruh_tani', 'buruh_bangunan', 'wiraswasta', 'pns', 'pedagang', 'pengrajin', 'peternak', 'nelayan', 'tni', 'lain',
            'islam', 'buddha', 'katholik', 'hindu', 'kristen', 'kong_hu_chu',
            'melayu', 'cina', 'lain_suku'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomepageContent $homepageContent)
    {
        $request->validate([
            'sambutan' => 'required',
            'video-profil' => 'required',
            'sejarah' => 'required',
        ]);
    
        // Retrieve and process content
        $contentTypes = [
            'sambutan' => $request->input('sambutan'),
            'video-profil' => $request->input('video-profil'),
            'sejarah' => $request->input('sejarah'),
        ];
    
        foreach ($contentTypes as $name => $content) {
            $existingContent = HomepageContent::query()->where('name', '=', $name)->first();
    
            $originalContent = $existingContent ? $existingContent->content : '';
    
            // Process content and handle base64 images
            $processedContent = $this->processContentImages($content);
    
            if ($existingContent) {
                // Cleanup unused images
                $this->cleanUpUnusedImages($originalContent, $processedContent);
                $existingContent->content = $processedContent;
                $existingContent->save();
            } else {
                HomepageContent::create([
                    'name' => $name,
                    'content' => $processedContent,
                ]);
            }
        }
    
        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil mengubah beranda',
        ]);
    }

    /**
     * Process content to handle base64 images.
     */
    private function processContentImages($content)
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<div>' . $content . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $imgElement = $img instanceof DOMElement ? $img : null;
            $src = $imgElement->getAttribute('src');
            if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
                $imageType = $type[1];
                $data = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $src));
                $filename = 'images/homepage/' . uniqid() . '.' . $imageType;
                Storage::disk('public')->put($filename, $data);
                $imgElement->setAttribute('src', Storage::url($filename));
            }
        }

        return $dom->saveHTML();
    }

    /**
     * Cleanup unused images from storage.
     */
    private function cleanUpUnusedImages($originalContent, $updatedContent)
    {
        $extractImageUrls = function ($content) {
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML('<div>' . $content . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            $urls = [];
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $img) {
                $imgElement = $img instanceof DOMElement ? $img : null;
                $src = $imgElement->getAttribute('src');
                if ($src) {
                    $urls[] = $src;
                }
            }
            return $urls;
        };

        $oldImages = $extractImageUrls($originalContent);
        $newImages = $extractImageUrls($updatedContent);

        // Identify unused images
        $unusedImages = array_diff($oldImages, $newImages);

        foreach ($unusedImages as $url) {
            $path = str_replace('/storage', '', $url);
            Storage::disk('public')->delete($path);
        }
    }

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
            'message' => 'Berhasil mengubah statistik demografi',
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

        $data = $validator->validate();

        Statistic::updateOrCreate([
            'category' => 'pendidikan',
            'label' => 'Belum Sekolah',
        ], [
            'jumlah' => $data['belum_sekolah'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pendidikan',
            'label' => 'SD',
        ], [
            'jumlah' => $data['sd'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pendidikan',
            'label' => 'SMP',
        ], [
            'jumlah' => $data['smp'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pendidikan',
            'label' => 'SMA',
        ], [
            'jumlah' => $data['sma'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pendidikan',
            'label' => 'D1',
        ], [
            'jumlah' => $data['d1'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pendidikan',
            'label' => 'D2',
        ], [
            'jumlah' => $data['d2'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pendidikan',
            'label' => 'D3',
        ], [
            'jumlah' => $data['d3'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pendidikan',
            'label' => 'S1',
        ], [
            'jumlah' => $data['s1'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pendidikan',
            'label' => 'S2',
        ], [
            'jumlah' => $data['s2'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pendidikan',
            'label' => 'S3',
        ], [
            'jumlah' => $data['s3'],
        ]);

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil mengubah statistik pendidikan',
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

        $data = $validator->validate();

        Statistic::updateOrCreate([
            'category' => 'pekerjaan',
            'label' => 'Petani/Pekebun',
        ], [
            'jumlah' => $data['petani_pekebun'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pekerjaan',
            'label' => 'Buruh Tani',
        ], [
            'jumlah' => $data['buruh_tani'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pekerjaan',
            'label' => 'Buruh Bangunan',
        ], [
            'jumlah' => $data['buruh_bangunan'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pekerjaan',
            'label' => 'Wiraswasta',
        ], [
            'jumlah' => $data['wiraswasta'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pekerjaan',
            'label' => 'PNS',
        ], [
            'jumlah' => $data['pns'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pekerjaan',
            'label' => 'Pedagang',
        ], [
            'jumlah' => $data['pedagang'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pekerjaan',
            'label' => 'Pengrajin',
        ], [
            'jumlah' => $data['pengrajin'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pekerjaan',
            'label' => 'Peternak',
        ], [
            'jumlah' => $data['peternak'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pekerjaan',
            'label' => 'Nelayan',
        ], [
            'jumlah' => $data['nelayan'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pekerjaan',
            'label' => 'TNI',
        ], [
            'jumlah' => $data['tni'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'pekerjaan',
            'label' => 'Lainnya',
        ], [
            'jumlah' => $data['lain'],
        ]);

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil mengubah statsitik pekerjaan',
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

        $data = $validator->validate();

        Statistic::updateOrCreate([
            'category' => 'agama',
            'label' => 'Islam',
        ], [
            'jumlah' => $data['islam'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'agama',
            'label' => 'Buddha',
        ], [
            'jumlah' => $data['buddha'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'agama',
            'label' => 'Katholik',
        ], [
            'jumlah' => $data['katholik'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'agama',
            'label' => 'Hindu',
        ], [
            'jumlah' => $data['hindu'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'agama',
            'label' => 'Kristen',
        ], [
            'jumlah' => $data['kristen'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'agama',
            'label' => 'Kong Hu Chu',
        ], [
            'jumlah' => $data['kong_hu_chu'],
        ]);

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil mengubah statistik agama',
        ]);
    }

    public function updateSuku(Request $request, Statistic $statistic) {
        $validator = Validator::make($request->all(), [
            'melayu' => 'integer|required',
            'cina' => 'integer|required',
            'lainnya' => 'integer|required',
        ]);

        $data = $validator->validate();

        Statistic::updateOrCreate([
            'category' => 'suku',
            'label' => 'Melayu',
        ], [
            'jumlah' => $data['melayu'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'suku',
            'label' => 'Cina',
        ], [
            'jumlah' => $data['cina'],
        ]);

        Statistic::updateOrCreate([
            'category' => 'suku',
            'label' => 'Lainnya',
        ], [
            'jumlah' => $data['lainnya'],
        ]);

        return redirect()->back()->with([
            'type' => 'success',
            'message' => 'Berhasil mengubah statistik agama',
        ]);
    }
}
