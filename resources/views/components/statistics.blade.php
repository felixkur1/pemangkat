<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<main class="mt-4 flex flex-col gap-8">
	<section class="border-b-2 border-gray-200 p-4">
		<h2 class="text-3xl font-semibold text-center mb-4">Demografi Penduduk</h2>
		<div class="bg-amber-500 font-semibold text-white w-full p-4 rounded-lg shadow-md mb-4">
			Terakhir diperbarui {{ \Carbon\Carbon::parse($demografi_update)->translatedFormat('j F Y H:i') }}
		</div>
		<div class="grid md:grid-cols-2 grid-cols-1 gap-4 place-content-center place-items-center text-white">
			<div class="bg-emerald-700 w-full max-w-lg p-4 rounded-lg shadow-md inset-2">
				<h3 class="uppercase text-center font-semibold text-2xl">
					Total Jiwa
				</h3>
				<p class="text-center font-bold text-7xl">
					{{ number_format($total_jiwa, 0, ',', '.') }}
				</p>
			</div>

			<div class="bg-sky-700 w-full p-4 max-w-lg rounded-lg shadow-md inset-2">
				<h3 class="uppercase text-center font-semibold text-2xl">
					Kepala Keluarga
				</h3>
				<p class="text-center font-bold text-7xl">
					{{ number_format($kepala_keluarga, 0, ',', '.') }}
				</p>
			</div>

			<div class="bg-blue-500 w-full p-4 max-w-lg rounded-lg shadow-md inset-2">
				<h3 class="uppercase text-center font-semibold text-2xl">
					Laki-Laki
				</h3>
				<p class="text-center font-bold text-7xl">
					{{ number_format($laki_laki, 0, ',', '.') }}
				</p>
			</div>

			<div class="bg-red-500 w-full p-4 max-w-lg rounded-lg shadow-md inset-2">
				<h3 class="uppercase text-center font-semibold text-2xl">
					Perempuan
				</h3>
				<p class="text-center font-bold text-7xl">
					{{ number_format($perempuan, 0, ',', '.') }}
				</p>
			</div>

		</div>
	</section>

	<section class="p-4">
		<h2 class="text-3xl font-semibold text-center mb-4">Grafik</h2>
		<div class="grid md:grid-cols-2 grid-cols-1 gap-4 place-content-center place-items-center p-4">
			{{-- Pendidikan --}}
			<div class="w-full p-4">
				<h3 class="text-center text-2xl font-semibold mb-4">
					Jenjang Pendidikan Formal
				</h3>
				<div class="bg-amber-500 font-semibold text-white w-full p-4 rounded-lg shadow-md mb-4">
					Terakhir diperbarui {{ \Carbon\Carbon::parse($education_update)->translatedFormat('j F Y H:i') }}
				</div>
				<canvas id="educationChart"></canvas>
				<script>
					const educationData = @json($education_data);
			
					const labels = educationData.map(item => item.label);
					const data = educationData.map(item => item.jumlah);
			
					const ctx = document.getElementById('educationChart').getContext('2d');
					const educationChart = new Chart(ctx, {
							type: 'doughnut', // Bisa diubah ke 'line', 'pie', 'doughnut', dll.
							data: {
									labels: labels,
									datasets: [{
											label: 'Jumlah Orang',
											data: data,
											backgroundColor: [
													'rgba(75, 192, 192, 0.2)',
													'rgba(153, 102, 255, 0.2)',
													'rgba(255, 159, 64, 0.2)',
													'rgba(255, 99, 132, 0.2)',
													'rgba(54, 162, 235, 0.2)',
													'rgba(255, 206, 86, 0.2)',
													'rgba(75, 192, 192, 0.2)',
													'rgba(153, 102, 255, 0.2)',
													'rgba(255, 159, 64, 0.2)',
													'rgba(54, 162, 235, 0.2)',
													'rgba(255, 206, 86, 0.2)',
													'rgba(75, 192, 192, 0.2)',
											],
											borderColor: [
													'rgba(75, 192, 192, 1)',
													'rgba(153, 102, 255, 1)',
													'rgba(255, 159, 64, 1)',
													'rgba(255, 99, 132, 1)',
													'rgba(54, 162, 235, 1)',
													'rgba(255, 206, 86, 1)',
													'rgba(75, 192, 192, 1)',
													'rgba(153, 102, 255, 1)',
													'rgba(255, 159, 64, 1)',
													'rgba(54, 162, 235, 1)',
													'rgba(255, 206, 86, 1)',
													'rgba(75, 192, 192, 1)',
											],
											borderWidth: 1
									}]
							},
							options: {
									responsive: true,
							}
					});
				</script>
			</div>

			{{-- Mata Pencaharian --}}
			<div class="w-full p-4">
				<h3 class="text-center text-2xl font-semibold mb-4">
					Mata Pencaharian
				</h3>
				<div class="bg-amber-500 font-semibold text-white w-full p-4 rounded-lg shadow-md mb-4">
					Terakhir diperbarui {{ \Carbon\Carbon::parse($business_update)->translatedFormat('j F Y H:i') }}
				</div>
				<canvas id="businessChart"></canvas>
				<script>
					// Data Kelompok Usaha
					const businessData = @json($business_data);
					const businessLabels = businessData.map(item => item.label);
					const businessValues = businessData.map(item => item.jumlah);
			
					const businessCtx = document.getElementById('businessChart').getContext('2d');
					const businessChart = new Chart(businessCtx, {
							type: 'doughnut', // Tipe bisa 'pie', 'doughnut', atau lainnya
							data: {
									labels: businessLabels,
									datasets: [{
											label: 'Jumlah Orang',
											data: businessValues,
											backgroundColor: [
													'rgba(255, 99, 132, 0.2)',
													'rgba(54, 162, 235, 0.2)',
													'rgba(255, 206, 86, 0.2)',
													'rgba(75, 192, 192, 0.2)',
													'rgba(153, 102, 255, 0.2)',
													'rgba(255, 159, 64, 0.2)',
													'rgba(99, 132, 255, 0.2)',
													'rgba(255, 99, 132, 0.2)',
													'rgba(54, 162, 235, 0.2)',
													'rgba(255, 206, 86, 0.2)',
													'rgba(75, 192, 192, 0.2)',
											],
											borderColor: [
													'rgba(255, 99, 132, 1)',
													'rgba(54, 162, 235, 1)',
													'rgba(255, 206, 86, 1)',
													'rgba(75, 192, 192, 1)',
													'rgba(153, 102, 255, 1)',
													'rgba(255, 159, 64, 1)',
													'rgba(99, 132, 255, 1)',
													'rgba(255, 99, 132, 1)',
													'rgba(54, 162, 235, 1)',
													'rgba(255, 206, 86, 1)',
													'rgba(75, 192, 192, 1)',
											],
											borderWidth: 1
									}]
							},
							options: {
									responsive: true,
							}
					});
				</script>
			</div>

			{{-- Agama --}}
			<div class="w-full p-4">
				<h3 class="text-center text-2xl font-semibold mb-4">
					Agama
				</h3>
				<div class="bg-amber-500 font-semibold text-white w-full p-4 rounded-lg shadow-md mb-4">
					Terakhir diperbarui {{ \Carbon\Carbon::parse($religion_update)->translatedFormat('j F Y H:i') }}
				</div>
				<canvas id="religionChart"></canvas>
				<script>
					// Data Agama
					const religionData = @json($religion_data);
					const religionLabels = religionData.map(item => item.label);
					const religionValues = religionData.map(item => item.jumlah);
			
					const religionCtx = document.getElementById('religionChart').getContext('2d');
					const religionChart = new Chart(religionCtx, {
							type: 'doughnut', // Tipe grafik 'doughnut' untuk representasi proporsi
							data: {
									labels: religionLabels,
									datasets: [{
											label: 'Jumlah Orang',
											data: religionValues,
											backgroundColor: [
													'rgba(75, 192, 192, 0.2)',
													'rgba(255, 159, 64, 0.2)',
													'rgba(255, 206, 86, 0.2)',
													'rgba(54, 162, 235, 0.2)',
													'rgba(153, 102, 255, 0.2)',
													'rgba(255, 99, 132, 0.2)',
											],
											borderColor: [
													'rgba(75, 192, 192, 1)',
													'rgba(255, 159, 64, 1)',
													'rgba(255, 206, 86, 1)',
													'rgba(54, 162, 235, 1)',
													'rgba(153, 102, 255, 1)',
													'rgba(255, 99, 132, 1)',
											],
											borderWidth: 1
									}]
							},
							options: {
									responsive: true,
							}
					});
			</script>
			</div>

			{{-- Suku --}}
			<div class="w-full p-4">
				<h3 class="text-center text-2xl font-semibold mb-4">
					Suku
				</h3>
				<div class="bg-amber-500 font-semibold text-white w-full p-4 rounded-lg shadow-md mb-4">
					Terakhir diperbarui {{ \Carbon\Carbon::parse($race_update)->translatedFormat('j F Y H:i') }}
				</div>
				<canvas id="raceChart"></canvas>
				<script>
					// Data Agama
					const raceData = @json($race_data);
					const raceLabels = raceData.map(item => item.label);
					const raceValues = raceData.map(item => item.jumlah);
			
					const raceCtx = document.getElementById('raceChart').getContext('2d');
					const raceChart = new Chart(raceCtx, {
							type: 'doughnut', // Tipe grafik 'doughnut' untuk representasi proporsi
							data: {
									labels: raceLabels,
									datasets: [{
											label: 'Jumlah Orang',
											data: raceValues,
											backgroundColor: [
													'rgba(75, 192, 192, 0.2)',
													'rgba(255, 159, 64, 0.2)',
													'rgba(255, 206, 86, 0.2)',
													'rgba(54, 162, 235, 0.2)',
													'rgba(153, 102, 255, 0.2)',
													'rgba(255, 99, 132, 0.2)',
											],
											borderColor: [
													'rgba(75, 192, 192, 1)',
													'rgba(255, 159, 64, 1)',
													'rgba(255, 206, 86, 1)',
													'rgba(54, 162, 235, 1)',
													'rgba(153, 102, 255, 1)',
													'rgba(255, 99, 132, 1)',
											],
											borderWidth: 1
									}]
							},
							options: {
									responsive: true,
							}
					});
			</script>
			</div>

		</div>
	</section>
</main>