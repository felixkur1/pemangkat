@php
$navItems = [
  [
    'name' => 'Beranda',
    'type' => 'link',
    'url' => route('beranda.index.guest'),
  ],
  [
    'name' => 'Administrasi',
    'type' => 'dropdown',
    'urls' => [route('visi-misi.index.guest'), route('struktur-organisasi.index.guest'), route('dokumen-publik.index.guest')],
    'items' => [
      ['name' => 'Visi dan Misi', 'url' => route('visi-misi.index.guest')],
      ['name' => 'Struktur Organisasi', 'url' => route('struktur-organisasi.index.guest')],
      ['name' => 'Dokumen Publik', 'url' => route('dokumen-publik.index.guest')],
    ],
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

$currentRoute = request()->url();
@endphp

<nav id="navbar" class="bg-transparent fixed w-full z-50 top-0 start-0 text-white transition-all duration-300">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="{{ route('beranda.index.guest') }}" class="flex items-center gap-2 space-x-3 rtl:space-x-reverse">
      <img src="{{ asset('lambang-kabupaten-sambas.png') }}" class="h-12" alt="Logo Kabupaten Sambas">
      <div class="flex flex-col">
        <span class="text-base font-semibold whitespace-nowrap text-white">Desa Jelutung</span>
        <span class="text-sm font-semibold whitespace-nowrap text-white">Kecamatan Pemangkat</span>
      </div>
    </a>
  
    <!-- Hamburger Button -->
    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <button id="navbar-toggle" data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-amber-600 border-2 border-white focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>
    </div>

    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 transition-all" id="navbar-sticky">
      <ul id="" class="flex flex-col gap-1 p-4 md:p-0 mt-4 text-white font-medium border border-gray-100 rounded-lg bg- md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent bg-amber-600">
        @foreach ($navItems as $index => $navItem)
          @if ($navItem['type'] == 'link')
            @if ($navItem['url'] == $currentRoute)
              <li>
                <a href="{{ $navItem['url'] }}" class="block py-2 px-3 rounded md:bg-transparent md:p-0 bg-amber-500 md:text-white md:underline md:underline-offset-2 md:decoration-2" aria-current="page">{{ $navItem['name'] }}</a>
              </li>
            @else
              <li>
                <a href="{{ $navItem['url'] }}" class="block py-2 px-3 rounded hover:bg-amber-500 md:hover:bg-transparent md:hover:text-white md:p-0 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 cursor-pointer">{{ $navItem['name'] }}</a>
              </li>
            @endif
          @elseif ($navItem['type'] == 'dropdown')
            <li>
              @if (in_array($currentRoute, $navItem['urls']))  
                <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar{{ $index }}" class="flex items-center justify-between w-full py-2 px-3 rounded md:bg-transparent md:text-white md:hover:bg-transparent bg-amber-500 md:border-0 md:p-0 md:w-auto md:underline md:underline-offset-2 md:decoration-2">{{ $navItem['name'] }}
                  <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
                </button>
              @else
                <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar{{ $index }}" class="flex items-center justify-between w-full py-2 px-3 rounded md:hover:bg-transparent hover:bg-amber-500 md:border-0 md:hover:text-white md:p-0 md:w-auto">{{ $navItem['name'] }}
                  <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
                </button>
              @endif
              <!-- Dropdown menu -->
              <div id="dropdownNavbar{{ $index }}" class="z-10 hidden gap-1 font-normal bg-white/20 backdrop-blur-sm transition-colors duration-300 divide-y divide-gray-100 rounded-lg shadow w-44 px-2">
                <ul class="py-2 text-sm text-gray-700 flex flex-col gap-1 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                  @foreach ($navItem['items'] as $dropdownItem)
                    @if ($dropdownItem['url'] == $currentRoute)
                      <li>
                        <a href="{{ $dropdownItem['url'] }}" class="rounded-md block px-4 py-2 text-white bg-amber-600">{{ $dropdownItem['name'] }}</a>
                      </li>
                    @else
                      <li>
                        <a href="{{ $dropdownItem['url'] }}" class="rounded-md block px-4 py-2 text-white hover:bg-amber-600">{{ $dropdownItem['name'] }}</a>
                      </li>
                    @endif
                  @endforeach
                </ul>
              </div>
              <script>
                document.addEventListener("DOMContentLoaded", function () {
                  const dropdownNavbar = document.getElementById("dropdownNavbar{{ $index }}");

                  window.addEventListener("scroll", function () {
                  if (window.scrollY > 50) {
                    dropdownNavbar.classList.add("bg-amber-700");
                    dropdownNavbar.classList.remove("bg-white/20", 'backdrop-blur-sm');
                  } else {
                    dropdownNavbar.classList.remove("bg-amber-700");
                    dropdownNavbar.classList.add("bg-white/20", 'backdrop-blur-sm');
                  }
                });
                })
              </script>
            </li>
          @endif
        @endforeach
      </ul>
    </div>
  </div>
</nav>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.getElementById("navbar");
    
    window.addEventListener("scroll", function () {
      if (window.scrollY > 50) {
        navbar.classList.remove("bg-transparent");
        navbar.classList.add("bg-amber-500", "shadow-lg");

      } else {
        navbar.classList.add("bg-transparent");
        navbar.classList.remove("bg-amber-500", "shadow-lg");
      }
    });
  });

</script>