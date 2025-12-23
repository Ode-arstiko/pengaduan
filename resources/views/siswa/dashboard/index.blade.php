<div class="max-w-6xl mx-auto space-y-6 lg:px-10">
    <!-- Top Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Tiket -->
        <div class="bg-white rounded-2xl shadow p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-500 text-sm font-medium">Total Aduan</h2>
                <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-md text-xs">📄</span>
            </div>
            <p class="text-2xl font-semibold mt-2">2</p>
            <p class="text-green-500 text-xs mt-1">⬆ 12% vs bulan lalu</p>
        </div>

        <!-- Tiket Aktif -->
        <div class="bg-white rounded-2xl shadow p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-500 text-sm font-medium">Aduan Aktif</h2>
                <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded-md text-xs">⏱</span>
            </div>
            <p class="text-2xl font-semibold mt-2">1</p>
            <p class="text-red-500 text-xs mt-1">⬇ 3% vs bulan lalu</p>
        </div>

        <!-- Selesai -->
        <div class="bg-white rounded-2xl shadow p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-500 text-sm font-medium">Selesai</h2>
                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-md text-xs">✔</span>
            </div>
            <p class="text-2xl font-semibold mt-2">1</p>
            <p class="text-green-500 text-xs mt-1">⬆ 8% vs bulan lalu</p>
        </div>

        <!-- Rata-rata Waktu -->
        <div class="bg-white rounded-2xl shadow p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-500 text-sm font-medium">Rata-rata Waktu</h2>
                <span class="bg-purple-100 text-purple-600 px-2 py-1 rounded-md text-xs">⏳</span>
            </div>
            <p class="text-2xl font-semibold mt-2">1 Jam</p>
            <p class="text-green-500 text-xs mt-1">⬇ 15% vs bulan lalu</p>
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
                <div
                    class="flex items-start gap-4 border border-gray-200 rounded-xl p-4 hover:shadow-lg transition-all duration-200 bg-gray-50">
                    <!-- Gambar -->
                    <a href="detail-riwayat-selesai.html">


                        <!-- Konten -->
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold text-gray-900">Toilet Belakang Gedung B</p>
                                    <p class="text-xs text-gray-500 mt-1">Rabu, 16 Juli 2025</p>
                                </div>
                                <span
                                    class="text-xs font-semibold bg-blue-100 text-blue-700 px-2 py-1 rounded-full">selesai</span>
                            </div>

                            <p class="text-sm text-gray-700 mt-3 line-clamp-2">
                                Toilet bagian belakang rusak dan air tidak mengalir, sudah diperbaiki sekarang.
                                Terima kasih.
                            </p>

                            <p class="text-xs text-gray-400 mt-2">Siti Aminah</p>
                        </div>
                </div>
                </a>

                <!-- Tiket 2 -->
                <div
                    class="flex items-start gap-4 border border-gray-200 rounded-xl p-4 hover:shadow-lg transition-all duration-200 bg-gray-50">
                    <!-- Gambar -->
                    <a href="detail-riwayat-ditolak.html">


                        <!-- Konten -->
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold text-gray-900">Kantin Sekolah</p>
                                    <p class="text-xs text-gray-500 mt-1">Sabtu, 19 Juli 2025</p>
                                </div>
                                <span
                                    class="text-xs font-semibold bg-red-100 text-red-600 px-2 py-1 rounded-full">Ditolak</span>
                            </div>

                            <p class="text-sm text-gray-700 mt-3 line-clamp-2">
                                Banyak sampah menumpuk di sekitar kantin dan belum dibersihkan sejak pagi. Harap
                                ditindak.
                            </p>

                            <p class="text-xs text-gray-400 mt-2">Nur Hasanah</p>
                        </div>
                    </a>
                </div>
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