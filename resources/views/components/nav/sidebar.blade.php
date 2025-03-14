@php
  $navItems = [
  [
    'name' => 'Beranda',
    'type' => 'link',
    'url' => route('beranda.index.admin'),
  ],
  [
    'name' => 'Visi dan Misi',
    'type' => 'link',
    'url' => route('visi-misi.index.admin'),
  ],
  [
    'name' => 'Struktur Organisasi',
    'type' => 'dropdown',
    'urls' => [route('pegawai.index.admin'), route('struktur-organisasi.index.admin')],
    'items' => [
        ['name' => 'Pegawai', 'url' => route('pegawai.index.admin')],
        ['name' => 'Susunan Organisasi', 'url' => route('struktur-organisasi.index.admin')],
    ],
  ],
  [
    'name' => 'Dokumen Publik',
    'type' => 'link',
    'url' => route('dokumen-publik.index.admin'),
  ],
  [
    'name' => 'Lokasi Penting',
    'type' => 'link',
    'url' => route('lokasi-penting.index.admin'),
  ],
  [
    'name' => 'Artikel',
    'type' => 'link',
    'url' => route('artikel.index.admin'),
  ],
  [
    'name' => 'Author Setting',
    'type' => 'link',
    'next' => true,
    'url' => route('author-setting.index.admin'),
  ],
];
$currentRoute = request()->url();
@endphp
<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
        </button>
        <a href="/" class="flex flex-row items-center gap-2 ms-2 md:me-24">
          <img src="{{ asset('lambang-kabupaten-sambas.png') }}" class="h-10 me-3" alt="Logo Sambas" />
          <div class="flex flex-col">
            <span class="text-base font-semibold whitespace-nowrap text-slate-900">Desa Jelutung</span>
            <span class="text-sm font-semibold whitespace-nowrap text-slate-900">Kecamatan Pemangkat</span>
          </div>
        </a>
      </div>
      <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button type="button" class="flex text-sm bg-white rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open Author Setting menu</span>
                <img class="w-8 h-8 rounded-full" src="{{ asset('default-user.png') }}" alt="user photo">
              </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
              <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                  {{ request()->user()->name }}
                </p>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                  {{ request()->user()->username }}
                </p>
              </div>
              <ul class="py-1" role="none">
                <li>
                  <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profil</a>
                </li>
                <li>
                  <form action="/logout" method="POST">
                    @csrf
                    <button type='submit' class="w-full block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white text-left" role="menuitem">Sign Out</button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
  <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
    <ul class="space-y-2 font-medium">
      @foreach ($navItems as $index => $item)
      @if (isset($item['next']))
      <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
      @endif
      @if ($item['type'] == 'link')
      <li>
        <a href="{{ $item['url'] }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          {{-- <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
          </svg> --}}
          <span class="ms-3 {{ $currentRoute == $item['url'] ? 'text-blue-500' : '' }}">{{ $item['name'] }}</span>
        </a>
      </li>
      @elseif ($item['type'] == 'dropdown')
      <li>
        <button type="button" class="flex items-center w-full p-2 text-base {{ in_array($currentRoute, $item['urls']) ? 'text-blue-500' : 'text-gray-900'}} transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example-{{ $index }}" data-collapse-toggle="dropdown-example-{{ $index }}">
          {{-- <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
          </svg> --}}
          <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $item['name'] }}</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
          </svg>
        </button>
        <ul id="dropdown-example-{{ $index }}" class="{{ in_array($currentRoute, $item['urls']) ? 'block' : 'hidden' }} py-2 space-y-2">
          @foreach ($item['items'] as $i)  
          <li>
            <a href="{{ $i['url'] }}" class="flex items-center w-full p-2 {{ $currentRoute == $i['url'] ? 'text-blue-500' : 'text-gray-900' }} transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ $i['name'] }}</a>
          </li>
          @endforeach
        </ul>
      </li>
      @endif
      @endforeach        
    </ul>
  </div>
</aside>

<div class="px-4 pt-20 sm:ml-64 bg-gray-100 min-h-screen">
  {{ $slot }}
</div>
