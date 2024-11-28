@php
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
<nav class="w-full flex flex-col gap-4 items-center justify-center">
  <h1 class="text-3xl font-semibold w-full text-center">Portal Website Desa</h1>
  <ul class="grid place-items-center place-content-center w-full md:w-3/4 justify-items-center gap-4 grid-cols-[repeat(auto-fit,_minmax(180px,_1fr))]">
  @foreach ($webDesa as $d)
    <li class="bg-slate-600 hover:bg-slate-700 p-4 pt-2 rounded-xl">
      <a class=" text-white" href="{{ $d['url'] . '.' . route('beranda.index.guest') }}">{{ $d['name'] }}</a>
    </li>
  @endforeach
  </ul>
</nav>