@php
  $sortOptions = [
    ['name' => 'Terbaru', 'value' => 'newest'],
    ['name' => 'Terlama', 'value' => 'oldest'],
  ];
@endphp

<x-layout.admin>
  <header class="mb-4 p-4 bg-white shadow-md rounded-md">
    <h1 class="font-bold text-2xl">Lokasi Penting</h1>
  </header>
  <main class="flex flex-col gap-4">
    {{-- Insert Form --}}
    <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm">
      <form action="{{ route('lokasi-penting.store.admin') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
        @csrf
        <h2 class="text-xl font-semibold">Tambah Lokasi Baru</h2>
        {{-- Form Items --}}
        <div class="flex flex-col gap-4 w-full">
          <div class="flex flex-col md:flex-row gap-2 justify-center">
            <div class="flex flex-col gap-2 flex-1">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="image">Foto Lokasi</label>
              <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" type="file">
            </div>
            <div class="flex flex-col gap-2 flex-1">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="location_name">Nama Lokasi</label>
              <x-form.input type="text" name="location_name" id="location_name"/>
            </div>
          </div>
          <div class="flex flex-col gap-4 flex-1">
            <div class="flex flex-col gap-2">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="description">Deskripsi</label>
              <x-form.textarea name="description" id="description" rows="5" placeholder="Deskripsi Lokasi...">
              </x-form.textarea>
            </div>
            <div class="flex flex-col gap-2">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="link_gmaps">Link Google Maps</label>
              <x-form.input type="text" name="link_gmaps" id="link_gmaps"/>
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
      <form action="{{ route('lokasi-penting.index.admin') }}" method="GET" class="flex flex-col md:flex-row gap-2 bg-white rounded-lg w-full">
        <x-form.search name="location_name" placeholder="Cari berdasarkan nama..." value="{{ request()->input('location_name') }}"/>
        <div class="flex-1 flex items-center flex-col md:flex-row gap-2">
          <span>Urutkan Berdasarkan:</span>
          <x-form.radio :options="$sortOptions" name="sort" action="{{ route('lokasi-penting.index.admin') }}" selected-value="{{ request()->input('sort') ?? 'newest' }}"/>
        </div>
      </form>
    </section>

    <section class="flex flex-1 flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    @if ($lokasi->isEmpty())
      <div class="block p-2.5 w-full mb-4 text-sm text-gray-500 bg-gray-50 text-center">Lokasi tidak ditemukan...</div>
    @else
      <div class="flex flex-col gap-4">
      @foreach ($lokasi as $l)
      <div class="flex flex-col md:flex-row w-full bg-white border border-gray-200 rounded-t-lg md:rounded-l-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="md:w-1/3 aspect-[4/3] overflow-hidden">
          <img class="object-cover w-full h-full rounded-t-lg md:rounded-l-lg" src="{{ asset('storage/'.$l->image_url) }}" alt=""/>
        </div>
        <div class="w-full p-5 flex-1 flex flex-col justify-between">
          <div class="w-full">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $l->location_name }}</h5>

            <p class="font-normal text-gray-500">
              {{ $l->description }}
            </p>
            <p class="font-normal text-blue-500 underline">
              <a href="{{ $l->link_gmaps }}" target="_blank">{{ $l->location_name }}</a>
            </p>
            <p class="font-sm text-gray-500">Diperbaharui pada: 
              <span>{{ \Carbon\Carbon::parse($l->updated_at)->translatedFormat("l, j F Y")}}</span>
            </p>
          </div>
          <div class="flex flex-row gap-2 justify-end mt-4">
            <x-form.button onclick="openModal('{{ route('lokasi-penting.update.admin', $l->id) }}', 'edit', {location_name: '{{ $l->location_name }}', image_url: '{{ asset('storage/'.$l->image_url) }}', description: '{{ $l->description }}', link_gmaps: '{{ $l->link_gmaps }}' })" data-modal-target="modal" data-modal-toggle="modal">
              Edit
            </x-form.button>
            <x-form.button use="destroy" onclick="openModal('{{ route('lokasi-penting.destroy.admin', $l->id) }}', 'delete')" data-modal-target="modal" data-modal-toggle="modal">
              Hapus
            </x-form.button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif

    <div class="mt-2 flex-1 flex justify-center">
      {{ $lokasi->appends(request()->query())->links('pagination::flowbite') }}
    </div>
    </section>
  </main>

  <x-modal>    
    <div id="modal-edit" class="hidden">
      <h2 class="text-xl font-semibold mb-4">Edit Lokasi Penting</h2>
      <div class="flex flex-col gap-2">
        <div class="w-2/3 aspect-video overflow-hidden self-center">
          <img id="modal-edit-image" class="object-cover w-full h-full rounded-lg" alt=""/>
        </div>
        <div class="w-full flex flex-col items-start">
          <form action="" method="POST" class="flex flex-col items-start w-full gap-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-row gap-2">
              <div class="flex flex-col items-start gap-2">
                <label class="block text-sm font-medium text-gray-900 dark:text-white" for="image">Foto Lokasi</label>
                <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" type="file">
              </div>
              <div class="w-2/3 flex flex-col items-start gap-2">
                <label class="block text-sm font-medium text-gray-900 dark:text-white" for="location_name">Ubah Nama Lokasi</label>
                <x-form.input type="text" name="location_name" id="location_name"/>
              </div>
            </div>
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="description">Ubah Deskripsi</label>
            <x-form.textarea name="description" id="description" rows="2" placeholder="Deskripsi Lokasi...">
            </x-form.textarea>
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="link_gmaps">Ubah Link Gmaps</label>
            <x-form.input type="text" name="link_gmaps" id="link_gmaps"/>
            
            <x-form.button type="submit">
              Edit
            </x-form.button>
          </form>
        </div>
      </div>
    </div>
  </x-modal>

</x-layout.admin>