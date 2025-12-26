@if ($riwayat->status == 'proses' || $riwayat->status == 'selesai' || $riwayat->status == 'baru')
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
        @elseif($riwayat->status == 'baru')
            <div class="p-3 rounded-full border-4 border-green-300 hover:border-green-400 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-24 h-24 text-green-500 hover:text-green-600 animate-pulse transition duration-300 ease-in-out">
                    <path fill-rule="evenodd"
                        d="M6 3.75A.75.75 0 016.75 3h10.5a.75.75 0 01.75.75v2.25c0 .621-.504 1.125-1.125 1.125h-.27a.75.75 0 00-.53.22l-2.71 2.71a.75.75 0 000 1.06l2.71 2.71c.14.14.22.33.22.53v.27c0 .621.504 1.125 1.125 1.125h.27a.75.75 0 01.75.75v2.25a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75v-2.25c0-.621.504-1.125 1.125-1.125h.27a.75.75 0 00.53-.22l2.71-2.71a.75.75 0 000-1.06l-2.71-2.71a.75.75 0 00-.53-.22h-.27A1.125 1.125 0 016 6V3.75z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
        @endif
        <!-- Judul diubah jadi "Selesai" -->
        <h1
            class="text-xl font-bold @if ($riwayat->status == 'baru') text-green-600 @elseif($riwayat->status == 'proses') text-yellow-500 @else text-blue-600 @endif first-letter:uppercase">
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
    <div class="bg-white rounded-lg p-4 shadow mb-4">
        <div class="flex items-start space-x-4">

            <!-- Thumbnail -->
            @php
                $reportPhotos = $riwayat->photos;
            @endphp

            @if ($reportPhotos->isEmpty())
                <img src="{{ asset('assets/logo/logo-smkn2kra.webp') }}"
                    class="w-24 h-24 object-cover rounded-lg shadow">
            @else
                <img src="{{ asset('assets/photos/' . $reportPhotos[0]->photo_url) }}"
                    onclick="openReportSlider({{ $reportPhotos->pluck('photo_url')->toJson() }})"
                    class="w-24 h-24 object-cover rounded-lg shadow cursor-pointer">
            @endif


            <!-- Modal Slider -->
            <div id="reportSliderModal"
                class="hidden fixed inset-0 bg-black bg-opacity-80 z-50 flex items-center justify-center">

                <div class="relative max-w-4xl w-full px-4">

                    <button onclick="closeReportSlider()"
                        class="absolute top-2 right-2 text-white text-3xl">&times;</button>

                    <button onclick="prevReportImage()"
                        class="absolute left-0 top-1/2 -translate-y-1/2 text-white text-4xl px-4">‹</button>

                    <img id="reportSliderImage"
                        class="mx-auto max-h-[90vh] rounded-lg shadow-lg transition-all duration-300">

                    <button onclick="nextReportImage()"
                        class="absolute right-0 top-1/2 -translate-y-1/2 text-white text-4xl px-4">›</button>

                    <p id="reportImageCounter" class="text-center text-white text-sm mt-2"></p>
                </div>
            </div>



            <!-- Konten Aduan -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Judul Laporan: {{ $riwayat->title }}</h2>
                <p class="text-sm text-gray-500 mb-2">
                    Dikirim oleh <span class="font-medium text-gray-700">{{ $riwayat->reporter->nama }}</span>
                    pada <span>{{ substr($riwayat->created_at, 0, 10) }}</span>, <span>{{ substr($riwayat->created_at, 11, 5) }}</span>
                </p>
                <p class="text-sm break-all hidden sm:flex text-gray-700">{{ $riwayat->description }}</p>
            </div>
        </div>
        <div>
            <p class="text-sm mt-3 flex sm:hidden break-all text-gray-700">{{ $riwayat->description }}</p>
        </div>
    </div>

    <!-- Riwayat Tanggapan -->
    <div id="chatContainer"
        class="bg-white rounded-lg p-4 shadow mb-4 h-[500px] overflow-y-auto space-y-4 flex flex-col">
        @foreach ($chats as $chat)
            @php
                $isMe = $chat->sender_id == Auth::user()->id;
                $profileImage = $chat->sender->profile ?? 'user.png';
                $limit = 100;
                $isLong = strlen($chat->message) > $limit;
            @endphp

            <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                <div class="flex items-start gap-2 {{ $isMe ? 'flex-row-reverse' : '' }}">

                    <img src="{{ asset('assets/profil/' . $profileImage) }}" class="w-9 h-9 rounded-full object-cover">

                    <!-- BUBBLE -->
                    <div
                        class="{{ $isMe ? 'bg-blue-100' : 'bg-gray-100' }}
                    inline-block w-fit max-w-[85%]
                    p-3 rounded-lg break-all overflow-hidden">

                        <!-- Nama -->
                        <span class="block text-xs font-semibold text-blue-600 mb-1">
                            {{ $chat->sender->nama }}
                        </span>

                        <!-- FOTO CHAT -->
                        @if ($chat->photos->count())
                            @php
                                $photos = $chat->photos;
                                $total = $photos->count();
                                $displayPhotos = $photos->take(4);
                            @endphp

                            <div class="grid grid-cols-2 gap-2 mb-2">
                                @foreach ($displayPhotos as $index => $photo)
                                    <div class="relative">
                                        <img src="{{ asset('assets/chat_photos/' . $photo->photo_url) }}"
                                            class="w-full h-40 object-cover rounded-lg cursor-pointer"
                                            onclick="openChatSlider({{ $photos->pluck('photo_url')->toJson() }}, {{ $index }})">

                                        @if ($index === 3 && $total > 4)
                                            <div
                                                class="absolute inset-0 bg-black bg-opacity-60 rounded-lg
                        flex items-center justify-center text-white text-3xl font-bold">
                                                +{{ $total - 4 }}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div id="chatSliderModal"
                            class="hidden fixed inset-0 bg-black bg-opacity-80 z-50 flex items-center justify-center">

                            <div class="relative max-w-4xl w-full px-4">

                                <button onclick="closeChatSlider()"
                                    class="absolute top-2 right-2 text-white text-3xl">&times;</button>

                                <button onclick="prevChatImage()"
                                    class="absolute left-0 top-1/2 -translate-y-1/2 text-white text-4xl px-4">‹</button>

                                <img id="chatSliderImage"
                                    class="mx-auto max-h-[90vh] rounded-lg shadow-lg transition-all duration-300">

                                <button onclick="nextChatImage()"
                                    class="absolute right-0 top-1/2 -translate-y-1/2 text-white text-4xl px-4">›</button>

                                <p id="chatImageCounter" class="text-center text-white text-sm mt-2"></p>
                            </div>
                        </div>


                        <!-- PESAN -->
                        @if ($chat->message)
                            <p class="text-gray-700 text-sm leading-relaxed">
                                <span class="short-text">
                                    {{ $isLong ? Str::limit($chat->message, $limit) : $chat->message }}
                                </span>

                                @if ($isLong)
                                    <span class="full-text hidden">
                                        {{ $chat->message }}
                                    </span>

                                    <button type="button" class="block text-blue-500 text-xs mt-1"
                                        onclick="toggleMessage(this)">
                                        Baca selengkapnya
                                    </button>
                                @endif
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Input Chat -->
    <form action="/riwayat-laporan/send/{{ encrypt($riwayat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Preview Image -->
        <div id="imagePreviewContainer" class="flex gap-3 mb-2 hidden flex-wrap"></div>
        <div class="flex items-center bg-white rounded-lg shadow p-2">
            <!-- Input teks -->
            <input type="text" name="sender_id" value="{{ Auth::user()->id }}" id="" hidden>
            <input type="text" name="receiver_id" value="{{ $riwayat->target_user_id }}" id="" hidden>
            <label for="file-upload" class="cursor-pointer mr-2 text-gray-500 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 7.5A1.5 1.5 0 014.5 6h3.379a1.5 1.5 0 001.06-.44l.94-.94A1.5 1.5 0 0110.94 4.5h2.12a1.5 1.5 0 011.061.44l.939.94A1.5 1.5 0 0016.122 6H19.5a1.5 1.5 0 011.5 1.5v10.5a1.5 1.5 0 01-1.5 1.5h-15A1.5 1.5 0 013 18V7.5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13.5a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </label>
            <input type="file" id="file-upload" name="photos[]" accept="image/*" multiple class="hidden"
                {{ $riwayat->status == 'proses' ? '' : 'disabled' }} />
            <input type="text"
                placeholder="{{ $riwayat->status == 'proses' ? 'Ketik tanggapan...' : 'Tunggu hingga penerima laporan mensetujui laporan...' }}{{ $riwayat->status == 'selesai' ? 'Sesi percakapan ditutup, laporan sudah di selesaikan...' : '' }}"
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
            <a href="/riwayat-laporan"
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
    window.addEventListener('load', function() {
        const container = document.getElementById('chatContainer');
        container.scrollTop = container.scrollHeight;
    });
