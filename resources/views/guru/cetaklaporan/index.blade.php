<div class="w-full bg-white p-6 rounded-xl shadow-md border border-gray-200">

    <!-- Judul -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
        <p class="text-sm text-gray-500">Pilih bulan dan tahun laporan</p>
    </div>

    <!-- FILTER BULAN & TAHUN -->
    <form method="GET" class="flex flex-wrap gap-4 mb-6">
        <div>
            <label class="text-sm text-gray-600">Bulan : </label>
            <select name="bulan"
                class="border rounded-lg px-3 py-2 w-full sm:w-48 bg-white text-gray-700 focus:outline-blue-500">
                <option value="">Semua</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                    </option>
                @endfor
            </select>
        </div>

        <div>
            <label class="text-sm text-gray-600">Tahun : </label>
            <select name="tahun"
                class="border rounded-lg px-3 py-2 w-full sm:w-48 bg-white text-gray-700 focus:outline-blue-500">
                <option value="">Semua</option>
                @for ($y = now()->year; $y >= 2025; $y--)
                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>
        </div>



        <div class="flex items-end gap-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Tampilkan
            </button>

            <a href="{{ route('guru.cetaklaporan.pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                Cetak PDF
            </a>
        </div>
    </form>

    <!-- TABEL LAPORAN -->
    <div class="overflow-x-auto overflow-y-auto h-[350px] w-[310px] sm:w-full">
        <div class="space-x-2 mb-4 px-2">
            <table class="w-[700px] sm:w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-2 sticky top-0 bg-white border-gray-200 text-sm text-gray-500">
                        <th class="px-4 py-3">NO</th>
                        <th class="px-4 py-3">JUDUL</th>
                        <th class="px-4 py-3">DESKRIPSI</th>
                        <th class="px-4 py-3">STATUS</th>
                        <th class="px-4 py-3">TANGGAL</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($reports as $report)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 font-medium">{{ $report->title }}</td>
                            <td class="px-4 py-2">{{ substr($report->description, 0, 30) }}...</td>
                            <td class="px-4 py-2">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $report->status == 'selesai' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                {{ $report->created_at->format('d-m-Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada data laporan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
