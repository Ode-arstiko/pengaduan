@if (session('sendSuccess'))
    <div class="px-4 py-3 bg-gradient-to-r from-green-500 to-green-400 mb-3 text-white font-semibold rounded-lg">
        {{ session('sendSuccess') }}
    </div>
@endif
@if (session('sendError'))
    <div class="px-4 py-3 bg-gradient-to-r from-red-500 to-red-400 mb-3 text-white font-semibold rounded-lg">
        {{ session('sendError') }}
    </div>
@endif
<div class="w-full bg-white p-4 rounded-lg shadow-md border border-gray-200">
    <div class="text-center mb-4">
        <i class="fas fa-clipboard text-blue-600 text-2xl mx-auto mb-1"></i>
        <h2 class="text-lg font-semibold text-gray-800">Form Aduan</h2>
    </div>

    <form action="/laporan/send" class="space-y-3" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Judul & Tujuan Aduan dalam satu baris -->
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Judul -->
            <div class="flex-1">
                <label for="judul" class="block text-sm font-medium text-gray-600 mb-1">Judul</label>
                <input type="text" id="judul" name="title" value="{{ old('title') }}"
                    placeholder="Judul singkat aduan (30 karakter)"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring focus:ring-blue-200" />
                @error('title')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tujuan Aduan -->
            <div class="flex-1">
                <label for="jenis" class="block text-sm font-medium text-gray-600 mb-1">Tujuan Aduan</label>
                <select id="jenis" name="target_user_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring focus:ring-blue-200" required>
                    <option value="" selected disabled>-- Pilih --</option>
                    @foreach ($sendto as $sen)
                        <option value="{{ $sen->id }}">{{ $sen->nama }} - @if ($sen->role == 'kepala-sekolah')
                                Kepala Sekolah
                            @elseif($sen->role == 'waka-kesiswaan')
                                Waka Kesiswaan
                            @elseif($sen->role == 'waka-kurikulum')
                                Waka Kurikulum
                            @elseif($sen->role == 'BK')
                                BK
                            @elseif($sen->role == 'tata-usaha')
                                Tata Usaha
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Isi Aduan -->
        <div>
            <label for="aduan" class="block text-sm font-medium text-gray-600 mb-1">Isi Aduan</label>
            <textarea id="aduan" name="description" rows="2" placeholder="Tuliskan aduan singkat..."
                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm resize-none focus:outline-none focus:ring focus:ring-blue-200">{{ old('description') }}</textarea>
        </div>

        <!-- Upload Foto -->
        <div>
            <label for="foto" class="block text-sm font-medium text-gray-600 mb-1">
                Upload Foto (Bisa lebih dari satu)
            </label>

            <input type="file" accept="image/*" id="foto" name="photos[]" multiple
                class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg bg-white
                file:mr-3 file:py-2 file:px-4
                file:rounded-md file:border-0 file:text-sm file:font-medium
                file:bg-blue-50 file:text-blue-700
                hover:file:bg-blue-100 transition duration-200" />
        </div>

        <!-- PREVIEW IMAGE -->
        <div id="imagePreviewContainer" class="flex gap-3 mt-2 hidden flex-wrap">
        </div>


        <!-- Tombol -->
        <div class="text-right pt-2">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-md transition">
                Kirim
            </button>
        </div>
    </form>
</div>
<script>
    const inputFile = document.getElementById('foto');
    const previewContainer = document.getElementById('imagePreviewContainer');
    let selectedFiles = [];

    inputFile.addEventListener('change', function() {
        previewContainer.innerHTML = '';
        selectedFiles = Array.from(this.files);

        if (selectedFiles.length > 0) {
            previewContainer.classList.remove('hidden');
        } else {
            previewContainer.classList.add('hidden');
        }

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const wrapper = document.createElement('div');
                wrapper.className =
                    'relative w-24 h-24 rounded-lg overflow-hidden shadow';

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
                            hover:bg-red-500 hover:text-white transition">
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

        inputFile.dispatchEvent(new Event('change'));
    }
</script>
