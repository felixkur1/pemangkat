<x-layout.guest>
  <main class="w-full flex flex-col items-center">
    <x-highlight :items="$articles"/>
    <div class="w-full md:w-2/3 pb-4 bg-gradient-to-r from-red-800 to-red-600 text-white mt-4 rounded-xl">
      <h1 class="text-3xl font-semibold p-4">Selamat Datang</h1>
      <div class="px-4">
        <div class="md:w-2/3 w-full float-left flex items-center flex-col mb-4">
          <iframe class="w-full float-left md:pr-4 aspect-video" src="https://www.youtube.com/embed/A6cSbof7Pik?si=DeNCVjcvxo8qHfSR" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          <p class="text-sm"><i>Video Profil Pemangkat</i></p>
        </div>
        <p class="leading-relaxed bootstrap-styled">
          {!! $greetings->content ?? "" !!}
        </p>
      </div>
    </div>

    {{-- Portal Web Desa --}}
    <div class="w-full md:w-2/3 p-4 bg-gradient-to-r from-lime-600 to-lime-700 text-white mt-4 rounded-xl">
      <x-nav.portal />
    </div>

    <div class="w-full md:w-2/3 pb-4 bg-gradient-to-r from-teal-700 to-teal-600 text-white mt-4 rounded-xl">
      <h1 class="text-3xl font-semibold w-full text-right p-4">Sejarah</h1>
      <div class="px-4">
        <div class="md:w-2/3 w-full float-right flex items-center flex-col mb-4">
          <iframe class="w-full float-left md:pr-4 aspect-video" src="https://www.youtube.com/embed/A6cSbof7Pik?si=DeNCVjcvxo8qHfSR" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          <p class="text-sm"><i>Video Profil Pemangkat</i></p>
        </div>
        <p class="leading-relaxed bootstrap-styled">
          {!! $history->content ?? "" !!}
        </p>
      </div>
    </div>

    <div class="text-3xl font-semibold mb-4">
      Statistik Kecamatan Pemangkat
    </div>
    <div>
      <div id="myplot"></div>
      <script type="module">

        import * as Plot from "https://cdn.jsdelivr.net/npm/@observablehq/plot@0.6/+esm";

        const plot = Plot.rectY({length: 100}, Plot.binX({y: "count"}, {x: Math.random})).plot();
        const div = document.querySelector("#myplot");
        div.append(plot);

      </script>
    </div>
    <div class="text-3xl font-semibold mb-4">
      Kumpulan Berita
    </div>
  </main>
  <x-article-slider 
    type="newest"
    slider-title="Berita Terkini"
    slider-description="Dapatkan Update Terbaru dari Sumber Terpercaya"
    slider-url="{{ route('artikel.index.guest') }}"
  />
  <hr class="h-1 my-8 bg-gray-200 border-0 dark:bg-gray-700 w-full">
  <x-article-slider 
    type="important"
    slider-title="Informasi Penting"
    slider-description="Pengumuman dan Informasi Penting yang Harus Anda Ketahui"
    slider-url="{{ route('artikel.index.guest') }}"
  />
  <hr class="h-1 my-8 bg-gray-200 border-0 dark:bg-gray-700 w-full">
  <x-article-slider 
    type="popular"
    slider-title="Paling Sering Dilihat"
    slider-description="Berita Populer yang Sedang Hangat Dibicarakan"
    slider-url="{{ route('artikel.index.guest') }}"
  />
</x-layout.guest>