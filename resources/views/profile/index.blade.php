<x-layout.base>
  <main class="h-screen bg-slate-100 p-4 flex justify-center items-center">
    <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm">
      <a href="{{ url()->previous() }}">
        <svg class="w-6 h-6 text-gray-800 hover:text-blue-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
        </svg>
      </a>
      <h2 class="text-xl font-semibold">Ubah Profil Pengguna {{ $user->username }}</h2>
      <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
        @csrf
        @method('PUT')
        <div class="flex flex-col gap-4 w-full">    
          <div class="flex flex-col gap-4 flex-1">
            <div class="flex flex-col gap-2 flex-1">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="title">Nama Lengkap</label>
              <x-form.input type="text" name="name" id="name" value="{{ $user->name }}"/>
            </div>
          </div>
          <div class="flex flex-col gap-4 flex-1">
            <div class="flex flex-col gap-2 flex-1">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="title">Username</label>
              <x-form.input type="text" name="username" id="username" value="{{ $user->username }}"/>
            </div>
          </div>
          <div class="flex flex-col gap-4 flex-1">
            <div class="flex flex-col gap-2 flex-1">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="title">Email</label>
              <x-form.input type="text" name="email" id="email" value="{{ $user->email }}"/>
            </div>
          </div>
          <div class="flex flex-col gap-4 flex-1">
            <div class="flex flex-col gap-2 flex-1">
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="title">Password Baru</label>
              <x-form.input type="text" name="password" id="password"/>
            </div>
          </div>
        </div>
        <x-form.button type="submit">
          Ubah
        </x-form.button>
      </form>
    </section>
    @if(session('message'))
    <x-toast :message="session('message')" :type="session('type', 'success')" />
  @endif
</x-layout.base>