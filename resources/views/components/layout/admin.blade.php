<x-layout.base title="{{ isset($title) ? $title : 'Halaman Admin' }}">
  <x-nav.sidebar>
    {{ $slot }}
  </x-nav.sidebar>
  @if(session('message'))
    <x-toast :message="session('message')" :type="session('type', 'success')" />
  @endif
</x-layout.base>