</script>
<script>
    function toggleMessage(button) {
        const parent = button.closest('p');
        const shortText = parent.querySelector('.short-text');
        const fullText = parent.querySelector('.full-text');

        if (fullText.classList.contains('hidden')) {
            shortText.classList.add('hidden');
            fullText.classList.remove('hidden');
            button.innerText = 'Tutup';
        } else {
            shortText.classList.remove('hidden');
            fullText.classList.add('hidden');
            button.innerText = 'Baca selengkapnya';
        }
    }
</script>
<script>
    let reportImages = [];
    let reportIndex = 0;

    function openReportSlider(photoArray, start = 0) {
        reportImages = photoArray.map(p => `/assets/photos/${p}`);
        reportIndex = start;

        updateReportSlider();
        document.getElementById('reportSliderModal').classList.remove('hidden');
    }

    function updateReportSlider() {
        document.getElementById('reportSliderImage').src = reportImages[reportIndex];
        document.getElementById('reportImageCounter').innerText =
            `${reportIndex + 1} / ${reportImages.length}`;
    }

    function nextReportImage() {
        reportIndex = (reportIndex + 1) % reportImages.length;
        updateReportSlider();
    }

    function prevReportImage() {
        reportIndex = (reportIndex - 1 + reportImages.length) % reportImages.length;
        updateReportSlider();
    }

    function closeReportSlider() {
        document.getElementById('reportSliderModal').classList.add('hidden');
    }
