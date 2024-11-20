<x-layout.guest>
  <main class="flex flex-col gap-4 items-center">
    <h1 class="text-3xl font-bold m-4">
      Struktur Organisasi
    </h1>
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
    @endforeach
  </main>
</x-layout.guest>