<x-layout.base title="{{ $title ?? env('APP_NAME') }}">
  <x-nav.navbar />
  {{ $slot }}
  <x-footer />
  <!-- Floating Action Button -->
  <a href="https://pemangkat-chatbot.streamlit.app/" target="_blank" class="fixed bottom-6 right-6 bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-lg p-4 z-30">
    <svg fill="#ffffff" class="h-6 hover:text-gray-300" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60 60" xml:space="preserve">
      <path d="M30,1.5c-16.542,0-30,12.112-30,27c0,5.205,1.647,10.246,4.768,14.604c-0.591,6.537-2.175,11.39-4.475,13.689  c-0.304,0.304-0.38,0.769-0.188,1.153C0.276,58.289,0.625,58.5,1,58.5c0.046,0,0.093-0.003,0.14-0.01  c0.405-0.057,9.813-1.412,16.617-5.338C21.622,54.711,25.738,55.5,30,55.5c16.542,0,30-12.112,30-27S46.542,1.5,30,1.5z"/>
    </svg>
  </a>
</x-layout.base>