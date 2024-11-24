<x-layout.admin>
  Admin User Management

  <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm">
    <form action="{{ route('author-setting.store.admin') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
      @csrf
      <h2 class="text-xl font-semibold">Tambah Artikel</h2>
      <div class="flex flex-col md:flex-row gap-4 w-full">
        <div class="flex flex-row gap-4 flex-1">
          <div class="flex flex-col gap-2 flex-1">            
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="thumbnail">Thumbnail Artikel</label>
            <input name="thumbnail" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="thumbnail" type="file">
          </div>
          <div class="flex flex-col gap-2">
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="type">Jenis Artikel</label>
            <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option value="berita">Berita</option>
              <option value="informasi">Informasi</option>
            </select>
          </div>
        </div>
        <div class="flex flex-col gap-4 flex-1">
          <div class="flex flex-col gap-2 flex-1">
            <label class="block text-sm font-medium text-gray-900 dark:text-white" for="title">Judul Artikel</label>
            <x-form.input type="text" name="title" id="title"/>
          </div>
        </div>
      </div>
      <x-form.button type="submit">
        Tambah
      </x-form.button>
    </form>
  </section>

</x-layout.admin>