<x-layout.base>
	<form action="/login" method="post">
		@csrf
		<input type="text" name="username" placeholder="Username...">
		<input type="password" name="password" placeholder="Password...">
		<button type="submit">Login</button>
	</form>
</x-layout.base>
