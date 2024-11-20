<x-layout.admin>
  <header class="mb-4 p-4 bg-white shadow-md rounded-md">
    <h1 class="font-bold text-2xl">Struktur Organisasi</h1>
  </header>
  <main class="flex flex-col gap-4 pb-20">
  @if ($orgGroups->isEmpty())
    <section class="flex flex-row p-4 gap-2 bg-white rounded-lg shadow-sm">
      <div class="block p-2.5 w-full text-sm text-gray-500 bg-gray-50 text-center">Belum ada kelompok...</div>
    </section>
  @else
  @foreach ($orgGroups as $group)
    <section class="flex flex-col p-4 gap-4 bg-white rounded-lg shadow-sm">
      <form action="{{ route('struktur-organisasi.group.update.admin', $group->id) }}" method="POST" class="flex-1 flex flex-row items-center justify-center gap-4">
        @csrf
        @method('PUT')
        <x-form.input type="text" name="title" id="title" placeholder="Nama kelompok..." value="{{ $group->title }}"/>
        <x-form.button type="submit">
          Edit
        </x-form.button>
        <x-form.button type="button" use="destroy" onclick="openModal('{{ route('struktur-organisasi.group.destroy.admin', $group->id) }}', 'delete')" data-modal-target="modal" data-modal-toggle="modal">
          Hapus
        </x-form.button>
      </form>
      <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
      @foreach ($group->structures as $structure)
        <div class="flex w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <div class="w-1/3 aspect-[3/4] overflow-hidden">
            <img class="object-cover w-full h-full rounded-l-lg" src="{{ asset('storage/'.$structure->employee->image_url) }}" alt=""/>
          </div>
          <div class="w-2/3 p-5 flex flex-col justify-between">
            <div>
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $structure->employee->full_name }}</h5>
              <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
                {{ $structure->position }}
                {{-- Terakhir diperbarui pada
                <div class="text-blue-500">
                  {{ \Carbon\Carbon::parse($structure->updated_at)->translatedFormat('l, d F Y | H:i:s') }}
                </div> --}}
              </p>
            </div>
            <div class="flex flex-row gap-2 justify-end">
              <x-form.button onclick="openModal('{{ route('struktur-organisasi.update.admin', $structure->id) }}', 'edit', {employee_id: '{{ $structure->employee->id }}', image_url: '{{ asset('storage/'.$structure->employee->image_url) }}', position: '{{ $structure->position }}'})" data-modal-target="modal" data-modal-toggle="modal">
                Edit
              </x-form.button>
              <x-form.button use="destroy" onclick="openModal('{{ route('struktur-organisasi.destroy.admin', $structure->id) }}', 'delete')" data-modal-target="modal" data-modal-toggle="modal">
                Hapus
              </x-form.button>
            </div>
          </div>
        </div>
      @endforeach
      </div>
      @if ($group->structures->isEmpty())
        <div class="block p-2.5 w-full text-sm text-gray-500 bg-gray-50 text-center">Belum ada pegawai...</div>
      @else
      @endif
      <form action="{{ route('struktur-organisasi.store.admin') }}" method="POST" class="flex flex-col gap-4">
        <h2 class="text-lg font-semibold">Tambahkan Pegawai</h2>
        @csrf
        @method('POST')
        <input type="hidden" name="group_id" value="{{ $group->id }}">
        <x-form.searchable-select :employees="$employees" name="employee_id" id="{{ $group->id }}"/>
        <x-form.input type="text" name="position" id="position" placeholder="Jabatan"/>
        <x-form.button type="submit">
          Tambahkan
        </x-form.button>
      </form>
      
    </section>
  @endforeach
  @endif
    <section class="flex flex-row p-4 gap-2 bg-white rounded-lg shadow-sm">
      <form action="{{ route('struktur-organisasi.group.store.admin') }}" method="POST" class="flex-1 flex flex-row items-center justify-center gap-4">
        @csrf
        <x-form.input type="text" name="group" id="group" placeholder="Nama kelompok baru..."/>
        <x-form.button type="submit">
          Tambah
        </x-form.button>
      </form>
    </section>
  </main>

  <x-modal>
    {{-- Edit Form --}}
    <div id="modal-edit" class="hidden">
      <h2 class="text-xl font-semibold mb-4">Edit Struktur Organisasi</h2>
      <div class="flex flex-row gap-4">
        <div class="w-1/2 aspect-[3/4] overflow-hidden">
          <img id="modal-edit-image" class="object-cover w-full h-full rounded-lg" alt=""/>
        </div>
        <div class="w-full flex flex-col items-start">
          <form action="" method="POST" class="flex flex-col items-start w-full gap-4">
            @csrf
            @method('PUT')
            <input type="hidden" name="group_id" value="">
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="employee_id">Pilih Pegawai</label>
            <select name="employee_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              @foreach ($employees as $employee)  
                <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
              @endforeach
            </select>
            <x-form.input type="text" name="position" id="position" placeholder="Jabatan"/>
            <x-form.button type="submit">
              Perbarui
            </x-form.button>
          </form>
        </div>
      </div>
    </div>
  </x-modal>

  <script>
    function filterEmployees(event) {
        const filter = event.target.value.toLowerCase();
        const options = document.querySelectorAll('#employee-list li');

        options.forEach(option => {
            const text = option.textContent.toLowerCase();
            option.style.display = text.includes(filter) ? '' : 'none';
        });
    }

    function toggleDropdown() {
        const dropdown = document.getElementById('employee-list');
        dropdown.classList.toggle('hidden');
    }

    function selectEmployee(id, name) {
        document.getElementById('selected-employee-id').value = id;
        document.getElementById('employee-search').value = name;

        // Sembunyikan dropdown setelah memilih opsi
        document.getElementById('employee-list').classList.add('hidden');
    }

    // Klik di luar dropdown untuk menutupnya
    document.addEventListener('click', function(e) {
        const searchBox = document.getElementById('employee-search');
        const dropdown = document.getElementById('employee-list');
        if (!searchBox.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
  </script>
</x-layout.admin>