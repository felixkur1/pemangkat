<x-layout.guest>
  <main class="w-full flex flex-col items-center">
    <div class="text-3xl font-semibold mb-4">
      Lokasi Penting
    </div>
    
    <div class="grid gap-4 grid-cols-[repeat(auto-fit,minmax(300px,1fr))] justify-items-center bg-gray-100 w-full">
      {{-- Items --}}
      <div class="md:max-w-sm w-full bg-white rounded-xl dark:bg-gray-800 dark:border-gray-700 lg:flex-shrink-0">
        <a href="#" class="hover:opacity-60 transition-all duration-300">
          <div class="relative w-full pb-[75%] md:pb-[75%] shadow">
            <img class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg" loading="lazy" src=""/>
          </div>
        </a>
        <div class="p-5 border border-gray-200 rounded-b-xl shadow">
          <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-wrap">Nama Lokasi</h5>
          </a>
          <a href="#">
            <p class="text-gray-500 text-sm mb-2 text-wrap">Alamat</p>
          </a>
        </div>
      </div>
      <div class="md:max-w-sm w-full bg-white rounded-xl dark:bg-gray-800 dark:border-gray-700 lg:flex-shrink-0">
        <a href="#" class="hover:opacity-60 transition-all duration-300">
          <div class="relative w-full pb-[75%] md:pb-[75%] shadow">
            <img class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg" loading="lazy" src=""/>
          </div>
        </a>
        <div class="p-5 border border-gray-200 rounded-b-xl shadow">
          <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-wrap">Nama Lokasi</h5>
          </a>
          <a href="#">
            <p class="text-gray-500 text-sm mb-2 text-wrap">Alamat</p>
          </a>
        </div>
      </div>
      
      
    </div>
  </main>
</x-layout.guest>