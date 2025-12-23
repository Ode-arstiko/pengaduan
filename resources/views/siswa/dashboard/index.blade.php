<div class="max-w-6xl mx-auto space-y-6 lg:px-10">
    <!-- Top Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Tiket -->
        <div class="bg-white rounded-2xl shadow p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-500 text-sm font-medium">Total Aduan</h2>
                <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-md text-xs">📄</span>
            </div>
            <p class="text-2xl font-semibold mt-2">{{ $total_aduan }}</p>
        </div>

        <!-- Tiket Aktif -->
        <div class="bg-white rounded-2xl shadow p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-500 text-sm font-medium">Aduan Aktif</h2>
                <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded-md text-xs">⏱</span>
            </div>
            <p class="text-2xl font-semibold mt-2">{{ $aduan_aktif }}</p>
        </div>

        <!-- Selesai -->
        <div class="bg-white rounded-2xl shadow p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-500 text-sm font-medium">Selesai</h2>
                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-md text-xs">✔</span>
            </div>
            <p class="text-2xl font-semibold mt-2">{{ $aduan_selesai }}</p>
        </div>

        <!-- Rata-rata Waktu -->
        <div class="bg-white rounded-2xl shadow p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-500 text-sm font-medium">Ditolak</h2>
                <span class="bg-red-100 text-red-600 px-2 py-1 rounded-md text-xs">❌</span>
            </div>
            <p class="text-2xl font-semibold mt-2">{{ $aduan_ditolak }}</p>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 ">

        <!-- Tiket Terbaru -->
        <div class="bg-white rounded-2xl shadow-md p-6 col-span-2">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">Aduan Terbaru</h2>
                <a href="riwayat.html"
                    class="text-sm text-blue-600 hover:underline hover:text-blue-800 transition">Lihat Semua</a>
            </div>

            <div class="space-y-5">
                <!-- Tiket 1 -->
                @foreach ($aduan_terbaru as $aduan)
                    <div
                        class="flex items-start gap-4 border border-gray-200 rounded-xl p-4
                       hover:shadow-lg transition-all duration-200 bg-gray-50
                       min-h-[120px]">

                        <a href="/riwayat-laporan/detail/{{ encrypt($aduan->id) }}" class="flex-1">
                            <div class="flex flex-col h-full">

                                <!-- Header -->
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold text-gray-900">
                                            {{ $aduan->title }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            dibuat pada, {{ substr($aduan->created_at, 0, 10) }}
                                        </p>
                                    </div>

                                    <span
                                        class="text-xs font-semibold bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                                        {{ $aduan->status }}
                                    </span>
                                </div>

                                <!-- Deskripsi -->
                                <p class="text-sm text-gray-700 mt-3 line-clamp-2 min-h-[2.5rem]">
                                    {{ $aduan->description }}
                                </p>

                                <!-- Footer -->
                                <p class="text-xs text-gray-400 mt-2">
                                    {{ Auth::user()->nama }}
                                </p>

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Distribusi Status -->
        <div class="bg-white rounded-2xl shadow p-4">
            <canvas id="myChart" class="w-full max-w-xl h-96 mx-auto"></canvas>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

        <script>
            const xValues = ["Pending", "Proses", "Selesai", "Ditolak"];
            const yValues = [20, 30, 40, 10];
            const barColors = ["#eab308", "#22c55e", "#2563eb", "#ef4444"];

            new Chart("myChart", {
                type: "pie",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: "Distribusi Status Pengaduan"
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>

    </div>
</div>
