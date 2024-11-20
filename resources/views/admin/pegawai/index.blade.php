@php
  $sortOptions = [
    ['name' => 'Terbaru', 'value' => 'newest'],
    ['name' => 'Terlama', 'value' => 'oldest'],
  ];
@endphp

<x-layout.admin>
  <header class="mb-4 p-4 bg-white shadow-md rounded-md">
    <h1 class="font-bold text-2xl">Pegawai</h1>
  </header>
  <main class="flex flex-col gap-4">
    {{-- Insert Form --}}
    <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm">
      <form action="{{ route('pegawai.store.admin') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
        @csrf
        <h2 class="text-xl font-semibold">Tambah Pegawai Baru</h2>
        {{-- Form Items --}}
        <div class="flex flex-col md:flex-row gap-4 w-full">
          <div class="flex flex-col gap-2 flex-1">            
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="image">Foto Pegawai</label>
            <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" type="file">
          </div>
          <div class="flex flex-col gap-4 flex-1">
            <div class="flex flex-col gap-2">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="full_name">Nama Lengkap</label>
              <x-form.input type="text" name="full_name" id="full_name"/>
            </div>
            <x-form.button type="submit">
              Tambah
            </x-form.button>
          </div>
        </div>
      </form>
    </section>

    {{-- Search, Sort, dan Filter --}}
    <section class="flex flex-col p-4 md:flex-row gap-2 bg-white rounded-lg shadow-sm">
      <form action="{{ route('pegawai.index.admin') }}" method="GET" class="flex flex-col md:flex-row gap-2 bg-white rounded-lg w-full">
        <x-form.search name="full_name" placeholder="Cari berdasarkan nama..." value="{{ request()->input('full_name') }}"/>
        <div class="flex-1 flex items-center flex-col md:flex-row gap-2">
          <span>Urutkan Berdasarkan:</span>
          <x-form.radio :options="$sortOptions" name="sort" action="{{ route('pegawai.index.admin') }}" selected-value="{{ request()->input('sort') ?? 'newest' }}"/>
        </div>
      </form>
    </section>

    <section class="flex flex-1 flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    @if ($pegawai->isEmpty())
      <div class="block p-2.5 w-full mb-4 text-sm text-gray-500 bg-gray-50 text-center">Pegawai tidak ditemukan...</div>
    @else
      <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
      @foreach ($pegawai as $p)
        <div class="flex w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <div class="w-1/3 aspect-[3/4] overflow-hidden">
            <img class="object-cover w-full h-full rounded-l-lg" src="{{ asset('storage/'.$p->image_url) }}" alt=""/>
          </div>
          <div class="w-2/3 p-5 flex flex-col justify-between">
            <div>
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $p->full_name }}</h5>

              <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
                Terakhir diperbarui pada
                <div class="text-blue-500">
                  {{ \Carbon\Carbon::parse($p->updated_at)->translatedFormat('l, d F Y | H:i:s') }}
                </div>
              </p>
            </div>

            <div class="flex flex-row gap-2 justify-end">
              <x-form.button onclick="openModal('{{ route('pegawai.update.admin', $p->id) }}', 'edit', {full_name: '{{ $p->full_name }}', image_url: '{{ asset('storage/'.$p->image_url) }}'})" data-modal-target="modal" data-modal-toggle="modal">
                Edit
              </x-form.button>
              <x-form.button use="destroy" onclick="openModal('{{ route('pegawai.destroy.admin', $p->id) }}', 'delete')" data-modal-target="modal" data-modal-toggle="modal">
                Hapus
              </x-form.button>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    @endif

    <div class="mt-2 flex-1 flex justify-center">
      {{ $pegawai->appends(request()->query())->links('pagination::flowbite') }}
    </div>
    </section>
  </main>

  <x-modal>    
    <div id="modal-edit" class="hidden">
      <h2 class="text-xl font-semibold mb-4">Edit Pegawai</h2>
      <div class="flex flex-row gap-4">
        <div class="w-1/2 aspect-[3/4] overflow-hidden">
          <img id="modal-edit-image" class="object-cover w-full h-full rounded-lg" alt=""/>
        </div>
        <div class="w-full flex flex-col items-start">
          <form action="" method="POST" class="flex flex-col items-start w-full gap-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="full_name">Ubah Nama</label>
            <x-form.input type="text" name="full_name" id="full_name"/>
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="image">Foto Pegawai</label>
            <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" type="file">
            <x-form.button type="submit">
              Edit
            </x-form.button>
          </form>
        </div>
      </div>
    </div>
  </x-modal>

</x-layout.admin>