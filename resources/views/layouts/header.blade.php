<main class="flex-1 ml-0 sm:ml-64 p-6">
    <div class="{{ $title == 'Riwayat_detail' ? '' : 'sticky top-6 z-30' }}">
        <div
            class="flex shadow-lg border border-teal-600 justify-between items-center bg-gradient-to-tl from-blue-700 to-teal-400 text-white px-6 py-4 rounded-lg shadow mb-6">
            <div class="flex items-center space-x-4">
                <button id="toggleSidebar" class="sm:hidden p-2 text-white rounded-lg hover:bg-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="breadcrumb hidden sm:flex space-x-2 items-center">
                    <a href="#"
                        class="text-2xl text-white font-semibold">{{ $title == 'Riwayat_detail' ? 'Detail Riwayat' : $title }}</a>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <button id="dropdownNotificationButton"
                    class="relative inline-flex items-center text-sm font-medium text-center text-gray-100 hover:text-gray-100 focus:outline-none light:hover:text-white light:text-gray-400"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <div
                        class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5 light:border-gray-900">
                    </div>
                </button>

                <div id="dropdownNotification"
                    class="absolute top-20 right-0 sm:top-5 sm:right-[120px] z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow-lg light:bg-gray-800 light:divide-gray-700">
                    <div
                        class="block px-4 py-2 font-medium text-center text-white rounded-t-lg bg-gradient-to-tl from-blue-500 to-blue-400">
                        Notifications
                    </div>
                    <div class="divide-y divide-gray-100 light:divide-gray-700">

                        @foreach ($notifications as $notif)
                            @if ($notif->report_id == null)
                                <a
                                    href="{{ $notif->chat->receiver->role == 'siswa' ? '/riwayat-laporan/detail/' . encrypt($notif->chat->report_id) : '/guru/riwayat/detail/' . encrypt($notif->chat->report_id) }}">
                                    <div class="flex px-4 py-3 hover:bg-gray-100 light:hover:bg-gray-700">
                                        <div class="shrink-0 relative">
                                            <i class="fas fa-envelope text-black text-lg"></i>
                                        </div>
                                        <div class="w-full ps-3">
                                            <div class="text-gray-500 text-sm light:text-gray-400">
                                                <span
                                                    class="font-semibold text-gray-900 light:text-white">{{ $notif->title }}</span>
                                            </div>
                                            <span class="text-gray-400 text-xs light:text-white">
                                                {{ $notif->chat->sender->nama }} - {{ $notif->chat->message }}
                                            </span>
                                            <div class="text-xs text-blue-600 light:text-blue-500">
                                                {{ substr($notif->created_at, 0, 10) }},
                                                {{ substr($notif->created_at, 11, 5) }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <a
                                    href="{{ $notif->report->status == 'baru' ? '/guru/tanggapan' : '/guru/riwayat/detail/' . encrypt($notif->report_id) }}">
                                    <div class="flex px-4 py-3 hover:bg-gray-100 light:hover:bg-gray-700">
                                        <div class="shrink-0 relative">
                                            @if ($notif->report_photo)
                                                <img class="rounded-full object-cover w-11 h-11"
                                                    src="/assets/photos/{{ $notif->report_photo->photo_url }}"
                                                    alt="Logo SMKN 2">
                                            @else
                                                <img class="rounded-full object-cover w-11 h-11"
                                                    src="/assets/logo/logo-smkn2kra.webp" alt="Logo SMKN 2">
                                            @endif
                                            <div
                                                class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-500 border border-white rounded-full light:border-gray-800">
                                                <svg class="w-2 h-2 text-white" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 18 18">
                                                    <path
                                                        d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                                                    <path
                                                        d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="w-full ps-3">
                                            <div class="text-gray-500 text-sm light:text-gray-400">
                                                <span
                                                    class="font-semibold text-gray-900 light:text-white">{{ $notif->title }}</span>
                                            </div>
                                            <span class="text-gray-400 text-xs light:text-white">
                                                {{ $notif->report->reporter->nama }} - {{ $notif->report->title }}
                                            </span>
                                            <div class="text-xs text-blue-600 light:text-blue-500">
                                                {{ substr($notif->created_at, 0, 10) }},
                                                {{ substr($notif->created_at, 11, 5) }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach

                    </div>
                    <a href="{{ Auth::user()->role == 'siswa' ? '/siswa/notifikasi' : '/guru/notifikasi' }}"
                        class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 light:bg-gray-800 light:hover:bg-gray-700 light:text-white">
                        <div class="inline-flex items-center ">
                            <svg class="w-4 h-4 me-2 text-gray-500 light:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                                <path
                                    d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                            </svg>
                            View all
                        </div>
                    </a>
                </div>

                <div class="relative">
                    <button onclick="toggleDropdown()"
                        class="p-1 rounded-full hover:ring-2 hover:ring-white transition">
                        @if (Auth::user()->profile == null)
                            <div
                                class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-semibold">
                                {{ getInitials(Auth::user()->nama) }}
                            </div>
                        @else
                            <img src="{{ asset('assets/profil/' . Auth::user()->profile) }}" alt="Profil"
                                class="h-8 w-8 rounded-full object-cover border-2 border-white shadow" />
                        @endif
                    </button>

                    <div id="dropdown-menu"
                        class="absolute right-0 mt-2 w-48 bg-white text-gray-700 rounded-xl shadow-lg hidden z-50">
                        <div class="flex flex-col items-center py-4 px-4">
                            @if (Auth::user()->profile == null)
                                <div
                                    class="w-16 h-16 rounded-full bg-blue-500 text-white flex items-center justify-center text-xl font-semibold">
                                    {{ getInitials(Auth::user()->nama) }}
                                </div>
                            @else
                                <div class="w-16 h-16 rounded-full bg-gray-200 bg-cover bg-center"
                                    style="background-image: url({{ asset('assets/profil/' . Auth::user()->profile) }});">
                                </div>
                            @endif
                            <p class="mt-2 font-semibold text-green-600">{{ Auth::user()->nama }}</p>
                        </div>

                        <hr class="border-gray-200" />

                        <a href="/siswa/profile" class="block px-4 py-2 hover:bg-blue-50 text-center">Edit
                            Profil</a>
                        <a href="/logout" class="block px-4 py-2 hover:bg-blue-50 text-center text-red-500">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
