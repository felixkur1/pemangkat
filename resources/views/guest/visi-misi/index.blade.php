<x-layout.guest>
  <div class="relative h-[calc(100vh-12rem)] w-full">
    <img class="absolute inset-0 object-cover w-full h-full brightness-50" src="{{ asset('guest-background.jpg') }}" alt="">
    <div class="absolute flex-col inset-0 flex items-center justify-center gap-4 z-10 text-center">
      <p class="text-white text-4xl font-bold">Visi dan Misi</p>
      <p class="text-white text-xl font-semibold">Desa Jelutung</p>
    </div>
  </div>

  <main class="w-full flex flex-col items-center gap-4 mt-4">
    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg text-center">
      <h1 class="text-3xl font-bold p-4">Visi</h1>
      <blockquote class="text-xl italic font-semibold text-gray-900 dark:text-white">
        {{ $vision->value ?? " " }}
      </blockquote>
    </div>
    
    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg text-center">
      <h1 class="text-3xl font-bold p-4">Misi</h1>
      <ol class="list-decimal ml-5 flex flex-col gap-4">
        @foreach ($missions as $mission)
        
          <li class="text-justify">{{ $mission->value }}</li>
        @endforeach
      </ol>
    </div>

   
   
  </main>
</x-layout.guest>