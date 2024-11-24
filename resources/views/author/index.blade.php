<x-layout.base>
  <main class="p-4">
    <header class="mb-4 p-4 bg-white shadow-md rounded-md">
      <h1 class="font-bold text-2xl">CRUD Artikel</h1>
      <form action="/logout" method="POST">
      @csrf
      <button type="submit">Sign Out</button>
      </form>
    </header>
  </main>
</x-layout.base>