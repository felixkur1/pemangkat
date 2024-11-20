@php
  $sortOptions = [
    ['name' => 'Terbaru', 'value' => 'newest'],
    ['name' => 'Terlama', 'value' => 'oldest'],
  ];
@endphp

<x-layout.admin>
  <header class="mb-4 p-4 bg-white shadow-md rounded-md">
    <h1 class="font-bold text-2xl">Dokumen Publik</h1>
  </header>
  <main class="flex flex-col gap-4">
    {{-- Insert Form --}}
    <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm">
      <form action="{{ route('dokumen-publik.store.admin') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
        @csrf
        <h2 class="text-xl font-semibold">Tambah Dokumen Baru</h2>
        {{-- Form Items --}}
        <div class="flex flex-col md:flex-row gap-4 w-full">
          <div class="flex flex-row gap-4 flex-1">
            <div class="flex flex-col gap-2 flex-1">            
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="document">File Dokumen Publik</label>
              <input name="document" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="document" type="file">
            </div>
            <div class="flex flex-col gap-2">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="year">Tahun</label>
              <select id="year" name="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              @foreach ($years as $year)
                <option value="{{ $year }}">{{ $year }}</option>                    
              @endforeach
              </select>
            </div>
          </div>
          <div class="flex flex-col gap-4 flex-1">
            <div class="flex flex-col gap-2 flex-1">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="title">Judul Dokumen</label>
              <x-form.input type="text" name="title" id="title"/>
            </div>
          </div>
        </div>
        <div class="flex flex-col gap-2">
          <label class="block text-sm font-medium text-gray-900 dark:text-white" for="description">Deskripsi Dokumen</label>
          <x-form.textarea name="description" id="description" rows="5" placeholder="Deskripsi Dokumen...">
          </x-form.textarea>
        </div>
        <x-form.button type="submit">
          Tambah
        </x-form.button>
      </form>
    </section>

    {{-- Search, Sort, dan Filter --}}
    <section class="flex flex-col p-4 md:flex-row gap-2 bg-white rounded-lg shadow-sm">
      <form action="{{ route('dokumen-publik.index.admin') }}" method="GET" class="flex flex-col md:flex-row gap-2 bg-white rounded-lg w-full">
        <x-form.search name="title" placeholder="Cari berdasarkan judul..." value="{{ request()->input('title') }}"/>
        <div class="flex-1 flex items-center flex-col md:flex-row gap-2">
          <span>Urutkan Berdasarkan:</span>
          <x-form.radio :options="$sortOptions" name="sort" action="{{ route('dokumen-publik.index.admin') }}" selected-value="{{ request()->input('sort') ?? 'newest' }}"/>
        </div>
      </form>
    </section>

    <section class="flex flex-1 flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    @if ($dokumenPublik->isEmpty())
      <div class="block p-2.5 w-full mb-4 text-sm text-gray-500 bg-gray-50 text-center">Dokumen tidak ditemukan...</div>
    @else
      <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
      @foreach ($dokumenPublik as $d)
        <div class="flex w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <div class="flex-1 flex items-start">
            <div class=" p-6 m-4 border-4 rounded-lg">
              <img class=" rounded-l-lg" src="{{ $d->icon_path }}" alt=""/>
            </div>
          </div>
          <div class="w-2/3 p-5 flex flex-col justify-between">
            <div>
              <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $d->title }}</h5>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($d->description) }}</p>
              <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
                Terakhir diperbarui pada
                <div class="text-blue-500">
                  {{ \Carbon\Carbon::parse($d->updated_at)->translatedFormat('l, d F Y | H:i:s') }}
                </div>
              </p>
            </div>

            <div class="flex flex-row gap-2 justify-end mt-4">
              <form action="{{ route('dokumen-publik.download', $d->id) }}" method="GET">
                <x-form.button>
                  Download
                </x-form.button>
              </form>
              <x-form.button onclick="openModal('{{ route('dokumen-publik.update.admin', $d->id) }}', 'edit', {title: '{{ $d->title }}', year: '{{ $d->year }}', description: '{{ $d->description }}'})" data-modal-target="modal" data-modal-toggle="modal">
                Edit
              </x-form.button>
              <x-form.button use="destroy" onclick="openModal('{{ route('dokumen-publik.destroy.admin', $d->id) }}', 'delete')" data-modal-target="modal" data-modal-toggle="modal">
                Hapus
              </x-form.button>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    @endif

    <div class="mt-2 flex-1 flex justify-center">
      {{ $dokumenPublik->appends(request()->query())->links('pagination::flowbite') }}
    </div>
    </section>
  </main>

  <x-modal>    
    <div id="modal-edit" class="hidden">
      <h2 class="text-xl font-semibold mb-4">Edit Dokumen Publik</h2>
      <div class="flex flex-row gap-4">
        <div class="w-full flex flex-col items-start">
          <form action="" method="POST" class="flex flex-col items-start w-full gap-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-row gap-4 w-full">
              <div class="flex flex-col items-baseline gap-4 flex-1">
                <label class="block text-sm font-medium text-gray-900 dark:text-white" for="title">Judul Dokumen</label>
                <x-form.input type="text" name="title" id="title"/>
              </div>
              <div class="flex flex-col items-baseline gap-4">
                <label class="block text-sm font-medium text-gray-900 dark:text-white" for="year">Tahun</label>
                <select id="year" name="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($years as $year)
                  <option value="{{ $year }}">{{ $year }}</option>                    
                @endforeach
                </select>
              </div>
            </div>
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="description">Deskripsi Dokumen</label>
            <x-form.textarea name="description" id="description" rows="5" placeholder="Deskripsi Dokumen...">
            </x-form.textarea>
            <x-form.button type="submit">
              Edit
            </x-form.button>
          </form>
        </div>
      </div>
    </div>
  </x-modal>

</x-layout.admin>