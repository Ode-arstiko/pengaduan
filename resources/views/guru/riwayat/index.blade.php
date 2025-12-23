<div class="flex space-x-4 mb-4 lg:px-10">
    <button onclick="filterLaporan('all', this)" id="btn-all"
        class="filter-button text-green-600 border-b-2 border-green-600 pb-2 font-medium">
        Riwayat
    </button>
    <button onclick="filterLaporan('proses', this)" id="btn-proses"
        class="filter-button text-gray-500 pb-2 hover:text-black">
        Proses
    </button>
    <button onclick="filterLaporan('selesai', this)" id="btn-selesai"
        class="filter-button text-gray-500 pb-2 hover:text-black">
        Selesai
    </button>
    <button onclick="filterLaporan('ditolak', this)" id="btn-ditolak"
        class="filter-button text-gray-500 pb-2 hover:text-black">
        Ditolak
    </button>
</div>
<div id="laporan-container" class="space-y-4 lg:px-10">
    <!-- DITERIMA - BK -->
	@foreach($riwayat as $riw)
    <div onclick="window.location.href='/guru/riwayat/detail/{{ encrypt($riw->id) }}'" data-status="{{ $riw->status }}"
        class="laporan-card cursor-pointer bg-white rounded-xl shadow-lg border p-4 flex items-center justify-between hover:bg-gray-50 transition duration-200">

        <!-- Kiri: Logo -->
        <div class="flex-shrink-0">
            <img src="{{ asset('assets/logo/logo-smkn2kra.webp') }}" alt="Logo"
                class="w-16 h-16 rounded-lg object-cover" />
        </div>

        <!-- Tengah: Isi laporan -->
        <div class="flex-1 mx-4">
            <div class="text-sm text-gray-500 mb-1">
                <span class="font-medium text-gray-700">Nama Pengadu:</span> {{ $riw->reporter->nama }}
            </div>
            <div class="text-base font-semibold text-gray-900 leading-tight">
                {{ $riw->title }}
            </div>
            <div class="text-sm text-gray-700 mt-1 line-clamp-2">
                {{ $riw->description }}
            </div>
            <div class="text-sm text-gray-500 mt-2">
                <span class="font-medium text-gray-700">Ditujukan Kepada:</span> {{ $riw->target->role }}
            </div>
        </div>

        <!-- Kanan: Status dan waktu -->
        <div class="flex flex-col items-end justify-between text-right h-full">
            <div class="text-sm font-medium text-gray-700">
                {{ $riw->created_at }}
            </div>
            <button class="mt-2 text-xs font-semibold bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                {{ $riw->status }}
            </button>
        </div>
    </div>
	@endforeach
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const laporanCards = document.querySelectorAll(".laporan-card");

        laporanCards.forEach(card => {
            card.addEventListener("click", function() {
                const status = card.getAttribute("data-status");
                localStorage.setItem("statusLaporan", status); // Simpan status
            });
        });
    });

    function filterLaporan(status, clickedButton) {
        // Ganti border aktif hanya pada tombol yang diklik
        document.querySelectorAll('.filter-button').forEach(btn => {
            btn.classList.remove('text-green-600', 'border-b-2', 'border-green-600', 'font-medium');
            btn.classList.add('text-gray-500');
        });

        clickedButton.classList.remove('text-gray-500');
        clickedButton.classList.add('text-green-600', 'border-b-2', 'border-green-600', 'font-medium');

        const cards = document.querySelectorAll('.laporan-card');
        cards.forEach(card => {
            const cardStatus = card.getAttribute('data-status');
            if (status === 'all' || cardStatus === status) {
                card.classList.remove('hidden');
            } else {
                card.classList.add('hidden');
            }
        });
    }

    window.addEventListener("click", function(e) {
        const btn = document.querySelector("button[onclick='toggleDropdown()']");
        const menu = document.getElementById("dropdown-menu");

        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add("hidden");
        }
    });
</script>
