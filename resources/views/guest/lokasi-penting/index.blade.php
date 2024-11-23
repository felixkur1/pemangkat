<x-layout.guest>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
  <main class="w-full flex flex-col items-center">
    <div class="text-3xl font-semibold mb-4">
      Lokasi Penting
    </div>
    {{-- Batas Administrasi --}}
    <div id="map" class="h-[400px] w-full md:w-2/3 mb-4 z-20"></div>
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