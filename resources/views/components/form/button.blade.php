<button class="inline-flex flex-row gap-2 items-center justify-center px-3 py-2 text-sm font-medium text-center w-fit self-end text-white rounded-lg focus:ring-4 focus:outline-none
{{ isset($use) == 'destroy' ? 'bg-red-700 hover:bg-red-800 focus:ring-red-300' : 'bg-blue-700 hover:bg-blue-800 focus:ring-blue-300' }}" {{ $attributes }}>
  {{ $slot }}
</button>