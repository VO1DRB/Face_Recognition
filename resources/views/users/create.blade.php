<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Tambah User</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded-lg max-w-md mx-auto">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block">Username</label>
                <input type="text" name="username" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block">Role</label>
                <select name="role" class="w-full border rounded p-2">
                    <option value="superadmin">SuperAdmin</option>
                    <option value="admin">Admin</option>
                    <option value="karyawan">Karyawan</option>
                    <option value="magang">Magang</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block">Password</label>
                <input type="password" name="password" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block">Data Wajah</label>
                <button type="button" id="scanFaceBtn" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Scan Wajah
                </button>
                <input type="hidden" name="encoding" id="encoding">
                <p id="scanStatus" class="text-sm text-gray-600 mt-2"></p>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>

    <script>
        document.getElementById('scanFaceBtn').addEventListener('click', async () => {
            document.getElementById('scanStatus').textContent = 'Scanning...';
            try {
                let res = await fetch("{{ route('users.scan-face') }}", {method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});
                let data = await res.json();
                if (data.success) {
                    document.getElementById('encoding').value = data.encoding;
                    document.getElementById('scanStatus').textContent = 'Wajah berhasil discan!';
                } else {
                    document.getElementById('scanStatus').textContent = 'Gagal scan wajah!';
                }
            } catch (err) {
                document.getElementById('scanStatus').textContent = 'Error komunikasi dengan server!';
            }
        });
    </script>
</x-app-layout>
