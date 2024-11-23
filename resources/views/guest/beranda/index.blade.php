<x-layout.guest>
  <main class="w-full flex flex-col items-center">
    <div class="md:w-2/3 w-full flex flex-col items-center gap-4">
      <div class="text-3xl font-semibold italic">
        Kata Sambutan
      </div>
      <div class="bootstrap-styled">
        {!! $greetings->content ?? "" !!}
      </div>
      <x-highlight :items="$articles"/>
      <div class="text-3xl font-semibold italic">
        Sekapur Sirih
      </div>
      <div class="bootstrap-styled w-full">
        {!! $messages->content ?? "" !!}
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