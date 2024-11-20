@php
  $sortOptions = [
    ['name' => 'Terbaru', 'value' => 'newest'],
    ['name' => 'Terlama', 'value' => 'oldest'],
  ];
@endphp

<x-layout.guest>
  <header class="mb-4 p-4 bg-white shadow-md rounded-md">
    <h1 class="font-bold text-2xl">Dokumen Publik</h1>
  </header>
  <main class="flex flex-col gap-4">
    {{-- Search, Sort, dan Filter --}}
    <section class="flex flex-col p-4 md:flex-row gap-2 bg-white rounded-lg shadow-sm">
      <form action="{{ route('dokumen-publik.index.guest') }}" method="GET" class="flex flex-col md:flex-row gap-2 bg-white rounded-lg w-full">
        <x-form.search name="title" placeholder="Cari berdasarkan judul..." value="{{ request()->input('title') }}"/>
        <div class="flex-1 flex items-center flex-col md:flex-row gap-2">
          <span>Urutkan Berdasarkan:</span>
          <x-form.radio :options="$sortOptions" name="sort" action="{{ route('dokumen-publik.index.guest') }}" selected-value="{{ request()->input('sort') ?? 'newest' }}"/>
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
</x-layout.guest>