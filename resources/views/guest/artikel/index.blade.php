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
@endphp

<x-layout.guest>
  <header class="mb-4 p-4 bg-white shadow-md rounded-md">
    <h1 class="font-bold text-2xl">Artikel Terkini</h1>
  </header>
  {{-- Search, Sort, dan Filter --}}
  <section class="flex flex-row p-4 md:flex-row gap-2 bg-white rounded-lg shadow-sm">
    <form action="{{ route('artikel.index.guest') }}" method="GET" class="flex flex-col gap-2 bg-white rounded-lg w-full">
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
      </div>
    </form>
  </section>

  <div class="grid gap-4 grid-cols-[repeat(auto-fit,minmax(300px,1fr))] justify-items-center">
    @foreach($artikel as $a)
      <div class="md:max-w-sm w-full bg-white rounded-xl dark:bg-gray-800 dark:border-gray-700 lg:flex-shrink-0">
        <a href="{{ route('artikel.show.guest', $a->slug) }}" class="hover:opacity-60 transition-all duration-300">
          <div class="relative w-full pb-[75%] md:pb-[75%] shadow">
            <img class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg" loading="lazy" src="{{ asset('/storage/'.$a->thumbnail) }}" alt="{{ $a->title }}"/>
          </div>
        </a>
        <div class="p-5 border border-gray-200 rounded-b-xl shadow">
          <div class="flex flex-row items-center gap-2 text-sm">
            <p class="text-blue-700">
              {{ \Carbon\Carbon::parse($a->published_at)->translatedFormat("l, j F Y") }}
            </p>
            <p class="text-white bg-blue-700 py-1 px-2 rounded-full">
              {{ ucwords($a->type) }}
            </p>
          </div>
          <a href="{{ route('artikel.show.guest', $a->slug) }}">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-wrap">{{ $a->title }}</h5>
          </a>
          <a href="{{ route('artikel.show.guest', $a->slug) }}">
            <p class="text-gray-500 text-sm mb-2 text-wrap">{{ Str::limit($a->description, 200) }}</p>
          </a>
          <div class="flex justify-between">
            <a href="{{ route('artikel.show.guest', $a->slug) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Selengkapnya
              <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
              </svg>
            </a>
            <span class="flex flex-row items-center gap-2 text-sm">
              <div>
                {{ $a->views }}
              </div>
              <svg class="w-4 h-4 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
              </svg>
            </span>
          </div>
        </div>
      </div>
      {{-- <x-card.article-card 
      :thumbnail-url="$item['thumbnail']"
      :title="$item['title']"
      :publish-date="$item['published_at']"
      :tag="$item['tag']"
      :description="$item['firstContent']['value']"
      :article-url="route('informasi.index').'/'.$item['slug']"
      :views="$item['views']"
      /> --}}
    @endforeach
  </div>

  <div class="pagination my-4">
    {{ $artikel->appends(request()->query())->links('pagination::tailwind') }}
  </div>
</x-layout.guest>