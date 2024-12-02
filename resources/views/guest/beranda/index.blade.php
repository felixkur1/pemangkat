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

    {{-- Informasi Geografis --}}
    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg bg-white">
      <h1 class="text-3xl font-semibold w-full text-center p-4">Informasi Geografis</h1>
      <div class="w-full flex flex-col md:flex-row justify-center items-center gap-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31912.210307009012!2d108.97268724080038!3d1.1416674262313953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31e37d540ab6abdd%3A0x57709b336c9e59d7!2sJelutung%2C%20Kec.%20Pemangkat%2C%20Kabupaten%20Sambas%2C%20Kalimantan%20Barat!5e0!3m2!1sid!2sid!4v1733039080414!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="flex flex-col gap-4">
          
          {{-- Batas Daerah --}}
          <div class="p-4 shadow-xl rounded-xl border-2 border-dashed border-slate-300">
            <h2 class="text-xl font-semibold">Perbatasan Wilayah</h2>
            <div class="p-2">
              <p><b>Utara</b> dengan <b>Desa Gugah Sejahtera</b></p>
              <hr class="h-px my-2 bg-gray-200 border-0">
              <p><b>Selatan</b> dengan <b>Desa Sebatuan</b></p>
              <hr class="h-px my-2 bg-gray-200 border-0">
              <p><b>Barat</b> dengan <b>Desa Pemangkat Kota</b></p>
              <hr class="h-px my-2 bg-gray-200 border-0">
              <p><b>Timur</b> dengan <b>Desa Perapakan</b></p>
            </div>
          </div>

          {{-- Geografis Lainnya --}}
          <div class="p-4 shadow-xl rounded-xl border-2 border-dashed border-slate-300">
            <h2 class="text-xl font-semibold">Informasi Lainnya</h2>
            <div class="p-2 flex flex-col">
              <p><b>Luas Wilayah:</b> 1.420 Ha (14,2 km<sup>2</sup>)</p>
              <hr class="h-px my-2 bg-gray-200 border-0">
              <p><b>Luas Lahan Pertanian Teririgasi:</b> 150 Ha (1,5 km<sup>2</sup>)</p>
              <hr class="h-px my-2 bg-gray-200 border-0">
              <p><b>Luas Lahan Pertanian Pasang Surut:</b> 50 Ha (0,5 km<sup>2</sup>)</p>
              <hr class="h-px my-2 bg-gray-200 border-0">
              <p><b>Luas Lahan Perkebunan:</b> 71 Ha (0,71 km<sup>2</sup>)</p>
              <hr class="h-px my-2 bg-gray-200 border-0">
              <p><b>Luas Lahan Kosong/Belukar:</b> 100 Ha (1 km<sup>2</sup>)</p>
              <hr class="h-px my-2 bg-gray-200 border-0">
              <p><b>Jumlah Dusun:</b> 3</p>
              <hr class="h-px my-2 bg-gray-200 border-0">
              <p><b>RT:</b> 17</p>
              <hr class="h-px my-2 bg-gray-200 border-0">
              <p><b>RW:</b> 4</p>
            </div>
          </div>

        </div>
      </div>
    </div>

    {{-- Kumpulan Artikel --}}
    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg bg-white">
      <h1 class="text-3xl font-semibold w-full text-center p-4">Kumpulan Berita</h1>
      <div class="flex flex-col gap-4">
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