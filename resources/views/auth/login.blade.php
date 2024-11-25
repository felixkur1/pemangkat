<x-layout.base>
	<div class="h-screen bg-gray-100">
		<div class="flex flex-col md:flex-row h-full">

			<!-- Section for large screens -->
			<div class="hidden md:block md:w-1/2 lg:w-3/5 bg-cover bg-center" style="background-image: url('https://via.placeholder.com/800x600');">
			</div>

			<!-- Section for medium screens -->
			<div class="absolute inset-0 bg-cover bg-center md:hidden" style="background-image: url('https://via.placeholder.com/800x600');">
				<div class="absolute inset-0 bg-black bg-opacity-50"></div>
			</div>
	
			<!-- Form Section -->
			<div class="flex self-center justify-self-center md:w-1/2 lg:w-2/5 justify-center items-center p-6 bg-white md:bg-gray-100 z-10">
				<div class="max-w-md w-full">
					<h2 class="text-3xl font-bold text-center text-gray-800">Login</h2>
					<form class="mt-6">
						<div class="mb-4">
							<label class="block text-gray-700" for="email">Email</label>
							<input type="email" id="email" class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email">
						</div>
						<div class="mb-6">
							<label class="block text-gray-700" for="password">Password</label>
							<input type="password" id="password" class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password">
						</div>
						<button class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition">Login</button>
					</form>
				</div>
			</div>
	
			
		</div>
	</div>
</x-layout.base>
