<div class="max-w-6xl mx-auto space-y-6 lg:px-10">
    <!-- Top Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Tiket -->
        <div class="bg-white border border-blue-200 rounded-2xl shadow p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-500 text-sm font-medium">Total Aduan</h2>
                <i class="fas fa-file bg-blue-100 text-blue-600 px-2 py-1 rounded-md text-xs"></i>
            </div>
            <p class="text-2xl font-semibold mt-2">{{ $total_aduan }}</p>
        </div>

        <!-- Tiket Aktif -->
        <div class="bg-white border border-yellow-200 rounded-2xl shadow p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-500 text-sm font-medium">Aduan Aktif</h2>
                <i class="fas fa-clock bg-yellow-100 text-yellow-600 px-2 py-1 rounded-md text-xs"></i>
            </div>
            <p class="text-2xl font-semibold mt-2">{{ $aduan_aktif }}</p>
        </div>

        <!-- Selesai -->
        <div class="bg-white border border-green-300 rounded-2xl shadow p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-500 text-sm font-medium">Selesai</h2>
                <i class="fas fa-check bg-green-100 text-green-600 px-2 py-1 rounded-md text-xs"></i>
            </div>
            <p class="text-2xl font-semibold mt-2">{{ $aduan_selesai }}</p>
        </div>

        <!-- Rata-rata Waktu -->
        <div class="bg-white border border-red-300 rounded-2xl shadow p-4">
            <div class="flex items-center justify-between">
                <h2 class="text-gray-500 text-sm font-medium">Ditolak</h2>
                <span class="bg-red-100 text-red-600 px-2 py-1 rounded-md text-xs">❌</span>
            </div>
            <p class="text-2xl font-semibold mt-2">{{ $aduan_ditolak }}</p>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 gap-4 ">

        <!-- Tiket Terbaru -->
        <div class="bg-white rounded-2xl shadow-md p-6 col-span-2">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">Aduan Terbaru</h2>
            </div>

            <div class="space-y-5">
                <!-- Tiket 1 -->
                @foreach ($aduan_terbaru as $aduan)
                    <div
                        class="flex items-start gap-4 border border-gray-200 rounded-xl p-4
                       hover:shadow-lg transition-all duration-200 bg-gray-50
                       min-h-[120px]">

                        <a href="/guru/riwayat/detail/{{ encrypt($aduan->id) }}" class="flex-1">
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
                                        class="text-xs font-semibold {{ $aduan->status == 'baru' ? 'bg-blue-100 text-blue-700' : ($aduan->status == 'proses' ? 'bg-yellow-100 text-yellow-700' : ($aduan->status == 'selesai' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700')) }} px-2 py-1 rounded-full">
                                        {{ $aduan->status }}
                                    </span>
                                </div>

                                <!-- Deskripsi -->
                                <p class="text-sm text-gray-700 mt-3 line-clamp-2 min-h-[2.5rem]">
                                    {{ substr($aduan->description, 0, 30) }}...
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
    </div>
</div>
