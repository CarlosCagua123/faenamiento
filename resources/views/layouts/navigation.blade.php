<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('lotes.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Links desktop -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('lotes.index')"  :active="request()->routeIs('lotes.*')">Lotes</x-nav-link>
                    <x-nav-link :href="route('cerdos.index')" :active="request()->routeIs('cerdos.*')">Cerdos</x-nav-link>
                    <x-nav-link :href="route('faenas.index')" :active="request()->routeIs('faenas.*')">Faenas</x-nav-link>
                    <x-nav-link :href="route('reportes.index')" :active="request()->routeIs('reportes.*')">Reportes</x-nav-link>

                    @can('admin')
                        <x-nav-link :href="route('usuarios.index')" :active="request()->routeIs('usuarios.*')">
                            Usuarios
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            <!-- Dropdown usuario -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm rounded-md text-gray-500 bg-white">
                            <div class="flex items-center gap-2">
                                <span>{{ Auth::user()->name }}</span>
                                {{-- Badge de rol --}}
                                <span class="px-2 py-0.5 text-xs rounded
                                    @class([
                                        'bg-blue-100 text-blue-800' => Auth::user()->role === 'admin',
                                        'bg-green-100 text-green-800' => Auth::user()->role === 'operador',
                                        'bg-yellow-100 text-yellow-800' => Auth::user()->role === 'inspector',
                                        'bg-gray-100 text-gray-800' => !in_array(Auth::user()->role, ['admin','operador','inspector']),
                                    ])
                                ">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293l4.707 4.707 4.707-4.707 1.414 1.414L10 14.828 3.879 8.707z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @can('admin')
                            <x-dropdown-link :href="route('usuarios.index')">
                                Gestionar usuarios
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('usuarios.create')">
                                Crear usuario
                            </x-dropdown-link>
                            <div class="border-t my-1"></div>
                        @endcan

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                Cerrar sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburguesa -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-400">☰</button>
            </div>
        </div>
    </div>

    <!-- Menú responsive -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('lotes.index')"  :active="request()->routeIs('lotes.*')">Lotes</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cerdos.index')" :active="request()->routeIs('cerdos.*')">Cerdos</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('faenas.index')" :active="request()->routeIs('faenas.*')">Faenas</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('reportes.index')" :active="request()->routeIs('reportes.*')">Reportes</x-responsive-nav-link>

            @can('admin')
                <x-responsive-nav-link :href="route('usuarios.index')" :active="request()->routeIs('usuarios.*')">
                    Usuarios
                </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Datos y logout -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 flex items-center gap-2">
                    {{ Auth::user()->name }}
                    <span class="px-2 py-0.5 text-xs rounded
                        @class([
                            'bg-blue-100 text-blue-800' => Auth::user()->role === 'admin',
                            'bg-green-100 text-green-800' => Auth::user()->role === 'operador',
                            'bg-yellow-100 text-yellow-800' => Auth::user()->role === 'inspector',
                            'bg-gray-100 text-gray-800' => !in_array(Auth::user()->role, ['admin','operador','inspector']),
                        ])
                    ">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @can('admin')
                    <x-responsive-nav-link :href="route('usuarios.index')">Gestionar usuarios</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('usuarios.create')">Crear usuario</x-responsive-nav-link>
                @endcan

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Cerrar sesión
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
