<div class="flex justify-end items-center bg-white shadow p-2">
    <!-- Notification Button -->
    <div x-data="{ open: false }" class="relative mr-4">
        <button @click="open = !open" class="p-2 rounded-full bg-gray-100 hover:bg-gray-200">
            🔔
        </button>
        <div x-show="open" class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded p-4">
            <p class="text-gray-500">No notifications at the moment.</p>
        </div>
    </div>

    <!-- Account Dropdown -->
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
            👤
        </button>
        <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded p-2">
            <a href="{{ route('password.change') }}" class="block px-4 py-2 hover:bg-gray-100">Change Password</a>
            <a href="{{ route('settings') }}" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
            </form>
        </div>
    </div>
</div>
