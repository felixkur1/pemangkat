<x-layout.guest>
  <div class="relative h-[calc(100vh-12rem)] w-full">
    <img class="absolute inset-0 object-cover w-full h-full brightness-50" src="{{ asset('guest-background.jpg') }}" alt="">

    <div class="absolute flex-col inset-0 flex items-center justify-center gap-4 z-10 text-center">
      <p class="text-white text-4xl font-bold">Struktur Organisasi</p>
      <p class="text-white text-xl font-semibold">Desa Jelutung</p>
    </div>
  </div>

  <main class="w-full flex flex-col items-center justify-center gap-4 mt-4">
    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg text-center">
      <h1 class="text-3xl font-semibold p-4">Susunan Kepengurusan dan Struktur Kerja</h1>
      <img src="{{ asset('storage/images/bagan/struktur-kepengurusan.png') }}" alt="">
    </div>

    <div class="w-full p-4 md:w-4/5 shadow-xl rounded-lg text-center">
      <h1 class="text-3xl font-semibold p-4">Perangkat Desa</h1>
      <div class="flex flex-col gap-4 w-full">
      @foreach ($orgGroups as $group)
        <section class="border-b-2 border-slate-400 pb-6">
          <h2 class="text-2xl font-semibold mb-4">{{ $group->title }}</h2>
          <div class="grid w-full justify-items-center gap-4 grid-cols-[repeat(auto-fit,_minmax(250px,_1fr))]">
          @foreach ($group->structures as $structure)
            <div class="rounded-xl bg-gray-100 flex flex-col justify-center items-center w-3/4 max-w-60">
              <div class="relative w-full pb-[115%] md:pb-[115%]">
                <img class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg" src="{{ asset('storage/'.$structure->employee->image_url) }}" alt=""/>
              </div>
              <div class="-mt-2 h-full p-2 w-full rounded-xl border-gray-200 border-2 bg-white z-10">
                <p class="text-center text-wrap">{{ $structure->employee->full_name }}</p>
                <p class="text-center text-wrap text-sm text-green-600 font-semibold">{{ $structure->position }}</p>
              </div>
            </div>
          @endforeach
          </div>
        </section>
      @endforeach
      </div>
    </div>

{{-- 
    @foreach ($orgGroups as $group)
      <h2 class="text-xl font-semibold">
        {{ $group->title }}
      </h2>
      <div class="grid w-full md:w-3/4 justify-items-center gap-4 grid-cols-[repeat(auto-fit,_minmax(250px,_1fr))]">
        @foreach ($group->structures as $structure)
          <div class="rounded-xl bg-gray-100 flex flex-col justify-center items-center w-3/4 max-w-60">
            <div class="relative w-full pb-[115%] md:pb-[115%]">
              <img class="absolute top-0 left-0 w-full h-full object-cover rounded-t-lg" src="{{ asset('storage/'.$structure->employee->image_url) }}" alt=""/>
            </div>
            <div class="-mt-2 h-full p-2 w-full rounded-xl border-gray-200 border-2 bg-white z-10">
              <p class="text-center text-wrap">{{ $structure->employee->full_name }}</p>
              <p class="text-center text-wrap font-light text-sm text-blue-500">{{ $structure->position }}</p>
            </div>
          </div>
        @endforeach
    </div>
    @endforeach --}}
  </main>
</x-layout.guest>