@php
$navItems = [
  [
    'name' => 'Beranda',
    'type' => 'link',
    'url' => route('beranda.index.guest'),
  ],
  [
    'name' => 'Visi dan Misi',
    'type' => 'link',
    'url' => route('visi-misi.index.guest'),
  ],
  [
    'name' => 'Struktur Organisasi',
    'type' => 'link',
    'url' => route('struktur-organisasi.index.guest'),
  ],
  [
    'name' => 'Dokumen Publik',
    'type' => 'link',
    'url' => route('dokumen-publik.index.guest'),
  ],
  [
    'name' => 'Lokasi Penting',
    'type' => 'link',
    'url' => route('lokasi-penting.index.guest'),
  ],
  [
    'name' => 'Artikel',
    'type' => 'link',
    'url' => route('artikel.index.guest'),
  ],
];

$webDesa = [
  [
    'name' => 'Gugah Sejatera',
    'url' => 'gugah-sejahtera'
  ],
  [
    'name' => 'Harapan',
    'url' => 'harapan'
  ],
  [
    'name' => 'Jelutung',
    'url' => 'jelutung'
  ],
  [
    'name' => 'Lonam',
    'url' => 'lonam'
  ],
  [
    'name' => 'Pemangkat Kota',
    'url' => 'pemangkat-kota'
  ],
  [
    'name' => 'Penjajap',
    'url' => 'penjajap'
  ],
  [
    'name' => 'Perapakan',
    'url' => 'perapakan'
  ],
  [
    'name' => 'Sebatuan',
    'url' => 'sebatuan'
  ],
];

@endphp

<footer class="bg-slate-800 mt-8">
  <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
    <div class="md:flex md:justify-between">

      <div class="mb-6 md:mb-0 flex flex-col gap-4">
        <a href="/" class="flex items-center gap-4">
          <div class="flex items-center justify-center bg-white h-16 w-16 rounded-full">
            <img src="{{ asset('lambang-kabupaten-sambas.png') }}" class="h-4/5" alt="Logo Kabupaten Sambas" />
          </div>
          <span class="text-white self-center text-2xl font-semibold whitespace-nowrap">Kecamatan Pemangkat</span>
        </a>
        <h2 class="mb-2 text-sm font-semibold text-white uppercase dark:text-white">Lokasi Kantor</h2>
        <iframe class="rounded-xl" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.978170143096!2d108.97358549999998!3d1.1758371000000027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31e482e781e5b397%3A0xf4b3656562d567e4!2sKantor%20Camat%20Pemangkat!5e0!3m2!1sid!2sid!4v1732758727831!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <div class="grid grid-cols-2 gap-12 sm:gap-8 sm:grid-cols-3 md:w-1/2">
        <div>
          <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">Situs Desa</h2>
          <ul class="text-slate-400 dark:text-gray-400 font-medium flex flex-col gap-4">
            @foreach ($webDesa as $item)  
              <li class="">
                <a href="{{ $item['url'] . '.' . route('beranda.index.guest') }}" class="hover:underline hover:text-white">{{ $item['name'] }}</a>
              </li>
            @endforeach
          </ul>
        </div>

        <div>
          <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">Jelajahi</h2>
          <ul class="text-slate-400 dark:text-gray-400 font-medium flex flex-col gap-4">
            @foreach ($navItems as $item)  
              <li class="">
                <a href="{{ $item['url'] }}" class="hover:underline hover:text-white">{{ $item['name'] }}</a>
              </li>
            @endforeach
          </ul>
        </div>

        <div>
          <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">Hubungi Kami</h2>
          <ul class="text-slate-400 dark:text-gray-400 font-medium">
            <li class="mb-4">
              <a href="#" class="hover:underline hover:text-white inline-flex gap-2">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z"/>
                </svg>                
                Telepon
              </a>
            </li>
            <li class="mb-4">
              <a href="#" class="hover:underline hover:text-white inline-flex gap-2">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path fill="currentColor" fill-rule="evenodd" d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z" clip-rule="evenodd"/>
                  <path fill="currentColor" d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z"/>
                </svg>
                WhatsApp
              </a>
            </li>
            <li class="mb-4">
              <a href="#" class="hover:underline hover:text-white inline-flex gap-2">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
                </svg>                
                Facebook
              </a>
            </li>
            <li class="mb-4">
              <a href="#" class="hover:underline hover:text-white inline-flex gap-2">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                </svg>                     
                Instagram
              </a>
            </li>
            <li class="mb-4">
              <a href="#" class="hover:underline hover:text-white inline-flex gap-2">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z" clip-rule="evenodd"/>
                </svg>
                YouTube
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
    <div class="sm:flex sm:items-center sm:justify-between">
      <span class="text-sm text-slate-500 sm:text-center ">© 2024 <a href="/" class="hover:underline">Kecamatan Pemangkat</a>. All Rights Reserved.
      </span>
    </div>
  </div>
</footer>
