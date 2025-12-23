<div class="w-full mx-auto bg-white shadow-md rounded-lg p-8 mt-10">
    <h1 class="text-2xl font-bold text-gray-700 mb-6">Tambah Data Guru</h1>

    <form action="/admin/kelola-guru/store" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Nama -->
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                class="mt-1 block w-full rounded-md border border-gray-300 py-1 px-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Username -->
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}" required
                class="mt-1 block w-full rounded-md border border-gray-300 py-1 px-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('username') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" required
                class="mt-1 block w-full rounded-md border border-gray-300 py-1 px-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Jabatan</label>
            <select name="role" id="role" required
                class="mt-1 block w-full rounded-md border border-gray-300 py-1 px-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="" disabled selected>-- Pilih Role --</option>
                <option value="kepala-sekolah" {{ old('role') == 'kepala-sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                <option value="waka-kesiswaan" {{ old('role') == 'waka-kesiswaan' ? 'selected' : '' }}>Waka Kesiswaan</option>
                <option value="waka-kurikulum" {{ old('role') == 'waka-kurikulum' ? 'selected' : '' }}>Waka Kurikulum</option>
                <option value="BK" {{ old('role') == 'BK' ? 'selected' : '' }}>BK</option>
                <option value="tata-usaha" {{ old('role') == 'tata-usaha' ? 'selected' : '' }}>Tata Usaha</option>
            </select>
            @error('role') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email (Opsional)</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="mt-1 block w-full rounded-md border border-gray-300 py-1 px-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Phone -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Nomor HP (Opsional)</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                class="mt-1 block w-full rounded-md border border-gray-300 py-1 px-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Profil -->
        <div>
            <label for="profil" class="block text-sm font-medium text-gray-700">Foto Profil</label>

            {{-- foto default --}}
            <div class="mt-2">
                <img id="previewOld" src="{{ asset('assets/profil/user.png') }}" alt="Foto Default"
                    class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow-sm">
            </div>

            <!-- Preview Foto Baru -->
            <div class="mt-3">
                <img id="previewNew" src="#" alt="Preview Foto Baru"
                    class="hidden w-24 h-24 rounded-full object-cover border border-gray-300 shadow-sm">
            </div>

            <!-- Input Ganti Foto -->
            <input type="file" name="profile" id="profil" accept="image/*"
                class="mt-3 block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500"
                onchange="previewImage(event)">

            @error('profile')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit"
                class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const previewNew = document.getElementById('previewNew');
        const previewOld = document.getElementById('previewOld');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                previewNew.src = e.target.result;
                previewNew.classList.remove('hidden');
                previewOld.classList.add('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            previewNew.src = "#";
            previewNew.classList.add('hidden');
            previewOld.classList.remove('hidden');
        }
    }
</script>