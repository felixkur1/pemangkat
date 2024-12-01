<x-layout.guest>
  <div class="relative h-screen w-full">
    <img class="absolute inset-0 object-cover w-full h-full brightness-50" src="{{ asset('guest-background.jpg') }}" alt="">

    <div class="absolute flex-col inset-0 flex items-center justify-center gap-4 z-10 text-center">
      <p class="text-white text-4xl font-bold">Selamat Datang di Website Resmi</p>
      <p class="text-white text-xl font-semibold">Desa Jelutung | Kecamatan Pemangkat</p>
    </div>
  </div>
  
  <main class="w-full flex flex-col items-center gap-4 mt-4">
    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg text-center">
      <h1 class="text-3xl font-semibold p-4">Sorotan</h1>
      <x-highlight :items="$articles"/>
    </div>

    {{-- Sedikit Tentang Desa Jelutung --}}
    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg bg-white">
      <h1 class="text-3xl font-semibold p-4 text-center">Sedikit Tentang Desa Jelutung</h1>
      <div class="bootstrap-styled">
        {!! $greetings->content ?? "" !!}
      </div>
    </div>

    {{-- Video Profil --}}
    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg bg-white">
      <h1 class="text-3xl font-semibold p-4 text-center">Video Profil</h1>
      <div class="bootstrap-styled">
        {!! $profile_video->content ?? "" !!}
      </div>
    </div>

    {{-- Sejarah --}}
    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg bg-white">
      <h1 class="text-3xl font-semibold w-full text-center p-4">Sejarah</h1>
      
      <div class="bootstrap-styled">
        {!! $history->content ?? "" !!}
      </div>
      
    </div>

    {{-- Statistik --}}
    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg bg-white">
      <h1 class="text-3xl font-semibold w-full text-center p-4">Statistik</h1>
      <x-statistics />
    </div>

    {{-- Kumpulan Artikel --}}
    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg bg-white">
      <h1 class="text-3xl font-semibold w-full text-center p-4">Kumpulan Berita</h1>
      <div>
        <x-article-slider 
          type="newest"
          slider-title="Berita Terkini"
          slider-description="Dapatkan Update Terbaru dari Sumber Terpercaya"
          slider-url="{{ route('artikel.index.guest') }}"
        />
        {{-- <hr class="h-1 my-8 bg-gray-200 border-0 dark:bg-gray-700 w-full"> --}}
        <x-article-slider 
          type="important"
          slider-title="Informasi Penting"
          slider-description="Pengumuman dan Informasi Penting yang Harus Anda Ketahui"
          slider-url="{{ route('artikel.index.guest') }}"
        />
        {{-- <hr class="h-1 my-8 bg-gray-200 border-0 dark:bg-gray-700 w-full"> --}}
        <x-article-slider 
          type="popular"
          slider-title="Paling Sering Dilihat"
          slider-description="Berita Populer yang Sedang Hangat Dibicarakan"
          slider-url="{{ route('artikel.index.guest') }}"
        />
      </div>
    </div>
  </main>
</x-layout.guest>