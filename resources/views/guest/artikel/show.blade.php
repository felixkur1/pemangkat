<x-layout.guest>
  <div class="flex justify-center">
    <header class="mb-4 p-4 w-full bg-white shadow-md rounded-md flex flex-col gap-2 md:w-2/3">
      <h1 class="inline-flex justify-between items-center font-semibold text-2xl">{{ $article->title }} <span class="font-medium text-base bg-blue-700 text-white p-2 rounded-tl-lg rounded-br-lg">{{ ucwords($article->type) }}</span></h1>
      <div class="text-xs">
        Dipublikasikan pada tanggal: <span class="text-blue-700">{{ \Carbon\Carbon::parse($article->published_at)->translatedFormat("l, j F Y") }}</span>
      </div>
      <img src="{{ asset('storage/'.$article->thumbnail) }}" alt="">
    </header>
  </div>
  <main class="flex flex-col items-center">
    <div class="md:w-2/3 w-full bootstrap-styled">
      {!! $article->content !!}
    </div>
  </main>
</x-layout.guest>