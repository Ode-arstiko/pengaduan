<div class="">
    <div class="bg-white p-6 rounded-xl shadow-md max-w-3xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Profil</h2>

        <form action="/siswa/profile/update/{{ encrypt($user->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            <!-- Foto Profil -->
            <div class="flex flex-col items-center space-y-2">
                <div class="relative">
                    @if ($user->profile == null)
                        <img src="{{ asset('assets/profil/user.png') }}" alt="Foto Profil"
                            class="h-28 w-28 rounded-full object-cover border-4 border-blue-500 shadow-md">
                    @else
                        <img src="{{ asset('assets/profil/' . $user->profile) }}" alt="Foto Profil"
                            class="h-28 w-28 rounded-full object-cover border-4 border-blue-500 shadow-md">
                    @endif
                    <label
                        class="absolute bottom-0 right-0 bg-blue-600 text-white rounded-full p-2 cursor-pointer hover:bg-blue-700 transition">
                        <input type="file" name="profile" accept="image/*" class="hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M4 3a1 1 0 00-1 1v1h2V4h10v1h2V4a1 1 0 00-1-1H4zM3 7v10a1 1 0 001 1h12a1 1 0 001-1V7H3zm5 3a2 2 0 114 0 2 2 0 01-4 0z" />
                        </svg>
                    </label>
                </div>
                <p class="text-sm text-gray-500">Klik ikon kamera untuk ganti foto</p>
            </div>

            <!-- Nama -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukan nama lengkap..."
                    value="{{ $user->nama }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:outline-none"
                    required />
            </div>

            {{-- username --}}
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" id="nama" name="username" placeholder="Username anda..."
                    value="{{ $user->username }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:outline-none"
                    readonly />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukan email anda..."
                    value="{{ $user->email }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:outline-none" />
            </div>

            <!-- phone -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                <input type="number" id="email" name="phone" placeholder="Masukan nomor ponsel aktif..."
                    value="{{ $user->phone }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:outline-none" />
            </div>

            <!-- Password -->
            <div class="relative">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru
                    (opsional)</label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:outline-none" />
                <button type="button" onclick="togglePassword()"
                    class="absolute right-3 top-10 text-gray-500 hover:text-blue-600">
                    <svg id="eye" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg id="eye-off" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-5.523 0-10-4.477-10-10a9.961 9.961 0 011.454-5.212M3.515 3.515l16.97 16.97" />
                    </svg>
                </button>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="text-center pt-2">
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-xl transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById("password");
        const eye = document.getElementById("eye");
        const eyeOff = document.getElementById("eye-off");

        const isHidden = input.type === "password";
        input.type = isHidden ? "text" : "password";
        eye.classList.toggle("hidden", !isHidden);
        eyeOff.classList.toggle("hidden", isHidden);
    }

    document.querySelector('input[name="profile"]').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = event.target.closest('div.relative').querySelector('img');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result; // tampilkan gambar ke elemen <img>
            }

            reader.readAsDataURL(file); // baca file sebagai URL
        }
    });
</script>
