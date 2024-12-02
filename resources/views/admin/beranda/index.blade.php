<x-layout.admin>
  <header class="mb-4 p-4 bg-white shadow-md rounded-md">
    <h1 class="font-bold text-2xl">Edit Beranda</h1>
  </header>
  <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    <h2 class="text-xl font-semibold">Edit Teks Beranda</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
      @csrf
      @method('PUT')
      <label class="block text-sm font-medium text-gray-900 dark:text-white" for="summernote-1">Kata Sambutan</label>
      <div class="bootstrap-styled">
        <textarea id="summernote-1" class="bg-white w-full z-50" name="sambutan">
          {{ $greetings->content ?? "" }}
        </textarea>
      </div>
      <label class="block text-sm font-medium text-gray-900 dark:text-white" for="summernote-1">Video Profil</label>
      <div class="bootstrap-styled">
        <textarea id="summernote-2" class="bg-white w-full z-50" name="video-profil">
          {{ $profile_video->content ?? "" }}
        </textarea>
      </div>
      <label class="block text-sm font-medium text-gray-900 dark:text-white" for="summernote-1">Sejarah</label>
      <div class="bootstrap-styled">
        <textarea id="summernote-3" class="bg-white w-full z-50" name="sejarah">
          {{ $history->content ?? "" }}
        </textarea>
      </div>
      <script>
        $('#summernote-1').summernote({
          placeholder: 'Kata Sambutan',
          height: 450,
          tabsize: 2,
          toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['codeview', 'help']]
        ]
        });

        $('#summernote-2').summernote({
          placeholder: 'Sekapur Sirih',
          height: 450,
          tabsize: 2,
          toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['codeview', 'help']]
        ]
        });

        $('#summernote-3').summernote({
          placeholder: 'Sekapur Sirih',
          height: 450,
          tabsize: 2,
          toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'italic', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['codeview', 'help']]
        ]
        });
      </script>

      <x-form.button type="submit">
        Simpan
      </x-form.button>
    </form>    
  </section>
  <header class="mb-4 p-4 bg-white shadow-md rounded-md">
    <h1 class="font-bold text-2xl">Edit Statistik</h1>
  </header>
  <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    <h2 class="text-xl font-semibold">Demografi Penduduk</h2>
    <form action="{{ route('admin.statistik.demografi.update') }}" method="post" class="flex flex-col gap-2">
      @csrf
      @method('PUT')
      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="total_jiwa">Total Jiwa</label>
          <x-form.input type="text" name="total_jiwa" id="total_jiwa" value="{{ $total_jiwa->jumlah }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="kepala_keluarga">Kepala Keluarga</label>
          <x-form.input type="text" name="kepala_keluarga" id="kepala_keluarga" value="{{ $kepala_keluarga->jumlah }}"/>
        </div>
      </div>

      <div class="flex flex-row gap-2 w-full mb-2">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="laki_laki">Laki-Laki</label>
          <x-form.input type="text" name="laki_laki" id="laki_laki" value="{{ $laki_laki->jumlah }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="perempuan">Perempuan</label>
          <x-form.input type="text" name="perempuan" id="perempuan" value="{{ $perempuan->jumlah }}"/>
        </div>
      </div>
      <x-form.button type="submit">
        Tambah
      </x-form.button>
    </form>
  </section>

  <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    <h2 class="text-xl font-semibold">Jenjang Pendidikan</h2>
    <form action="{{ route('admin.statistik.pendidikan.update') }}" method="post" class="flex flex-col gap-2">
      @csrf
      @method('PUT')
      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="belum_sekolah">Belum Sekolah</label>
          <x-form.input type="text" name="belum_sekolah" id="belum_sekolah" value="{{ $belum_sekolah->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="sd">SD</label>
          <x-form.input type="text" name="sd" id="sd" value="{{ $sd->jumlah ?? 0 }}"/>
        </div>
      </div>
      
      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="smp">SMP</label>
          <x-form.input type="text" name="smp" id="smp" value="{{ $smp->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="sma">SMA</label>
          <x-form.input type="text" name="sma" id="sma" value="{{ $sma->jumlah ?? 0 }}"/>
        </div>
      </div>

      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="d1">D1</label>
          <x-form.input type="text" name="d1" id="d1" value="{{ $d1->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="d2">D2</label>
          <x-form.input type="text" name="d2" id="d2" value="{{ $d2->jumlah ?? 0 }}"/>
        </div>
      </div>

      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="d3">D3</label>
          <x-form.input type="text" name="d3" id="d3" value="{{ $d3->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="s1">S1</label>
          <x-form.input type="text" name="s1" id="s1" value="{{ $s1->jumlah ?? 0 }}"/>
        </div>
      </div>

      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="s2">S2</label>
          <x-form.input type="text" name="s2" id="s2" value="{{ $s2->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="s3">S3</label>
          <x-form.input type="text" name="s3" id="s3" value="{{ $s3->jumlah ?? 0 }}"/>
        </div>
      </div>

      <x-form.button type="submit">
        Tambah
      </x-form.button>
    </form>
  </section>

  <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    <h2 class="text-xl font-semibold">Pekerjaan</h2>
    <form action="{{ route('admin.statistik.pekerjaan.update') }}" method="post" class="flex flex-col gap-2">
      @csrf
      @method('PUT')
      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="petani_pekebun">Petani/Pekebun</label>
          <x-form.input type="text" name="petani_pekebun" id="petani_pekebun" value="{{ $petani_pekebun->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="buruh_tani">Buruh Tani</label>
          <x-form.input type="text" name="buruh_tani" id="buruh_tani" value="{{ $buruh_tani->jumlah ?? 0 }}"/>
        </div>
      </div>

      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="buruh_bangunan">Buruh Bangunan</label>
          <x-form.input type="text" name="buruh_bangunan" id="buruh_bangunan" value="{{ $buruh_bangunan->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="wiraswasta">Wiraswasta</label>
          <x-form.input type="text" name="wiraswasta" id="wiraswasta" value="{{ $wiraswasta->jumlah ?? 0 }}"/>
        </div>
      </div>

      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="pns">PNS</label>
          <x-form.input type="text" name="pns" id="pns" value="{{ $pns->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="pedagang">Pedagang</label>
          <x-form.input type="text" name="pedagang" id="pedagang" value="{{ $pedagang->jumlah ?? 0 }}"/>
        </div>
      </div>

      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="pengrajin">Pengrajin</label>
          <x-form.input type="text" name="pengrajin" id="pengrajin" value="{{ $pengrajin->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="peternak">Peternak</label>
          <x-form.input type="text" name="peternak" id="peternak" value="{{ $peternak->jumlah ?? 0 }}"/>
        </div>
      </div>

      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="nelayan">Nelayan</label>
          <x-form.input type="text" name="nelayan" id="nelayan" value="{{ $nelayan->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="tni">TNI</label>
          <x-form.input type="text" name="tni" id="tni" value="{{ $tni->jumlah ?? 0 }}"/>
        </div>
      </div>
      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="lain">Lainnya</label>
          <x-form.input type="text" name="lain" id="lain" value="{{ $lain->jumlah ?? 0 }}"/>
        </div>
      </div>

      <x-form.button type="submit">
        Tambah
      </x-form.button>
    </form>
  </section>

  <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    <h2 class="text-xl font-semibold">Agama</h2>
    <form action="{{ route('admin.statistik.agama.update') }}" method="post" class="flex flex-col gap-2">
      @csrf
      @method('PUT')
      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="islam">Islam</label>
          <x-form.input type="text" name="islam" id="islam" value="{{ $islam->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="buddha">Buddha</label>
          <x-form.input type="text" name="buddha" id="buddha" value="{{ $buddha->jumlah ?? 0 }}"/>
        </div>
      </div>

      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="katholik">Katholik</label>
          <x-form.input type="text" name="katholik" id="katholik" value="{{ $katholik->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="hindu">Hindu</label>
          <x-form.input type="text" name="hindu" id="hindu" value="{{ $hindu->jumlah ?? 0 }}"/>
        </div>
      </div>

      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="kristen">Kristen</label>
          <x-form.input type="text" name="kristen" id="kristen" value="{{ $kristen->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="kong_hu_chu">Kong Hu Chu</label>
          <x-form.input type="text" name="kong_hu_chu" id="kong_hu_chu" value="{{ $kong_hu_chu->jumlah ?? 0 }}"/>
        </div>
      </div>

      <x-form.button type="submit">
        Tambah
      </x-form.button>
    </form>
  </section>

  <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    <h2 class="text-xl font-semibold">Agama</h2>
    <form action="{{ route('admin.statistik.suku.update') }}" method="post" class="flex flex-col gap-2">
      @csrf
      @method('PUT')
      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="melayu">Melayu</label>
          <x-form.input type="text" name="melayu" id="melayu" value="{{ $melayu->jumlah ?? 0 }}"/>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="cina">Cina</label>
          <x-form.input type="text" name="cina" id="cina" value="{{ $cina->jumlah ?? 0 }}"/>
        </div>
      </div>

      <div class="flex flex-row gap-2 w-full">
        <div class="flex-1">
          <label class="block text-sm font-medium text-gray-900 mb-2" for="lainnya">Lainnya</label>
          <x-form.input type="text" name="lainnya" id="lainnya" value="{{ $lain_suku->jumlah ?? 0 }}"/>
        </div>
      </div>

      <x-form.button type="submit">
        Tambah
      </x-form.button>
    </form>
  </section>
</x-layout.admin>