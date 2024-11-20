<x-layout.base title="{{ isset($title) ? $title : 'Kecamatan Pemangkat' }}">
  <x-nav.navbar />
  <main class="px-4 mt-20">
    {{ $slot }}
  </main>
  <x-footer />
</x-layout.base>