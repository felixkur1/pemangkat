@php
  $sortOptions = [
    ['name' => 'Terbaru', 'value' => 'newest'],
    ['name' => 'Terlama', 'value' => 'oldest'],
  ];
  $filterOptions = [
    ['name' => 'Berita', 'value' => 'news'],
    ['name' => 'Semua', 'value' => 'all'],
    ['name' => 'Informasi', 'value' => 'information'],
  ];

  $publishedOptions = [
    ['name' => 'Sudah Terbit', 'value' => 'published'],
    ['name' => 'Semua', 'value' => 'all'],
    ['name' => 'Belum Terbit', 'value' => 'unpublished'],
  ];
@endphp

<x-layout.base>
  <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
          <a href="/" class="flex ms-2 md:me-24">
            <img src="{{ asset('lambang-kabupaten-sambas.png') }}" class="h-8 me-3" alt="Logo Sambas" />
            <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Kecamatan Pemangkat</span>
          </a>
        </div>
        <div class="flex items-center">
            <div class="flex items-center ms-3">
              <div>
                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                  <span class="sr-only">Open user menu</span>
                  <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                </button>
              </div>
              <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                <div class="px-4 py-3" role="none">
                  <p class="text-sm text-gray-900 dark:text-white" role="none">
                    {{ request()->user()->name }}
                  </p>
                  <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                    {{ request()->user()->username }}
                  </p>
                </div>
                <ul class="py-1" role="none">
                  <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profil</a>
                  </li>
                  <form action="/logout" method="POST">
                    @csrf
                    <button type='submit' class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign Out</button>
                  </form>
                </ul>
              </div>
            </div>
          </div>
      </div>
    </div>
  </nav>

  <div class="mt-14 p-4 bg-slate-100">

    <header class="mb-4 p-4 bg-white shadow-md rounded-md">
      <h1 class="font-bold text-2xl">Artikel</h1>
    </header>

    <main class="flex flex-col gap-4">

      {{-- Insert Form --}}
      <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm">
        <form action="{{ route('artikel.store.author') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
          @csrf
          <h2 class="text-xl font-semibold">Tambah Artikel</h2>
          <div class="flex flex-col md:flex-row gap-4 w-full">
            <div class="flex flex-row gap-4 flex-1">
              <div class="flex flex-col gap-2 flex-1">            
                <label class="block text-sm font-medium text-gray-900 dark:text-white" for="thumbnail">Thumbnail Artikel</label>
                <input name="thumbnail" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="thumbnail" type="file">
              </div>
              <div class="flex flex-col gap-2">
                <label class="block text-sm font-medium text-gray-900 dark:text-white" for="type">Jenis Artikel</label>
                <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <option value="berita">Berita</option>
                  <option value="informasi">Informasi</option>
                </select>
              </div>
            </div>
            <div class="flex flex-col gap-4 flex-1">
              <div class="flex flex-col gap-2 flex-1">
                <label class="block text-sm font-medium text-gray-900 dark:text-white" for="title">Judul Artikel</label>
                <x-form.input type="text" name="title" id="title"/>
              </div>
            </div>
          </div>
          <x-form.button type="submit">
            Tambah
          </x-form.button>
        </form>
      </section>

      {{-- Search, Sort, dan Filter --}}
    <section class="flex flex-row p-4 md:flex-row gap-2 bg-white rounded-lg shadow-sm">
      <form action="{{ route('artikel.index.author') }}" method="GET" class="flex flex-col gap-2 bg-white rounded-lg w-full">
        <div class="flex flex-col md:flex-row gap-4">
          <x-form.search name="title" placeholder="Cari berdasarkan judul..." value="{{ request()->input('title') }}"/>
          <div class="flex gap-4 flex-col">
            <div class="flex-1 flex items-center flex-col md:flex-row gap-2">
              <span>Urutkan Berdasarkan:</span>
              <x-form.radio :options="$sortOptions" name="sort" action="{{ route('artikel.index.admin') }}" selected-value="{{ request()->input('sort') ?? 'newest' }}"/>
            </div>
          </div>
        </div>
        <div class="flex-1 flex items-center justify-center flex-col md:flex-row gap-2 w-full">
          <span>Filter Berdasarkan:</span>
          <x-form.radio :options="$filterOptions" name="filter" action="{{ route('artikel.index.admin') }}" selected-value="{{ request()->input('filter') ?? 'all' }}"/>
          <x-form.radio :options="$publishedOptions" name="published" action="{{ route('artikel.index.admin') }}" selected-value="{{ request()->input('published') ?? 'all' }}"/>
        </div>
      </form>
    </section>

    <section class="flex flex-1 flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
      @if ($artikel->isEmpty())
        <div class="block p-2.5 w-full mb-4 text-sm text-gray-500 bg-gray-50 text-center">Artikel tidak ditemukan...</div>
      @else
        <div class="flex flex-col gap-4">
        @foreach ($artikel as $a)
          <div class="flex flex-col md:flex-row w-full bg-white border border-gray-200 rounded-t-lg md:rounded-l-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="md:w-1/3 aspect-[4/3] overflow-hidden">
              <img class="object-cover w-full h-full rounded-t-lg md:rounded-l-lg" src="{{ asset('storage/'.$a->thumbnail) }}" alt=""/>
            </div>
            <div class="w-full p-5 flex-1 flex flex-col justify-between">
              <div class="w-full">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $a->title }}</h5>
                <p class="font-sm text-gray-500">{{ Str::ucfirst($a->type) }}</p>
                <p class="font-sm text-gray-500">Dipublikasikan Pada: 
                  <span>{{ \Carbon\Carbon::parse($a->published_at)->translatedFormat("l, j F Y") ?? "Belum Dipublikasikan" }}</span>
                </p>
                <p class="font-normal text-gray-500">
                  {{ $a->description }}
                </p>
              </div>
              <div class="flex flex-row gap-2 justify-end mt-4">
                <form action="{{ route('artikel.toggle-publish.author', $a->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <x-form.button type="submit">
                    {{ isset($a->published_at) ? 'Batalkan Publikasi' : 'Publikasi' }}
                  </x-form.button>  
                </form>
                <x-form.button onclick="window.location = '{{ route('artikel.edit.author', $a->id) }}'">
                  Edit
                </x-form.button>
                <x-form.button use="destroy" onclick="openModal('{{ route('artikel.destroy.author', $a->id) }}', 'delete')" data-modal-target="modal" data-modal-toggle="modal">
                  Hapus
                </x-form.button>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      @endif
  
      <div class="mt-2 flex-1 flex justify-center">
        {{ $artikel->appends(request()->query())->links('pagination::flowbite') }}
      </div>
    </section>
    </main>
  </div>
  @if(session('message'))
    <x-toast :message="session('message')" :type="session('type', 'success')" />
  @endif
</x-layout.base>