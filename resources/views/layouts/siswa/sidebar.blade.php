<aside id="sidebar"
    class="w-64 rounded-r-[20px] bg-gradient-to-tr from-blue-700 to-teal-500 text-white p-5 flex flex-col shadow-lg fixed inset-y-0 left-0 transform -translate-x-full  sm:translate-x-0 transition-transform duration-300 ease-in-out z-50">
    <div class="text-center mb-10">
        <img src="{{ asset('assets/logo/logo-smkn2kra.webp') }}" alt="Logo" class="w-16 h-16 mx-auto mb-2" />
        <h1 class="text-sm font-bold leading-tight">PENGADUAN<br />SKANDAKRA</h1>
    </div>
    
    <nav class="space-y-2">
        <a href="{{ route('siswa.dashboard') }}"
            class="flex items-center gap-2 {{ request()->is('siswa') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-400' }} p-3 rounded-lg shadow-md transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4 0v-8m-4 0h4" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('siswa.laporan') }}" class="flex items-center gap-2 {{ request()->is('laporan') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-400' }} p-3 rounded-lg shadow-md transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 16h8M8 12h8m-8-4h8M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Buat Laporan
        </a>

        <a href="{{ route('siswa.riwayat') }}" class="flex items-center gap-2 {{ request()->is('riwayat-laporan') ? 'bg-white text-blue-700 font-semibold ring-2 ring-blue-400' : 'hover:bg-blue-400' }} p-3 rounded-lg shadow-md transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5h6m2 0a2 2 0 012 2v11a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h2m2-1h2a1 1 0 011 1v0a1 1 0 01-1 1h-2a1 1 0 01-1-1v0a1 1 0 011-1z" />
            </svg>
            Riwayat Laporan
        </a>
    </nav>
</aside>

<div id="sidebar-overlay"
    class="fixed inset-0 bg-black/50 z-40
    opacity-0 pointer-events-none
    transition-opacity duration-300 sm:hidden">
</div>