<div class="max-w-7xl mx-auto bg-white p-6 mt-10 rounded-lg shadow-lg">
    <!-- Filter Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-4 sm:space-y-0 mb-6">
        <!-- Search -->
        <div class="flex items-center border rounded-lg px-3 py-2 w-full sm:w-64 bg-gray-100">
            <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="7"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input id="searchInput" type="text" placeholder="Cari laporan.."
                class="bg-transparent outline-none w-full text-gray-700" />
        </div>

        <!-- Filter Tanggal -->
        <select id="dateFilter"
            class="border rounded-lg px-3 py-2 w-full sm:w-48 bg-white text-gray-700 focus:outline-blue-500">
            <option value="">Semua Tanggal</option>
            <option value="today">Hari Ini</option>
            <option value="week">Minggu Ini</option>
            <option value="month">Bulan Ini</option>
        </select>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <div class="space-x-2 mb-4 px-2">
            <table class="w-[800px] sm:w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-sm text-gray-500">
                        <th class="px-4 py-3">NO</th>
                        <th class="px-4 py-3">JUDUL</th>
                        <th class="px-4 py-3">PELAPOR</th>
                        <th class="px-4 py-3">STATUS</th>
                        <th class="px-4 py-3">TANGGAL</th>
                        <th class="px-4 py-3 text-left">AKSI</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="text-gray-700">
                    <!-- Row 1 -->
                    @foreach ($reports as $report)
                        <tr class="border-b border-gray-100 hover:bg-gray-50" data-title="{{ $report->title }}" data-date="{{ $report->created_at }}">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $report->title }}</td>
                            <td class="px-4 py-3 flex items-center space-x-2">
                                @if ($report->reporter->profile == null)
                                    <div
                                        class="w-10 sm:w-7 h-7 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-semibold">
                                        {{ getInitials($report->reporter->nama) }}
                                    </div>
                                @else
                                    <a href="{{ asset('assets/profil/' . $report->reporter->profile) }}"
                                        target="_blank">
                                        <img src="{{ asset('assets/profil/' . $report->reporter->profile) }}"
                                            alt="Foto Profil" class="w-7 h-7 rounded-full object-cover">
                                    </a>
                                @endif
                                <span>{{ $report->reporter->nama }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="bg-blue-100 text-blue-700 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $report->status }}</span>
                            </td>
                            <td class="px-4 py-3">{{ $report->created_at }}</td>
                            <td class="px-4 py-3 text-center">
                                <button
                                    onclick="document.getElementById('modalJawabDitolak').classList.remove('hidden')"
                                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5 rounded flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                    <span>Tanggapi</span>
                                </button>
                            </td>

                            <div id="modalJawabDitolak"
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden overflow-y-auto">
                                <div class="bg-white rounded-lg w-full max-w-2xl mx-4 my-2 p-6 relative max-h-[90vh] h-fit overflow-y-auto"
                                    style="margin-top: 10px; margin-bottom: 10px;">
                                    <!-- Judul -->
                                    <h2 class="text-xl font-bold mb-4 text-center">Detail Laporan</h2>

                                    <!-- Gambar Kecil -->
                                    <!-- Thumbnail Gambar -->
                                    <div class="flex justify-center mb-4 flex-wrap gap-4">
                                        @if ($report->photos->isEmpty())
                                            <p>Tidak ada foto</p>
                                        @else
                                            @foreach ($report->photos as $photo)
                                                <img src="{{ asset('assets/photos/' . $photo->photo_url) }}"
                                                    onclick="showFullImage('modalfotoDitolak', '{{ asset('assets/photos/' . $photo->photo_url) }}')"
                                                    class="cursor-pointer rounded-lg shadow-md w-48 h-48 object-cover hover:scale-105 duration-200">
                                            @endforeach
                                        @endif
                                    </div>
                                    <!-- Modal Gambar Besar di modalfotoDitolak -->
                                    <div id="modalfotoDitolak"
                                        class="hidden fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center px-4 py-10">
                                        <div class="relative">
                                            <!-- Tombol Close -->
                                            <button onclick="closeImageModal('modalfotoDitolak')"
                                                class="absolute -top-4 -right-4 bg-white rounded-full p-1 shadow-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            <!-- Gambar Besar -->
                                            <img id="modalImage_modalfotoDitolak" src="" alt="Gambar Besar"
                                                class="max-w-full max-h-[90vh] rounded-lg shadow-lg">
                                        </div>
                                    </div>

                                    <!-- Isi Laporan -->
                                    <div class="mb-4 text-gray-700">
                                        <label class="block mb-1 font-medium text-gray-700">Deskripsi laporan</label>
                                        <textarea rows="3"
                                            class="w-full border rounded-lg shadow-md focus:ring-blue-500 focus:border-blue-500 text-sm py-2 px-3" readonly>{{ $report->description }}</textarea>
                                    </div>

                                    <form action="/guru/tanggapan/send" method="post">
                                        @csrf
                                        <input type="text" name="report_id" value="{{ $report->id }}" hidden>
                                        <input type="text" name="sender_id" value="{{ Auth::user()->id }}" hidden>
                                        <input type="text" name="receiver_id" value="{{ $report->reporter->id }}" hidden>
                                        <div class="mb-4">
                                            <label class="block mb-1 font-medium text-gray-700">Status Laporan</label>
                                            <div class="flex items-center space-x-1 mt-2">
                                                <!-- Radio Terima -->
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="status" value="proses"
                                                        class="hidden peer">
                                                    <span
                                                        class="text-sm text-green-700 bg-green-200 rounded-full px-3 py-1 font-semibold peer-checked:ring-2 peer-checked:ring-green-400 peer-checked:bg-green-300">
                                                        Terima
                                                    </span>
                                                </label>

                                                <!-- Radio Tolak -->
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="status" value="ditolak"
                                                        class="hidden peer">
                                                    <span
                                                        class="text-sm text-red-700 bg-red-200 rounded-full px-3 py-1 font-semibold peer-checked:ring-2 peer-checked:ring-red-400 peer-checked:bg-red-300">
                                                        Tolak
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Alasan -->
                                        <div class="mb-6 mt-3">
                                            <label class="block mb-1 font-medium text-gray-700">Alasan</label>
                                            <textarea rows="3" name="message"
                                                class="w-full border rounded-lg shadow-md focus:ring-blue-500 focus:border-blue-500 text-sm py-2 px-3"
                                                placeholder="Tulis alasan penolakan atau penerimaan laporan..."></textarea>
                                        </div>

                                        <!-- Tombol -->
                                        <div class="flex justify-end space-x-4">
                                            <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg">
                                                Kirim
                                            </button>
                                        </form>
                                        <button
                                            onclick="document.getElementById('modalJawabDitolak').classList.add('hidden')"
                                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function showFullImage(modalId, src) {
        document.getElementById(modalId).classList.remove("hidden");
        document.getElementById("modalImage_" + modalId).src = src;
    }

    function closeImageModal(modalId) {
        document.getElementById(modalId).classList.add("hidden");
    }


    function toggleDropdown() {
        const menu = document.getElementById("dropdown-menu");
        menu.classList.toggle("hidden");
    }

    // Tutup dropdown saat klik di luar
    window.addEventListener("click", function(e) {
        const btn = document.querySelector("button[onclick='toggleDropdown()']");
        const menu = document.getElementById("dropdown-menu");

        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add("hidden");
        }
    });

    const searchInput = document.getElementById("searchInput");
    const dateFilter = document.getElementById("dateFilter");
    const rows = document.querySelectorAll("tbody tr");

    function filterTable() {
        const keyword = searchInput.value.toLowerCase();
        const date = dateFilter.value;
        const now = new Date();

        rows.forEach(row => {
            const title = row.dataset.title.toLowerCase();
            const rowDate = new Date(row.dataset.date);

            let matchKeyword = title.includes(keyword);
            let matchDate = true;

            if (date === "today") {
                matchDate = isSameDay(rowDate, now);
            } else if (date === "week") {
                const oneWeekAgo = new Date();
                oneWeekAgo.setDate(now.getDate() - 7);
                matchDate = rowDate >= oneWeekAgo;
            } else if (date === "month") {
                const oneMonthAgo = new Date();
                oneMonthAgo.setMonth(now.getMonth() - 1);
                matchDate = rowDate >= oneMonthAgo;
            }

            if (matchKeyword && matchDate) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    function isSameDay(date1, date2) {
        return date1.getDate() === date2.getDate() &&
            date1.getMonth() === date2.getMonth() &&
            date1.getFullYear() === date2.getFullYear();
    }

    searchInput.addEventListener("input", filterTable);
    statusFilter.addEventListener("change", filterTable);
    dateFilter.addEventListener("change", filterTable);
</script>
