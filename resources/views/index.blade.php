<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monitoring Gudang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-800">
    <x-navbar />
    
    <div class="flex flex-col items-center py-8">
        <h1 class="text-center mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Selamat datang di sistem Monitoring Gudang</h1>
        <p class="text-center mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Pantau dan kelola stok barang dengan mudah, cepat, dan akurat dalam satu platform. Dirancang untuk membantu Anda mencatat setiap pergerakan barang secara real-time, mengurangi risiko kesalahan, dan meningkatkan efisiensi operasional gudang secara menyeluruh.</p>
        @auth
        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
            Pergi ke halaman produk
            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
        </a>
        @else
        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
            Login
            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
        </a>
        @endauth
    </div>
    @auth
    <div class="px-4">
        <p class="text-xl text-gray-900 dark:text-white">Halo, {{ Auth::user()->name }}!</p>
        <canvas id="transactionChart" class="w-full h-20"></canvas>
    </div>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

<script>
  fetch("{{ route('chart.data') }}")
    .then(response => response.json())
    .then(data => {
      const labels = data.map(row => row.date);
      const masuk = data.map(row => row.masuk);
      const keluar = data.map(row => row.keluar);

      const ctx = document.getElementById('transactionChart');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [
            {
              label: 'Barang Masuk',
              data: masuk,
              borderColor: 'rgb(75, 192, 192)',
              backgroundColor: 'rgba(75, 192, 192, 0.2)',
              fill: true,
              tension: 0.3
            },
            {
              label: 'Barang Keluar',
              data: keluar,
              borderColor: 'rgb(255, 99, 132)',
              backgroundColor: 'rgba(255, 99, 132, 0.2)',
              fill: true,
              tension: 0.3
            }
          ]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    });
</script>
</body>
</html>