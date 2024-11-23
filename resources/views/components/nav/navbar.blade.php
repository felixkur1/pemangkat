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

<nav class="bg-white dark:bg-gray-900 fixed w-full z-50 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="{{ route('beranda.index.guest') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="{{ asset('lambang-kabupaten-sambas.jpg') }}" class="h-8" alt="Logo Kabupaten Sambas">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Kecamatan Pemangkat</span>
  </a>
  
  <!-- Hamburger Button -->
  <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
    <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
      </svg>
    </button>
  </div>

  <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
    <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
      @foreach ($navItems as $index => $navItem)
        @if ($navItem['type'] == 'link')
          @if ($navItem['url'] == $currentRoute)
            <li>
              <a href="{{ $navItem['url'] }}" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">{{ $navItem['name'] }}</a>
            </li>
          @else
            <li>
              <a href="{{ $navItem['url'] }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700 cursor-pointer">{{ $navItem['name'] }}</a>
            </li>
          @endif
        @elseif ($navItem['type'] == 'dropdown')
          <li>
            @if (in_array($currentRoute ,$navItem['urls']))  
              <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar{{ $index }}" class="flex items-center justify-between w-full py-2 px-3 bg-blue-700 text-white rounded md:bg-transparent md:text-blue-700 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">{{ $navItem['name'] }}
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
              </button>
            @else  
              <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar{{ $index }}" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">{{ $navItem['name'] }}
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
              </button>
            @endif
            <!-- Dropdown menu -->
            <div id="dropdownNavbar{{ $index }}" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
              <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                @foreach ($navItem['items'] as $dropdownItem)
                  @if ($dropdownItem['url'] == $currentRoute)
                    <li>
                      <a href="{{ $dropdownItem['url'] }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-blue-700 text-blue-700">{{ $dropdownItem['name'] }}</a>
                    </li>
                  @else
                    <li>
                      <a href="{{ $dropdownItem['url'] }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $dropdownItem['name'] }}</a>
                    </li>
                  @endif
                @endforeach
              </ul>
            </div>
          </li>
        @endif
      @endforeach
    </ul>
  </div>
  </div>
</nav>
