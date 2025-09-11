<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Detail User</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded-lg max-w-md mx-auto">
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
        <p><strong>Status:</strong> {{ ucfirst($user->status) }}</p>
        <p><strong>Last Login:</strong> {{ $user->last_login ?? '-' }}</p>
    </div>
</x-app-layout>
