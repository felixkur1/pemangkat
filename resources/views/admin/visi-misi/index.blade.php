<x-layout.admin>
  <header class="mb-4 p-4 bg-white shadow-md rounded-md">
    <h1 class="font-bold text-2xl">Visi dan Misi</h1>
  </header>
  <main class="flex flex-col gap-4">
    {{-- Bagian Edit Visi --}}
    <section class="p-4 rounded-md shadow-md bg-white">
      <form action="{{ route('visi-misi.update.visi.admin') }}" method="POST" class="flex flex-col gap-4">
        @csrf
        @method('PUT')
        <label for="vision" class="text-xl font-semibold">Visi</label>
        <x-form.textarea name="vision" id="vision" rows="4" placeholder="Visi...">
          {{ isset($vision->value) ? $vision->value : null }}
        </x-form.textarea>
        <x-form.button type="submit">
          Simpan
        </x-form.button>
      </form>
    </section>

    {{-- Bagian CRUD Misi --}}
    <section class="p-4 rounded-md shadow-md bg-white mb-4">
      @if ($missions->isEmpty())
        <div class="block p-2.5 w-full mb-4 text-sm text-gray-500 bg-gray-50 text-center">Belum ada misi...</div>
      @else
      <form action="{{ route('visi-misi.update.misi.admin') }}" method="POST" class="flex flex-col gap-4 mb-4">
        @csrf
        @method('PUT')
        <div class="flex flex-row justify-between items-center">
          <h2 class="text-xl font-semibold">Misi-Misi Organisasi</h2>
          <x-form.button type="submit">
            Simpan
          </x-form.button>
        </div>
        @foreach ($missions as $mission)
        <div class="flex flex-row gap-4">
          <x-form.textarea name="missions[{{ $mission->id }}][value]" rows="2" placeholder="Misi...">
            {{ $mission->value }}
          </x-form.textarea>
          <x-form.button onclick="openModal('{{ route('visi-misi.destroy.admin', $mission->id) }}', 'delete')" use="destroy" type="button" data-modal-target="modal" data-modal-toggle="modal">
            <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
            </svg>
          </x-form.button>
        </div>
        @endforeach
      </form>
      @endif
      <form action="{{ route('visi-misi.store.admin') }}" method="POST" class="flex flex-col gap-4">
        @csrf
        @method('POST')
        <x-form.textarea name="mission" rows="2" placeholder="Misi baru..."></x-form.textarea>
        <x-form.button type="submit">
          Tambahkan
        </x-form.button>
      </form>
    </section>
  </main>
  <x-modal/>
</x-layout.admin>