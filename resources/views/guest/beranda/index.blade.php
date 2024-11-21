<x-layout.guest>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
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
      Wilayah Administrasi
    </div>
    {{-- Batas Administrasi --}}
    <div id="map" class="h-[400px] w-full md:w-2/3 mb-8"></div>
    <script>
        // Inisialisasi peta
        var map = L.map('map').setView([1.1667, 108.9667], 11);

        // Tambahkan layer OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Ambil data GeoJSON menggunakan fetch
        fetch('{{ asset("batas-wilayah-pemangkat.geojson") }}')
            .then(response => response.json())
            .then(data => {
                // Tambahkan GeoJSON ke peta
                const pemangkatLayer = L.geoJSON(data, {
                    style: {
                        fillColor: '#DEEBF7',
                        weight: 2,
                        opacity: 1,
                        color: '#08519C',
                        fillOpacity: 0.6
                    },
                    onEachFeature: function(feature, layer) {
                        // Tambahkan popup jika ada properti
                        if (feature.properties && feature.properties.name) {
                            layer.bindPopup(feature.properties.name);
                        }
                    }
                }).addTo(map);

                // Fit bounds ke area Pemangkat
                map.fitBounds(pemangkatLayer.getBounds(), {
                    padding: [50, 50]
                });
            })
            .catch(error => console.error('Error loading GeoJSON:', error));
    </script>
    <div class="text-4xl font-semibold mb-4">
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