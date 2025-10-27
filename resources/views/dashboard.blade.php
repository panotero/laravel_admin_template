<x-app-layout>
    <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
        <div class="flex h-screen">

            <!-- Mobile Toggle Button -->
            <button id="sidebar-toggle" class="lg:hidden absolute top-2 left-2 p-2 bg-gray-800 text-white rounded">
                ☰
            </button>
            <!-- Sidebar (Collapsible) -->
            <aside id="sidebar-wrapper"
                class="bg-white dark:bg-gray-900 shadow-lg w-64 lg:w-64 fixed lg:static left-0 top-0 h-full transform -translate-x-full lg:translate-x-0 transition-all duration-300 z-40">


                <nav id="sidebar-menu" class="p-4 space-y-2 text-black dark:text-white font-semibold">
                    <!-- JS will populate here -->
                </nav>
            </aside>

            <!-- Overlay for mobile -->
            <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-30 lg:hidden"></div>


        </div>



        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow px-6 py-4 flex justify-between items-center">
                <h2 id="page-title" class="text-xl font-semibold text-gray-800 dark:text-gray-200 max-lg:pl-5">
                    Dashboard
                </h2>
                <div>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="text-gray-800 dark:text-gray-200">Menu</button>
                        </x-slot>
                        <x-slot name="content">
                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>

            <!-- Content Area -->
            <main id="content" class="flex-1 overflow-y-auto text-gray-800 dark:text-gray-200 ">
            </main>
        </div>
    </div>

</x-app-layout>
