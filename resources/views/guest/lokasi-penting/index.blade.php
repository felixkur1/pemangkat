@php
  $sortOptions = [
    ['name' => 'Terbaru', 'value' => 'newest'],
    ['name' => 'Terlama', 'value' => 'oldest'],
  ];
@endphp

<x-layout.guest>
  <header class="mb-4 p-4 bg-white shadow-md rounded-md">
    <h1 class="font-bold text-2xl">Lokasi Penting</h1>
  </header>
  <main class="flex flex-col gap-4">
    {{-- Search, Sort, dan Filter --}}
    <section class="flex flex-col p-4 md:flex-row gap-2 bg-white rounded-lg shadow-sm">
      <form action="{{ route('lokasi-penting.index.guest') }}" method="GET" class="flex flex-col md:flex-row gap-2 bg-white rounded-lg w-full">
        <x-form.search name="title" placeholder="Cari berdasarkan nama..." value="{{ request()->input('title') }}"/>
        <div class="flex-1 flex items-center flex-col md:flex-row gap-2">
          <span>Urutkan Berdasarkan:</span>
          <x-form.radio :options="$sortOptions" name="sort" action="{{ route('dokumen-publik.index.guest') }}" selected-value="{{ request()->input('sort') ?? 'newest' }}"/>
        </div>
      </form>
    </section>
    
    <section class="flex flex-1 flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
      @if ($lokasi_penting->isEmpty())
        <div class="block p-2.5 w-full mb-4 text-sm text-gray-500 bg-gray-50 text-center">Dokumen tidak ditemukan...</div>
      @else
        <div class="grid md:grid-cols-2 grid-cols-1 gap-4 place-items-center">
        @foreach ($lokasi_penting as $l)
        <div class="md:max-w-sm w-full bg-white rounded-xl dark:bg-gray-800 dark:border-gray-700 lg:flex-shrink-0">
          <a href="{{ $l->link_gmaps }}" target="_blank" class="hover:opacity-60 transition-all duration-300">
            <div class="relative w-full pb-[75%] md:pb-[75%] shadow">
              <img class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg" loading="lazy" src="{{ asset('/storage/'.$l->image_url) }}" alt="{{ $l->location_name }}"/>
            </div>
          </a>
          <div class="p-5 border border-gray-200 rounded-b-xl shadow">
            <a href="{{ $l->link_gmaps }}" target="_blank">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-wrap">{{ $l->location_name }}</h5>
            </a>
            <a href="{{ $l->link_gmaps }}" target="_blank">
              <p class="text-gray-500 text-sm mb-2 text-wrap">{{ Str::limit($l->description, 200) }}</p>
            </a>
            <div class="flex justify-end">
              <a href="{{ $l->link_gmaps }}" target="_blank" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Buka di Google Maps
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
  
      <div class="mt-2 flex-1 flex justify-center">
        {{ $lokasi_penting->appends(request()->query())->links('pagination::flowbite') }}
      </div>
    </section>
  </main>
</x-layout.guest>