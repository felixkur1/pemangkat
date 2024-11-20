<x-layout.admin>
  <header class="mb-4 p-4 bg-white shadow-md rounded-md">
    <h1 class="font-bold text-2xl">Edit Beranda</h1>
  </header>
  <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm mb-4">
    <h2 class="text-xl font-semibold">Edit Teks Beranda</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
      @csrf
      @method('PUT')
      <label class="block text-sm font-medium text-gray-900 dark:text-white" for="summernote-1">Kata Sambutan</label>
      <div class="bootstrap-styled">
        <textarea id="summernote-1" class="bg-white w-full z-50" name="sambutan">
          {{ $greetings->content ?? "" }}
        </textarea>
      </div>
      <label class="block text-sm font-medium text-gray-900 dark:text-white" for="summernote-1">Sekapur Sirih</label>
      <div class="bootstrap-styled">
        <textarea id="summernote-2" class="bg-white w-full z-50" name="sekapur-sirih">
          {{ $messages->content ?? "" }}
        </textarea>
      </div>
      <script>
        $('#summernote-1').summernote({
          placeholder: 'Kata Sambutan',
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
          ['view', ['codeview', 'help']]
        ]
        });
        $('#summernote-2').summernote({
          placeholder: 'Sekapur Sirih',
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
          ['view', ['codeview', 'help']]
        ]
        });
      </script>

      <x-form.button type="submit">
        Simpan
      </x-form.button>
    </form>    
  </section>
</x-layout.admin>