</script>
<script>
    let chatImages = [];
    let chatIndex = 0;

    function openChatSlider(photoArray, start = 0) {
        chatImages = photoArray.map(p => `/assets/chat_photos/${p}`);
        chatIndex = start;

        updateChatSlider();
        document.getElementById('chatSliderModal').classList.remove('hidden');
    }

    function updateChatSlider() {
        document.getElementById('chatSliderImage').src = chatImages[chatIndex];
        document.getElementById('chatImageCounter').innerText =
            `${chatIndex + 1} / ${chatImages.length}`;
    }

    function nextChatImage() {
        chatIndex = (chatIndex + 1) % chatImages.length;
        updateChatSlider();
    }

    function prevChatImage() {
        chatIndex = (chatIndex - 1 + chatImages.length) % chatImages.length;
        updateChatSlider();
    }

    function closeChatSlider() {
        document.getElementById('chatSliderModal').classList.add('hidden');
    }
</script>
<script>
    const inputFile = document.getElementById('file-upload');
    const previewContainer = document.getElementById('imagePreviewContainer');
    let selectedFiles = [];

    inputFile.addEventListener('change', function() {
        previewContainer.innerHTML = '';
        selectedFiles = Array.from(this.files);

        if (selectedFiles.length > 0) {
            previewContainer.classList.remove('hidden');
        }

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const wrapper = document.createElement('div');
                wrapper.className = 'relative w-24 h-24 rounded-lg overflow-hidden shadow';

                wrapper.innerHTML = `
                <img src="${e.target.result}"
                    class="w-full h-full object-cover rounded-lg">

                <button type="button"
                    onclick="removeImage(${index})"
                    class="absolute top-1 right-1
                        w-6 h-6
                        flex items-center justify-center
                        bg-white text-gray-700
                        rounded-full shadow-md
                        hover:bg-red-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="w-4 h-4">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;

                previewContainer.appendChild(wrapper);
            };

            reader.readAsDataURL(file);
        });
    });

    function removeImage(index) {
        selectedFiles.splice(index, 1);

        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        inputFile.files = dataTransfer.files;

        if (selectedFiles.length === 0) {
            previewContainer.classList.add('hidden');
        }

        inputFile.dispatchEvent(new Event('change'));
    }
</script>
