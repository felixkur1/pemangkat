@props(['message' => 'Aksi dilakukan.', 'type' => 'success'])
@php
  $typeClasses = [
    'success' => 'text-green-500 bg-green-100',
    'error' => 'text-red-500 bg-red-100',
    'warning' => 'text-yellow-500 bg-yellow-100',
  ];
@endphp

<div id="toast-{{ $type }}" 
     class="fixed bottom-2 right-2 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 opacity-0 transition-all duration-500 ease-out pointer-events-none" 
     style="display: none" 
     role="alert">
  <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 {{ $typeClasses[$type] ?? $typeClasses['success'] }} rounded-lg">
    @if ($type === 'success')  
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
    </svg>
    @elseif ($type === 'error')
    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 0a10 10 0 1 0 10 10A10 10 0 0 0 10 0Zm-1 4h2v6h-2Zm0 8h2v2h-2Z"/>
    </svg>
    @elseif ($type == 'warning')
    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 0a10 10 0 1 0 10 10A10 10 0 0 0 10 0Zm1 14h-2v-2h2Zm0-4h-2V4h2Z"/>
    </svg>
    @endif
    <span class="sr-only">{{ ucfirst($type) }}</span>
  </div>
  <div class="ms-3 text-sm font-normal">{{ $message }}</div>
  <button type="button" 
          class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" 
          aria-label="Close" 
          data-toast-id="toast-{{ $type }}">
    <span class="sr-only">Close</span>
    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
    </svg>
  </button>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toast = document.getElementById("toast-{{ $type }}");
    const closeButton = document.querySelector(`[data-toast-id="toast-{{ $type }}"]`);

    function showToast() {
      toast.style.display = 'flex';
      // Small delay to ensure display: flex is applied before adding opacity
      requestAnimationFrame(() => {
        toast.classList.remove('opacity-0', 'pointer-events-none');
        toast.classList.add('opacity-100', 'pointer-events-auto');
      });
    }

    function hideToast() {
      toast.classList.remove('opacity-100', 'pointer-events-auto');
      toast.classList.add('opacity-0', 'pointer-events-none');
      setTimeout(() => {
        toast.style.display = 'none';
      }, 500); // Matches transition duration
    }

    // Show the toast with fade-in effect
    showToast();

    // Hide toast automatically after a delay
    setTimeout(hideToast, 5000);

    // Event listener for close button
    closeButton.addEventListener('click', hideToast);
  });
</script>