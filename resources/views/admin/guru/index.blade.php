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
            <input id="searchInput" type="text" placeholder="Cari Guru..."
                class="bg-transparent outline-none w-full text-gray-700">
        </div>

        <!-- Tombol Tambah -->
        <a id="addBtn" href="/admin/kelola-guru/create"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
            + Tambah Guru
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto w-[310px] sm:w-full">
        <table class="w-[700px] sm:w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-200 text-sm text-gray-500">
                    <th class="px-4 py-3">NO</th>
                    <th class="px-4 py-3">NAMA</th>
                    <th class="px-4 py-3">USERNAME</th>
                    <th class="px-4 py-3">JABATAN</th>
                    <th colspan="2" class="px-4 py-3">AKSI</th>
                </tr>
            </thead>
            <tbody id="tableBody" class="text-gray-700">
                @foreach ($guru as $gur)
                    <tr class="border-b border-gray-100 hover:bg-gray-50" data-title="Permintaan Dispensasi"
                        data-status="Ditolak" data-date="2025-07-18T07:55:00">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $gur->nama }}</td>
                        <td class="px-4 py-3 flex items-center space-x-2">
                            @if ($gur->profile == null)
                                <div
                                    class="w-9 sm:w-7 h-9 sm:h-7 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-semibold">
                                    {{ getInitials($gur->nama) }}
                                </div>
                            @else
                                <a href="{{ asset('assets/profil/' . $gur->profile) }}" target="_blank">
                                    <img src="{{ asset('assets/profil/' . $gur->profile) }}" alt="Foto Profil"
                                        class="w-9 sm:w-7 h-9 sm:h-7 rounded-full object-cover">
                                </a>
                            @endif
                            <span>{{ $gur->username }}</span>
                        </td>
                        <td class="px-4 py-3">
                            @if ($gur->role == 'kepala-sekolah')
                                Kepala Sekolah
                            @elseif($gur->role == 'waka-kesiswaan')
                                Waka Kesiswaan
                            @elseif($gur->role == 'waka-kurikulum')
                                Waka Kurikulum
                            @elseif($gur->role == 'BK')
                                BK
                            @elseif($gur->role == 'tata-usaha')
                                Tata Usaha
                            @endif
                        </td>
                        <td class="px-2 sm:px-0">
                            <a href="/admin/kelola-guru/edit/{{ encrypt($gur->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1 rounded">
                                Edit
                            </a>
                        </td>
                        <td class="px-2 sm:px-0">
                            <form action="/admin/kelola-guru/delete/{{ encrypt($gur->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
