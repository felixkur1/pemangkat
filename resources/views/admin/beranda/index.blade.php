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
        Perbarui
      </x-form.button>
    </form>
  </section>

  {{-- Edit Pendidikan --}}
  <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    <form action="{{ route('statistik.update.admin') }}" method="post" class="flex flex-col gap-2">
      @csrf
      @method('PUT')
      <input type="hidden" name="category" value="pendidikan">
      <div class="flex flex-row justify-between">
        <h2 class="text-xl font-semibold">Jenjang Pendidikan</h2>
        <x-form.button type="submit">
          Simpan
        </x-form.button>
      </div>
      @foreach ($pendidikan as $p)
        <div class="flex flex-row gap-2 w-full">
          <div class="flex flex-col gap-2 w-full">
            <x-form.input type="text" name="statistik[{{ $p->id }}][label]" id="label[{{ $p->id }}]" value="{{ $p->label }}"/>
          </div>
          <div class="w-1/6 flex flex-col gap-2">
            <x-form.input type="text" name="statistik[{{ $p->id }}][jumlah]" id="jumlah[{{ $p->id }}]" value="{{ $p->jumlah }}"/>
          </div>
          <x-form.button onclick="openModal('{{ route('statistik.destroy.admin', $p->id) }}', 'delete')" use="destroy" type="button" data-modal-target="modal" data-modal-toggle="modal">
            <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
            </svg>
          </x-form.button>
        </div>
      @endforeach
    </form>
    <form action="{{ route('statistic.store.admin') }}" method="POST" class="flex flex-col gap-4">
      @csrf
      @method('POST')
      <input type="hidden" name="category" value="pendidikan">
      <h2 class="text-xl font-semibold">Tambah Data</h2>
      <div class="flex flex-row gap-2 w-full">
        <div class="flex flex-col gap-2 w-full">
          <x-form.input type="text" name="label" id="label" placeholder="Label baru..."/>
        </div>
        <div class="w-1/6 flex flex-col gap-2">
          <x-form.input type="text" name="jumlah" id="jumlah" placeholder="Jumlah..."/>
        </div>
      </div>
      <x-form.button type="submit">
        Tambahkan
      </x-form.button>
    </form>
  </section>

  {{-- Edit Pekerjaan --}}
  <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    <form action="{{ route('statistik.update.admin') }}" method="post" class="flex flex-col gap-2">
      @csrf
      @method('PUT')
      <input type="hidden" name="category" value="pekerjaan">
      <div class="flex flex-row justify-between">
        <h2 class="text-xl font-semibold">Pekerjaan</h2>
        <x-form.button type="submit">
          Simpan
        </x-form.button>
      </div>
      @foreach ($pekerjaan as $p)
        <div class="flex flex-row gap-2 w-full">
          <div class="flex flex-col gap-2 w-full">
            <x-form.input type="text" name="statistik[{{ $p->id }}][label]" id="label[{{ $p->id }}]" value="{{ $p->label }}"/>
          </div>
          <div class="w-1/6 flex flex-col gap-2">
            <x-form.input type="text" name="statistik[{{ $p->id }}][jumlah]" id="jumlah[{{ $p->id }}]" value="{{ $p->jumlah }}"/>
          </div>
          <x-form.button onclick="openModal('{{ route('statistik.destroy.admin', $p->id) }}', 'delete')" use="destroy" type="button" data-modal-target="modal" data-modal-toggle="modal">
            <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
            </svg>
          </x-form.button>
        </div>
      @endforeach
    </form>
    <form action="{{ route('statistic.store.admin') }}" method="POST" class="flex flex-col gap-4">
      @csrf
      @method('POST')
      <input type="hidden" name="category" value="pekerjaan">
      <h2 class="text-xl font-semibold">Tambah Data</h2>
      <div class="flex flex-row gap-2 w-full">
        <div class="flex flex-col gap-2 w-full">
          <x-form.input type="text" name="label" id="label" placeholder="Label baru..."/>
        </div>
        <div class="w-1/6 flex flex-col gap-2">
          <x-form.input type="text" name="jumlah" id="jumlah" placeholder="Jumlah..."/>
        </div>
      </div>
      <x-form.button type="submit">
        Tambahkan
      </x-form.button>
    </form>
  </section>

  {{-- Edit Agama --}}
  <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    <form action="{{ route('statistik.update.admin') }}" method="post" class="flex flex-col gap-2">
      @csrf
      @method('PUT')
      <input type="hidden" name="category" value="agama">
      <div class="flex flex-row justify-between">
        <h2 class="text-xl font-semibold">Agama</h2>
        <x-form.button type="submit">
          Simpan
        </x-form.button>
      </div>
      @foreach ($agama as $p)
        <div class="flex flex-row gap-2 w-full">
          <div class="flex flex-col gap-2 w-full">
            <x-form.input type="text" name="statistik[{{ $p->id }}][label]" id="label[{{ $p->id }}]" value="{{ $p->label }}"/>
          </div>
          <div class="w-1/6 flex flex-col gap-2">
            <x-form.input type="text" name="statistik[{{ $p->id }}][jumlah]" id="jumlah[{{ $p->id }}]" value="{{ $p->jumlah }}"/>
          </div>
          <x-form.button onclick="openModal('{{ route('statistik.destroy.admin', $p->id) }}', 'delete')" use="destroy" type="button" data-modal-target="modal" data-modal-toggle="modal">
            <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
            </svg>
          </x-form.button>
        </div>
      @endforeach
    </form>
    <form action="{{ route('statistic.store.admin') }}" method="POST" class="flex flex-col gap-4">
      @csrf
      @method('POST')
      <input type="hidden" name="category" value="agama">
      <h2 class="text-xl font-semibold">Tambah Data</h2>
      <div class="flex flex-row gap-2 w-full">
        <div class="flex flex-col gap-2 w-full">
          <x-form.input type="text" name="label" id="label" placeholder="Label baru..."/>
        </div>
        <div class="w-1/6 flex flex-col gap-2">
          <x-form.input type="text" name="jumlah" id="jumlah" placeholder="Jumlah..."/>
        </div>
      </div>
      <x-form.button type="submit">
        Tambahkan
      </x-form.button>
    </form>
  </section>

  {{-- Edit Suku --}}
  <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    <form action="{{ route('statistik.update.admin') }}" method="post" class="flex flex-col gap-2">
      @csrf
      @method('PUT')
      <input type="hidden" name="category" value="suku">
      <div class="flex flex-row justify-between">
        <h2 class="text-xl font-semibold">Suku</h2>
        <x-form.button type="submit">
          Simpan
        </x-form.button>
      </div>
      @foreach ($suku as $p)
        <div class="flex flex-row gap-2 w-full">
          <div class="flex flex-col gap-2 w-full">
            <x-form.input type="text" name="statistik[{{ $p->id }}][label]" id="label[{{ $p->id }}]" value="{{ $p->label }}"/>
          </div>
          <div class="w-1/6 flex flex-col gap-2">
            <x-form.input type="text" name="statistik[{{ $p->id }}][jumlah]" id="jumlah[{{ $p->id }}]" value="{{ $p->jumlah }}"/>
          </div>
          <x-form.button onclick="openModal('{{ route('statistik.destroy.admin', $p->id) }}', 'delete')" use="destroy" type="button" data-modal-target="modal" data-modal-toggle="modal">
            <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
            </svg>
          </x-form.button>
        </div>
      @endforeach
    </form>
    <form action="{{ route('statistic.store.admin') }}" method="POST" class="flex flex-col gap-4">
      @csrf
      @method('POST')
      <input type="hidden" name="category" value="suku">
      <h2 class="text-xl font-semibold">Tambah Data</h2>
      <div class="flex flex-row gap-2 w-full">
        <div class="flex flex-col gap-2 w-full">
          <x-form.input type="text" name="label" id="label" placeholder="Label baru..."/>
        </div>
        <div class="w-1/6 flex flex-col gap-2">
          <x-form.input type="text" name="jumlah" id="jumlah" placeholder="Jumlah..."/>
        </div>
      </div>
      <x-form.button type="submit">
        Tambahkan
      </x-form.button>
    </form>
  </section>

  <x-modal>
  </x-modal>
</x-layout.admin>