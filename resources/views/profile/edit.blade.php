<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informasi Akun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-6">
                    Detail Admin / Super Admin
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-3 font-semibold text-gray-700">Username</td>
                                <td class="px-4 py-3">{{ Auth::user()->username }}</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 font-semibold text-gray-700">Role</td>
                                <td class="px-4 py-3 capitalize">{{ Auth::user()->role }}</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 font-semibold text-gray-700">Status</td>
                                <td class="px-4 py-3 capitalize">{{ Auth::user()->status }}</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 font-semibold text-gray-700">Tanggal Registrasi</td>
                                <td class="px-4 py-3">{{ Auth::user()->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 font-semibold text-gray-700">Terakhir Diperbarui</td>
                                <td class="px-4 py-3">{{ Auth::user()->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
