<x-layout.base>
	<main class="h-screen flex bg-slate-200">
		<div  class="flex-[1.5] hidden md:block">
			<img src="{{ asset('gunung-gajah.jpg') }}" alt="" class="object-cover h-full">
		</div>

		<div class="h-screen flex flex-1 items-center justify-center md:bg-white bg-slate-200">
			<img src="{{ asset('gunung-gajah.jpg') }}" alt="" class="object-cover h-full md:hidden absolute bg-blend-darken">
			<form class="bg-white p-6 rounded-xl z-20 flex flex-col items-center w-72" action="/login" method="post">
				<img src="{{ asset('lambang-kabupaten-sambas.png') }}" alt="" class="w-16 mb-5">
				<div class="text-2xl font-semibold mb-5">
					Desa Jelutung
				</div>
				@csrf
				<div class="relative z-0 w-full mb-5 group">
					<input type="text" name="username" id="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
					<label for="username" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
				</div>
				<div class="relative z-0 w-full mb-5 group">
					<input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
					<label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
				</div>
				<button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
			</form>
		</div>

	</main>
	{{-- <form action="/login" method="post">
		@csrf
		<input type="text" name="username" placeholder="Username...">
		<input type="password" name="password" placeholder="Password...">
		<button type="submit">Login</button>
	</form> --}}

	
	@if(session('message'))
		<x-toast :message="session('message')" :type="session('type', 'success')" />
	@endif
</x-layout.base>
