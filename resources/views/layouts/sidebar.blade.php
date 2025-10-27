@php
    $menus = \App\Models\NavMenu::all();
    $userRole = auth()->user()->role ?? 'guest';
@endphp

<aside class="w-64 bg-gray-800 text-white h-screen p-4">
    <nav>
        <ul>
            @foreach ($menus as $menu)
                @if (in_array($userRole, json_decode($menu->allowed_roles)))
                    <li class="mb-2">
                        <a href="{{ url($menu->link) }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700">
                            <i class="{{ $menu->icon }}"></i>
                            {{ $menu->title }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
</aside>
