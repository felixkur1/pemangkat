@php
  $desa = [
    [
      'name' => 'Gugah Sejahtera',
      'url' => '#',
    ],
    [
      'name' => 'Harapan',
      'url' => '#',
    ],
    [
      'name' => 'Jelutung',
      'url' => '#',
    ],
    [
      'name' => 'Lonam',
      'url' => '#',
    ],
    [
      'name' => 'Pemangkat Kota',
      'url' => '#',
    ],
    [
      'name' => 'Penjajap',
      'url' => '#',
    ],
    [
      'name' => 'Perapakan',
      'url' => '#',
    ],
    [
      'name' => 'Sebatuan',
      'url' => '#',
    ],
  ];
@endphp

<nav class="w-full flex flex-col gap-4 items-center justify-center">
  <h1 class="text-3xl font-semibold w-full text-center">Portal Website Desa</h1>
  <ul class="grid place-items-center place-content-center w-full md:w-3/4 justify-items-center gap-4 grid-cols-[repeat(auto-fit,_minmax(180px,_1fr))]">
  @foreach ($desa as $d)
    <a  class="p-4 bg-slate-600 text-white rounded-xl hover:bg-slate-700" href="{{ $d['url'] }}">{{ $d['name'] }}</a>
  @endforeach
    </ul>
</nav>