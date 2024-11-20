<div id="modal" tabindex="-1" class="hidden fixed inset-0 z-[70] items-center justify-center w-full h-screen bg-gray-900 bg-opacity-50 backdrop-blur-sm" role="dialog">
  <div class="relative p-4 w-full max-w-lg max-h-full">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

      <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
        <span class="sr-only">Close modal</span>
      </button>

      <div class="p-4 md:p-5 text-center" id="modal-content">
        {{-- Modal Body --}}
      </div>
    </div>
  </div>
</div>

<div id="modal-delete" class="hidden">
  <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
  </svg>
  <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ $message ?? "Apakah anda yakin?" }}</h3>
  <form action="" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
      Yakin
    </button>
  </form>
</div>

{{ $slot }}

<script>
  function openModal(actionUrl, mode, data = {}) {
    const modalContent = document.getElementById('modal-content');
    if (mode === 'delete') {
      modalContent.innerHTML = document.getElementById('modal-delete').innerHTML;
    } else if (mode === 'edit') {
      modalContent.innerHTML = document.getElementById('modal-edit').innerHTML;
    }

    const form = modalContent.querySelector('form');
    form.action = actionUrl;
    
    // Set setiap input dengan name key masing-masing
    for (const key in data) {
      const input = form.querySelector(`[name="${key}"]`);
      if (input) {
        input.value = data[key];
      }
    }

    // Ubah Image Source
    const imageElement = modalContent.querySelector('#modal-edit-image');
    if (imageElement && data.image_url) {
      imageElement.src = data.image_url;
    }

  }
</script>