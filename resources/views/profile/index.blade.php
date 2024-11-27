<x-layout.base>
    <section class="flex flex-col p-4 gap-2 bg-white rounded-lg shadow-sm">
      <h2 class="text-xl font-semibold">ini profile {{ $user->role }}</h2>
      <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
        @csrf
        @method('PUT')
        <div class="flex flex-col md:flex-row gap-4 w-full">    
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
              <label class="block text-sm font-medium text-gray-900 dark:text-white" for="title">Password</label>
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