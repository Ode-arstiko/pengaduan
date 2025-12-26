{{-- Header --}}
<div class="sticky top-0 bg-gray-100 px-4 pt-[126px] mt-[-166px]">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl mb-2 font-semibold text-gray-800">Semua Notifikasi</h1>

        <form action="" method="POST">
            @csrf
            <button onclick="tandaiSemua()" type="button" class="text-sm text-blue-600 hover:underline">
                Tandai semua dibaca
            </button>
        </form>
    </div>
</div>
<div class="max-w-4xl mx-auto px-4 py-6">


    {{-- List Notifikasi --}}
    <div class="bg-white rounded-lg shadow divide-y divide-gray-100">

        @forelse ($notifications_guru as $notif)
            <div class="notif-item" data-id="{{ $notif->id }}">
                <a href="{{ $notif->report_id
                    ? ($notif->report->status == 'baru'
                        ? '/guru/tanggapan'
                        : '/guru/riwayat/detail/' . encrypt($notif->report_id))
                    : ($notif->chat->receiver->role == 'siswa'
                            ? '/riwayat-laporan/detail/' . encrypt($notif->chat->report_id)
                            : '/guru/riwayat/detail/' . encrypt($notif->chat->report_id)) . '#kolom-chat' }}"
                    class="block px-5 py-4 rounded-lg {{ $notif->status == 'baru' ? 'bg-yellow-50/70 hover:bg-yellow-50' : 'hover:bg-gray-50' }} transition">

                    <div class="flex gap-4">

                        {{-- Icon / Foto --}}
                        <div class="shrink-0">
                            @if ($notif->report_photo)
                                <img src="/assets/photos/{{ $notif->report_photo->photo_url }}"
                                    class="w-12 h-12 rounded-full border-2 border-green-200 object-cover">
                            @else
                                @if ($notif->report_id == null)
                                    <div
                                        class="w-12 h-12 flex items-center border-2 border-blue-200 justify-center bg-blue-100 rounded-full">
                                        <i class="fas fa-envelope text-blue-600"></i>
                                    </div>
                                @else
                                    <div
                                        class="w-12 h-12 flex items-center border-2 border-green-200 justify-center bg-green-100 rounded-full">
                                        <i class="fas fa-clipboard text-green-600"></i>
                                    </div>
                                @endif
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <p class="font-semibold text-gray-800">
                                    {{ $notif->title }}
                                </p>

                                <div class="flex items-center">
                                    <span class="text-xs text-gray-400 me-2 {{ $notif->status == 'baru' ? 'hidden sm:flex' : '' }}">
                                        {{ $notif->created_at->format('d M Y, H:i') }}
                                    </span>
                                    @if ($notif->status == 'baru')
                                        <span
                                            class="inline-block px-2 py-0.5 text-xs
                                bg-yellow-100 text-yellow-600 rounded">
                                            Baru
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <p class="text-sm text-gray-500 mt-1">
                                @if ($notif->report_id)
                                    {{ $notif->report->reporter->nama }} —
                                    {{ $notif->report->title }}
                                @else
                                    {{ $notif->chat->sender->nama }} —
                                    {{ $notif->chat->message }}
                                @endif
                            </p>
                        </div>
                    </div>
                </a>
                <div id="contextMenu"
                    class="hidden fixed z-50 w-48 bg-white border border-gray-200 rounded-lg shadow-lg">
                    <button id="markAsReadBtn"
                        class="w-full rounded-t-lg text-left px-4 py-2 text-sm hover:bg-gray-100 transition duration-200">
                        Tandai sudah dibaca
                    </button>
                    <button id="deleteBtn"
                        class="w-full rounded-b-lg text-left px-4 py-2 text-sm bg-red-100 hover:bg-red-200 transition duration-200">
                        <i class="fas fa-trash me-2 text-red-600"></i><span class="text-red-500">Hapus</span>
                    </button>
                </div>
            </div>
        @empty
            <div class="px-6 py-10 text-center text-gray-400">
                Tidak ada notifikasi
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $notifications_guru->links() }}
    </div>

</div>

<script>
    let currentNotifId = null;
    let pressTimer = null;
    const menu = document.getElementById('contextMenu');
    const markBtn = document.getElementById('markAsReadBtn');
    const deleteBtn = document.getElementById('deleteBtn');

    // klik kanan
    document.addEventListener('contextmenu', function(e) {
        const notif = e.target.closest('.notif-item');
        if (!notif) return;

        e.preventDefault();
        currentNotifId = notif.dataset.id;

        menu.classList.remove('hidden');
        menu.style.left = e.pageX + 'px';
        menu.style.top = e.pageY + 'px';
    });

    // klik di luar -> tutup
    document.addEventListener('click', function() {
        menu.classList.add('hidden');
    });

    document.addEventListener('touchstart', e => {
        const item = e.target.closest('.notif-item');
        if (!item) return;

        pressTimer = setTimeout(() => {
            const touch = e.touches[0];

            e.preventDefault();
            currentNotifId = item.dataset.id;
            menu.classList.remove('hidden');
            menu.style.left = e.pageX + 'px';
            menu.style.top = e.pageY + 'px';
        }, 500);
    });

    document.addEventListener('touchend', () => {
        clearTimeout(pressTimer);
    });

    // aksi tandai dibaca
    markBtn.addEventListener('click', function() {
        if (!currentNotifId) return;

        fetch(`/notifikasi/read/${currentNotifId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(location.reload());
    });

    deleteBtn.addEventListener('click', function() {
        if (!currentNotifId) return;

        fetch(`/notifikasi/delete/${currentNotifId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(location.reload());
    });

    function tandaiSemua() {
        fetch('/notifikasi/markAll', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(res => {
            console.log(res.success);
            console.log(res.ok);
            return res.json();
        }).then(location.reload());
    }
</script>