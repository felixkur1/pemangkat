<x-layout.base title="{{ $title ?? env('APP_NAME') }}">
  <x-nav.navbar />
  {{ $slot }}
  <x-footer />
</x-layout.base>