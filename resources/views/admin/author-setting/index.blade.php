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

<x-layout.admin>
  <header class="mb-4 p-4 bg-white shadow-md rounded-md">
    <h1 class="font-bold text-2xl">Manajemen Penulis</h1>
  </header>

  <main class="flex flex-col gap-4">
    {{-- Insert Form --}}
    <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm">
      <form action="{{ route('author-setting.store.admin') }}" method="POST" class="flex flex-col gap-2">

      
        @csrf
        @method('POST')
        <h2 class="text-xl font-semibold">Tambahkan Penulis</h2>
        <div class="flex flex-col md:flex-row gap-4 w-full">
          <div class="flex flex-row gap-4 flex-1">
          </div>
          <div class="flex flex-col gap-4 flex-1">
            <div class="flex flex-col gap-2 flex-1">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="name">Nama Penulis</label>
              <x-form.input type="text" name="name" id="name"/>
            </div>
          </div>
          <div class="flex flex-col gap-4 flex-1">
            <div class="flex flex-col gap-2 flex-1">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="username">Username</label>
              <x-form.input type="text" name="username" id="username"/>
            </div>
          </div>
          <div class="flex flex-col gap-4 flex-1">
            <div class="flex flex-col gap-2 flex-1">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="email">Email</label>
              <x-form.input type="email" name="email" id="email"/>
            </div>
          </div>
          <div class="flex flex-col gap-4 flex-1">
            <div class="flex flex-col gap-2 flex-1">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="password">Password</label>
              <x-form.input type="password" name="password" id="password"/>
            </div>
          </div>
        </div>
        <x-form.button type="submit">
          Tambah
        </x-form.button>
      </form>
    </section>

    {{-- Search, Sort, dan Filter --}}
    {{-- <section class="flex flex-col p-4 md:flex-row gap-2 bg-white rounded-lg shadow-sm">
      <form action="{{ route('author-setting.index.admin') }}" method="GET" class="flex flex-col md:flex-row gap-2 bg-white rounded-lg w-full">
        <x-form.search name="name" placeholder="Cari berdasarkan nama..." value="{{ request()->input('name') }}"/>
        <div class="flex-1 flex items-center flex-col md:flex-row gap-2">
          <span>Urutkan Berdasarkan:</span>
          <x-form.radio :options="$sortOptions" name="sort" action="{{ route('author-setting.index.admin') }}" selected-value="{{ request()->input('sort') ?? 'newest' }}"/>
        </div>
      </form>
    </section> --}}

    <section class="flex flex-1 flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    @if ($authors->isEmpty())
      <div class="block p-2.5 w-full mb-4 text-sm text-gray-500 bg-gray-50 text-center">Author tidak ditemukan...</div>
    @else
      <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
      @foreach ($authors as $author)
        <div class="flex w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <div class="w-full p-5 flex flex-col justify-between">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $author->name }}</h5>
            <p class="mb-2 font-normal text-sm text-gray-700 dark:text-gray-400">
              {{ $author->username }} | {{ $author->email }}
            </p>
            <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
              Terakhir diperbarui pada
              <div class="text-blue-500">
                {{ \Carbon\Carbon::parse($author->updated_at)->translatedFormat('l, d F Y | H:i:s') }}
              </div>
            </p>
            <div class="flex flex-row gap-2 justify-end">
              <x-form.button onclick="openModal('{{ route('author-setting.update.admin', $author->id) }}', 'edit', {name: '{{ $author->name }}', username: '{{ $author->username }}', email: '{{ $author->email }}'})" data-modal-target="modal" data-modal-toggle="modal">
                Edit
              </x-form.button>
              <x-form.button use="destroy" onclick="openModal('{{ route('author-setting.destroy.admin', $author->id) }}', 'delete')" data-modal-target="modal" data-modal-toggle="modal">
                Hapus
              </x-form.button>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    @endif

    <div class="mt-2 flex-1 flex justify-center">
      {{ $authors->appends(request()->query())->links('pagination::flowbite') }}
    </div>
    </section>
  </main>

  <x-modal>    
    <div id="modal-edit" class="hidden">
      <h2 class="text-xl font-semibold mb-4">Edit Author</h2>
      <div class="flex flex-row gap-4">
        <div class="w-full flex flex-col items-start">
          <form action="" method="POST" class="flex flex-col items-start w-full gap-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="name">Nama Lengkap</label>
            <x-form.input type="text" name="name" id="name"/>
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="username">Username</label>
            <x-form.input type="text" name="username" id="username"/>
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="email">Email</label>
            <x-form.input type="text" name="email" id="email"/>
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="password">Password</label>
            <x-form.input type="password" name="password" id="password"/>
            <x-form.button type="submit">
              Edit
            </x-form.button>
          </form>
        </div>
      </div>
    </div>
  </x-modal>

</x-layout.admin>