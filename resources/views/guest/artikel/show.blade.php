<x-layout.guest>
  <div class="relative h-[30vh] w-full">
    <img class="absolute inset-0 object-cover w-full h-full brightness-50" src="{{ asset('guest-background.jpg') }}" alt="">
  </div>
  <main class="w-full flex flex-col items-center gap-4 mt-4">
    {{-- Header --}}
    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg text-center flex flex-col gap-4">
      {{-- Title and Type --}}
      <div class="flex flex-row justify-between ">
        <h1 class="font-semibold text-2xl">{{ $article->title }}</h1>
        <p class="font-medium text-base bg-blue-700 text-white p-2 rounded-lg">{{ ucwords($article->type) }} </p>
      </div>

      {{-- Published and Writer --}}
      <div class="flex text-sm flex-row gap-2">
        <span class="text-blue-700">{{ \Carbon\Carbon::parse($article->published_at)->translatedFormat("l, j F Y") }}</span>
        <span> | </span>
        <span>{{ $article->user->name }}</span>
      </div>

      <div class="relative w-full pb-[75%] md:pb-[75%] shadow aspect-video">
        <img class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg" loading="lazy" src="{{ asset('/storage/'.$article->thumbnail) }}" alt="{{ $article->title }}"/>
      </div>
      
    </div>
    {{-- Content --}}
    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg flex flex-col gap-4">
      <div class="bootstrap-styled">
        {!! $article->content !!}
      </div>
    </div>
  </main>
</x-layout.guest>