<x-layout.base>
  <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
          <a href="/" class="flex ms-2 md:me-24">
            <img src="{{ asset('lambang-kabupaten-sambas.jpg') }}" class="h-8 me-3" alt="Logo Sambas" />
            <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Kecamatan Pemangkat</span>
          </a>
        </div>
        <div class="flex items-center">
            <div class="flex items-center ms-3">
              <div>
                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                  <span class="sr-only">Open user menu</span>
                  <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                </button>
              </div>
              <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                <div class="px-4 py-3" role="none">
                  <p class="text-sm text-gray-900 dark:text-white" role="none">
                    {{ request()->user()->name }}
                  </p>
                  <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                    {{ request()->user()->username }}
                  </p>
                </div>
                <ul class="py-1" role="none">
                  <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profil</a>
                  </li>
                  <form action="/logout" method="POST">
                    @csrf
                    <button type='submit' class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign Out</button>
                  </form>
                </ul>
              </div>
            </div>
          </div>
      </div>
    </div>
  </nav>
  <div class="mt-14 p-4 bg-slate-100">
    <header class="mb-4 p-4 bg-white shadow-md rounded-md">
      <h1 class="font-bold text-2xl">Edit Artikel</h1>
    </header>
    <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
      <form action="{{ route('artikel.update.author', $article->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
        @csrf
        @method('PUT')
        <div class="md:w-2/3 aspect-[4/3] overflow-hidden flex self-center">
          <img class="object-cover w-full h-full rounded-t-lg md:rounded-l-lg" src="{{ asset('storage/'.$article->thumbnail) }}" alt=""/>
        </div>
        <div class="flex flex-col md:flex-row gap-4 w-full">
          <div class="flex flex-row gap-4 flex-1">
            <div class="flex flex-col gap-2 flex-1">            
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="thumbnail">Thumbnail Baru</label>
              <input name="thumbnail" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="thumbnail" type="file">
            </div>
            <div class="flex flex-col gap-2">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="type">Jenis Artikel</label>
              <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="berita" {{ $article->type == 'berita' ? 'selected' : '' }}>Berita</option>
                <option value="informasi" {{ $article->type == 'informasi' ? 'selected' : '' }}>Informasi</option>
              </select>
            </div>
          </div>
          <div class="flex flex-col gap-4 flex-1">
            <div class="flex flex-col gap-2 flex-1">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="title">Judul Artikel</label>
              <x-form.input type="text" name="title" id="title" value="{{ $article->title }}"/>
            </div>
          </div>
        </div>
        <label class="block text-sm font-medium text-gray-900 dark:text-white" for="summernote">Konten</label>
        <div class="bootstrap-styled">
          <textarea id="summernote" class="bg-white w-full z-50" name="content">
            {{ $article->content }}
          </textarea>
        </div>
        <script>
          $('#summernote').summernote({
            placeholder: 'Konten Artikel',
            height: 450,
            tabsize: 2,
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
          ]
          });
        </script>
        <x-form.button type="submit">
          Simpan
        </x-form.button>
      </form>
    </section>
  </div>
  @if(session('message'))
    <x-toast :message="session('message')" :type="session('type', 'success')" />
  @endif
</x-layout.base>