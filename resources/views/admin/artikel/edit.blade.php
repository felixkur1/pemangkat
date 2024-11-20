<x-layout.admin>
  <header class="mb-4 p-4 bg-white shadow-md rounded-md">
    <h1 class="font-bold text-2xl">Edit Artikel</h1>
  </header>
  <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    <form action="{{ route('artikel.update.admin', $article->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
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
</x-layout.admin>