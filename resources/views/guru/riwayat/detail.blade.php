@if ($riwayat->status == 'proses' || $riwayat->status == 'selesai')
    <!-- Foto & Judul -->
    <div class="flex flex-col items-center mb-6">
        <!-- Ganti dengan ikon ceklis hijau -->
        @if ($riwayat->status == 'proses')
            <div class="p-3 rounded-full border-4 border-yellow-200 hover:border-yellow-500 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-24 h-24 text-yellow-500 hover:text-yellow-600 animate-spin transition-colors duration-300"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356-.028A9.003 9.003 0 0012 3a9 9 0 00-8.418 5.972M20 20v-5h-.581m-15.357.028A9.003 9.003 0 0012 21a9 9 0 008.418-5.972">
                    </path>
                </svg>
            </div>
        @elseif($riwayat->status == 'selesai')
            <div class="p-3 rounded-full border-4 border-blue-200 hover:border-blue-500 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-24 h-24 text-blue-500 hover:text-blue-600 animate-pulse transition-colors duration-300"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        @endif
        <!-- Judul diubah jadi "Selesai" -->
        <h1
            class="text-xl font-bold {{ $riwayat->status == 'proses' ? 'text-yellow-500' : 'text-blue-600' }} first-letter:uppercase">
            {{ $riwayat->status }}</h1>
    </div>


    <!-- Progress Status -->
    <div id="progressBar" class="flex items-center justify-between max-w-md mx-auto mb-6 relative">

        <!-- Baru -->
        <div class="flex flex-col items-center z-10">
            <div id="dot-baru" data-status="baru"
                class="w-5 h-5 rounded-full border-4 border-gray-300 bg-gray-300 shadow-md transition-colors duration-300">
            </div>
            <span class="text-sm text-gray-600 mt-1">Baru</span>
        </div>

        <!-- Garis 1 -->
        <div class="flex-1 h-1 bg-gray-300 mx-2 rounded-full"></div>

        <!-- Proses -->
        <div class="flex flex-col items-center z-10">
            <div id="dot-proses" data-status="proses"
                class="w-5 h-5 rounded-full border-4 border-gray-300 bg-gray-300 shadow-md transition-colors duration-300">
            </div>
            <span class="text-sm text-gray-600 mt-1">Proses</span>
        </div>

        <!-- Garis 2 -->
        <div class="flex-1 h-1 bg-gray-300 mx-2 rounded-full"></div>

        <!-- Selesai -->
        <div class="flex flex-col items-center z-10">
            <div id="dot-selesai" data-status="selesai"
                class="w-5 h-5 rounded-full border-4 border-gray-300 bg-gray-300 shadow-md transition-colors duration-300">
            </div>
            <span class="text-sm text-gray-600 mt-1">Selesai</span>
        </div>

    </div>


    <!-- Isi Aduan -->
    <div class="bg-white rounded-lg p-4 shadow mb-4 relative">
        <!-- Tombol Selesai di pojok kanan atas -->
        <button onclick="location.href='/guru/riwayat/detail/selesai/{{ encrypt($riwayat->id) }}'"
            @if ($riwayat->status == 'selesai') disabled @endif
            class="absolute top-3 right-3 @if ($riwayat->status != 'selesai') bg-green-500 hover:bg-green-600 @endif bg-green-400 text-white text-sm font-semibold px-3 py-1.5 rounded-lg shadow transition">
            Selesai
        </button>

        <div class="flex items-start space-x-4">
            <!-- Thumbnail Gambar -->
            @if ($riwayat->photos->isEmpty())
                <img src="{{ asset('assets/logo/logo-smkn2kra.webp') }}"
                    class="w-24 h-24 object-cover rounded-lg shadow">
            @else
                <img src="{{ asset('assets/photos/' . $photo->photo_url) }}"
                    onclick="showFullImage('modalBuktiLaporan', '{{ asset('assets/photos/' . $photo->photo_url) }}')"
                    class="w-24 h-24 object-cover rounded-lg shadow cursor-pointer">
            @endif

            <!-- Modal Gambar Besar -->
            <div id="modalBuktiLaporan"
                class="hidden fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center px-4 py-10">
                <div class="relative">
                    <!-- Tombol Close -->
                    <button onclick="closeImageModal('modalBuktiLaporan')"
                        class="absolute -top-4 -right-4 bg-white rounded-full p-1 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <!-- Gambar Besar -->
                    <img id="modalImage_modalBuktiLaporan" src="" alt="Gambar Besar"
                        class="max-w-full max-h-[90vh] rounded-lg shadow-lg">
                </div>
            </div>

            <!-- Konten Aduan -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Judul Laporan: {{ $riwayat->title }}</h2>
                <p class="text-sm text-gray-500 mb-2">
                    Dikirim oleh <span class="font-medium text-gray-700">{{ $riwayat->reporter->nama }}</span>
                    pada <span>{{ substr($riwayat->created_at, 0, 10) }}</span>
                </p>
                <p class="text-sm text-gray-700">{{ $riwayat->description }}</p>
            </div>
        </div>
    </div>

    <!-- Riwayat Tanggapan -->
    <div id="chatContainer" class="bg-white rounded-lg p-4 shadow mb-4 h-64 overflow-y-auto space-y-4 flex flex-col">
        @foreach ($chats as $chat)
            @php
                if ($chat->sender_id == Auth::user()->id && $chat->receiver_id != Auth::user()->id) {
                    $profileImage = $chat->sender->profile;
                } elseif ($chat->sender_id != Auth::user()->id && $chat->receiver_id == Auth::user()->id) {
                    $profileImage = $chat->sender->profile;
                }

                $profileImage = $profileImage ? $profileImage : 'user.png';
            @endphp
            <div
                class="flex @if ($chat->sender_id == Auth::user()->id) items-center space-x-3 space-x-reverse self-end flex-row-reverse @else items-start space-x-3 @endif">
                <img src="{{ asset('assets/profil/' . $profileImage) }}" alt="Profil"
                    class="w-12 h-12 rounded-full object-cover" />
                <div>
                    <div
                        class="@if ($chat->sender_id == Auth::user()->id) bg-blue-100 @else bg-gray-100 @endif text-sm p-2 rounded-lg max-w-xs mt-1">
                        <span class="block text-blue-500 font-semibold">
                            @if ($chat->sender_id == Auth::user()->id && $chat->receiver_id != Auth::user()->id)
                                {{ $chat->sender->nama }}
                            @elseif($chat->sender_id != Auth::user()->id && $chat->receiver_id == Auth::user()->id)
                                {{ $chat->sender->nama }}
                            @endif
                        </span>
                        <p>{{ $chat->message }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



    <!-- Input Chat -->
    <form action="/guru/riwayat/send/{{ encrypt($riwayat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex items-center bg-white rounded-lg shadow p-2">
            <!-- Input teks -->
            <input type="text" name="sender_id" value="{{ Auth::user()->id }}" id="" hidden>
            <input type="text" name="receiver_id" value="{{ $riwayat->reporter_id }}" id="" hidden>
            <label for="file-upload" class="cursor-pointer mr-2 text-gray-500 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 7.5A1.5 1.5 0 014.5 6h3.379a1.5 1.5 0 001.06-.44l.94-.94A1.5 1.5 0 0110.94 4.5h2.12a1.5 1.5 0 011.061.44l.939.94A1.5 1.5 0 0016.122 6H19.5a1.5 1.5 0 011.5 1.5v10.5a1.5 1.5 0 01-1.5 1.5h-15A1.5 1.5 0 013 18V7.5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13.5a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </label>
            <input type="file" id="file-upload" accept="image/*" class="hidden"
                {{ $riwayat->status == 'proses' ? '' : 'disabled' }} />
            <input type="text"
                placeholder="{{ $riwayat->status == 'proses' ? 'Ketik tanggapan...' : 'Sesi percakapan ditutup, laporan sudah di selesaikan...' }}"
                name="message" class="flex-1 px-3 py-2 outline-none text-sm" required
                {{ $riwayat->status == 'proses' ? '' : 'readonly' }} />

            <!-- Input file (ikon kamera) -->

            <!-- Tombol Kirim -->
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Kirim</button>
        </div>
    </form>
@else
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-6 mt-6">
        <div class="mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold text-red-600 mb-1">Detail Pengaduan - Ditolak</h2>
            <p class="text-sm text-gray-500">Status laporan kamu: <span
                    class="font-semibold text-red-600">Ditolak</span>
            </p>
        </div>

        <div class="flex flex-col md:flex-row gap-6">
            @if ($riwayat->photos->isEmpty())
                <img src="{{ asset('assets/logo/logo-smkn2kra.webp') }}" alt="Logo Sekolah"
                    class="w-24 h-24 rounded-lg object-cover shadow-md">
            @else
                <img src="{{ asset('assets/photos/' . $photo->photo_url) }}" alt="Logo Sekolah"
                    class="w-24 h-24 rounded-lg object-cover shadow-md">
            @endif

            <div class="flex-1 space-y-2">
                <div>
                    <h3 class="font-semibold text-gray-800">Judul Pengaduan:</h3>
                    <p class="text-gray-700">{{ $riwayat->title }}</p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-800">Nama Pengadu:</h3>
                    <p class="text-gray-700">{{ $riwayat->reporter->nama }}</p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-800">Tanggal Pengaduan:</h3>
                    <p class="text-gray-700">{{ substr($riwayat->created_at, '0', '10') }},
                        {{ substr($riwayat->created_at, '11', '5') }}</p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-800">Ditujukan Kepada:</h3>
                    <p class="text-gray-700">
                        {{ $riwayat->target->nama . ' - ' }}
                        @if ($riwayat->target->role == 'kepala-sekolah')
                            Kepala Sekolah
                        @elseif($riwayat->target->role == 'waka-kesiswaan')
                            Waka Kesiswaan
                        @elseif($riwayat->target->role == 'waka-kurikulum')
                            Waka Kurikulum
                        @elseif($riwayat->target->role == 'BK')
                            BK
                        @else
                            Tata Usaha
                        @endif
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-800">Isi Pengaduan:</h3>
                    <p class="text-gray-700 text-justify">
                        {{ $riwayat->description }}
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-800">Alasan Penolakan:</h3>
                    <p class="text-red-600 italic">
                        @foreach ($chats as $chat)
                            {{ $chat->message }}
                        @endforeach
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-8 text-right">
            <a href="/guru/riwayat"
                class="inline-block bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition text-sm font-semibold">
                Kembali ke Riwayat
            </a>
        </div>
    </div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // ambil semua dot
        const dots = document.querySelectorAll("[data-status]");

        // ambil status aktif (bisa dari server atau hidden input)
        const currentStatus = "{{ $riwayat->status }}";

        dots.forEach(dot => {
            const status = dot.getAttribute("data-status");

            // reset dulu ke abu-abu
            dot.classList.remove("bg-green-400", "bg-yellow-400", "bg-blue-400");
            dot.classList.add("bg-gray-300");

            // validasi dan ubah warna sesuai status
            if (status === "baru" && currentStatus === "baru") {
                dot.classList.replace("bg-gray-300", "bg-green-400");
            } else if (status === "proses" && currentStatus === "proses") {
                dot.classList.replace("bg-gray-300", "bg-yellow-400");
            } else if (status === "selesai" && currentStatus === "selesai") {
                dot.classList.replace("bg-gray-300", "bg-blue-400");
            }
        });
    });
</script>
<script>
    function showFullImage(modalId, src) {
        document.getElementById(modalId).classList.remove("hidden");
        document.getElementById("modalImage_" + modalId).src = src;
    }

    function closeImageModal(modalId) {
        document.getElementById(modalId).classList.add("hidden");
    }
</script>
<script>
    window.addEventListener('load', function () {
        const container = document.getElementById('chatContainer');
        container.scrollTop = container.scrollHeight;
    });
</script>