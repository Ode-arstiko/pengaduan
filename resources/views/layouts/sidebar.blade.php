    <aside id="sidebar"
        class="w-64 rounded-r-[20px] border-r border-teal-600 bg-gradient-to-tr from-blue-700 to-teal-500 text-white p-5 flex flex-col shadow-lg fixed inset-y-0 left-0 transform -translate-x-full  sm:translate-x-0 transition-transform duration-300 ease-in-out z-50">
        <div class="text-center mb-10">
            <img src="{{ asset('assets/logo/logo-smkn2kra.webp') }}" alt="Logo" class="w-16 h-16 mx-auto mb-2" />
            <h1 class="text-sm font-bold leading-tight">PENGADUAN<br />SKANDAKRA</h1>
        </div>

        <nav class="space-y-2">
            @if (Auth::user()->role == 'admin')
            <!-- Dashboard -->
            <a href="/admin"
                class="flex items-center gap-2 @if ($title == 'Dashboard') bg-white text-blue-700 font-semibold p-3 rounded-lg shadow-md ring-2 ring-blue-400 transition @else hover:bg-blue-400 shadow-md hover:text-white p-3 rounded-lg transition @endif">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h4a1 1 0 001-1v-4h4v4a1 1 0 001 1h4a1 1 0 001-1V10" />
                </svg>
                Dashboard
            </a>

            <!-- Data Siswa -->
            <a href="/admin/kelola-siswa"
                class="flex items-center gap-2 @if ($title == 'Siswa') bg-white text-blue-700 font-semibold p-3 rounded-lg shadow-md ring-2 ring-blue-400 transition @else hover:bg-blue-400 shadow-md hover:text-white p-3 rounded-lg transition @endif">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5.121 17.804A4 4 0 017 17h10a4 4 0 011.879.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Data Siswa Pengguna
            </a>

            <!-- Data Guru -->
            <a href="/admin/kelola-guru"
                class="flex items-center gap-2 @if ($title == 'Guru') bg-white text-blue-700 font-semibold p-3 rounded-lg shadow-md ring-2 ring-blue-400 transition @else hover:bg-blue-400 shadow-md hover:text-white p-3 rounded-lg transition @endif">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 20h5v-2a3 3 0 00-3-3h-2M7 20H2v-2a3 3 0 013-3h2m3-6a3 3 0 100-6 3 3 0 000 6zm8 0a3 3 0 100-6 3 3 0 000 6z" />
                </svg>
                Data Guru Pengguna
            </a>

            <!-- Data Admin -->
            <a href="/admin/kelola-admin"
                class="flex items-center gap-2 @if ($title == 'Admin') bg-white text-blue-700 font-semibold p-3 rounded-lg shadow-md ring-2 ring-blue-400 transition @else hover:bg-blue-400 shadow-md hover:text-white p-3 rounded-lg transition @endif">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 9V4h12v5M6 18h12v-5H6v5zM6 14H4a2 2 0 01-2-2V9a2 2 0 012-2h2" />
                </svg>
                Data Admin
            </a>
            @elseif(Auth::user()->role == 'siswa')
            <a href="{{ route('siswa.dashboard') }}"
                class="flex items-center gap-2 {{ request()->is('siswa') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-400' }} p-3 rounded-lg shadow-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4 0v-8m-4 0h4" />
                </svg>
                Dashboard
            </a>

            <a href="{{ route('siswa.laporan') }}"
                class="flex items-center gap-2 {{ request()->is('laporan') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-400' }} p-3 rounded-lg shadow-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 16h8M8 12h8m-8-4h8M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Buat Laporan
            </a>

            <a href="{{ route('siswa.riwayat') }}"
                class="flex items-center gap-2 {{ request()->is('riwayat-laporan') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-400' }} p-3 rounded-lg shadow-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5h6m2 0a2 2 0 012 2v11a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h2m2-1h2a1 1 0 011 1v0a1 1 0 01-1 1h-2a1 1 0 01-1-1v0a1 1 0 011-1z" />
                </svg>
                Riwayat Laporan
            </a>
            @else
            <a href="{{ route('guru.dashboard') }}"
                class="flex items-center gap-2 {{ request()->is('guru') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-400' }} p-3 rounded-lg shadow-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4 0v-8m-4 0h4" />
                </svg>
                Dashboard
            </a>

            {{-- Tanggapan --}}
            <a href="{{ route('guru.tanggapan') }}"
                class="flex items-center gap-2 {{ request()->is('guru/tanggapan') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-400' }} p-3 rounded-lg shadow-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8h2a2 2 0 012 2v7a2 2 0 01-2 2H7l-4 4V10a2 2 0 012-2h2" />
                </svg>
                Laporan
            </a>

            {{-- Riwayat Tanggapan --}}
            <a href="{{ route('guru.riwayat') }}"
                class="flex items-center gap-2 {{ request()->is('guru/riwayat') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-400' }} p-3 rounded-lg shadow-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5h6m2 0a2 2 0 012 2v11a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h2m2-1h2a1 1 0 011 1v0a1 1 0 01-1 1h-2a1 1 0 01-1-1v0a1 1 0 011-1z" />
                </svg>
                Riwayat Tanggapan
            </a>

            {{-- Cetak Laporan --}}
            <a href="{{ route('guru.laporan') }}"
                class="flex items-center gap-2 {{ request()->is('guru/laporan') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-400' }} p-3 rounded-lg shadow-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 9V4h12v5M6 18h12v-5H6v5z" />
                </svg>
                Cetak Laporan
            </a>
            @endif
        </nav>
    </aside>

<div id="sidebar-overlay"
    class="fixed inset-0 bg-black/50 z-40
    opacity-0 pointer-events-none
    transition-opacity duration-300 sm:hidden">
</div>