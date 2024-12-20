<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end gap-3 w-full">
                <a href="" class="max-md:hidden">
                    <x-application-mark class="block h-9 w-auto" />
                </a>
                {{-- =========================================Menu Responsive============================ --}}
                <div class="md:hidden ml-3 w-full">
                    <header x-data="{ open: false }"
                        class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 w-full overflow-y-auto">
                        <div class="flex gap-3 justify-between">
                            <a href="">
                                <x-application-mark class="block h-9 w-auto" />
                            </a>
                            <button @click="open = ! open" x-on:click.away="open=false"
                                class="bg-lime-600 p-2 rounded-md text-white dark:text-white dark:hover:text-gray-400 hover:bg-blue-800 dark:hover:bg-gray-900 focus:outline-none focus:bg-blue-800 dark:focus:bg-gray-900 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                                <svg class="h-3 w-3 mini:h-6 mini:w-6" stroke="currentColor" fill="none"
                                    viewBox="0 0 24 24">
                                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div :class="{
                            'block': open,
                            'hidden': !open
                        }"
                            class="hidden md:hidden ">

                            <div class="pt-2 pb-3 space-y-1">
                                @if (Auth::check())
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Email') }}
                                    </div>
                                    <div class="block px-4 text-base text-gray-400">
                                        {{ Auth::user()->correo }}
                                    </div>
                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>
                                @endif
                                <ul class="space-y-2 font-medium">
                                    <li>
                                        <x-responsive-nav-link href="{{ route('admin.administrador.panel') }}"
                                            :active="request()->routeIs('admin.administrador.panel')" wire:navigate.hover>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-layout-collage">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                                <path d="M10 4l4 16" />
                                                <path d="M12 12l-8 2" />
                                            </svg>
                                            <span class="ms-3">{{ __('Dashboard') }}</span>
                                        </x-responsive-nav-link>
                                    </li>
                                    <li>

                                        <x-responsive-nav-link href="{{ route('admin.administrador.ordenes') }}"
                                            :active="request()->routeIs('admin.catalogos.*')" wire:navigate.hover>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-files">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                                                <path
                                                    d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                                                <path
                                                    d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                                            </svg>
                                            <span class="ms-3">{{ __('Ordenes Servicio') }}</span>
                                        </x-responsive-nav-link>
                                    </li>
                                    <li>
                                        <x-responsive-nav-link href="{{ route('admin.catalogos.index') }}"
                                            :active="request()->routeIs('admin.catalogos.*')" wire:navigate.hover>

                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="currentColor"
                                                class="icon icon-tabler icons-tabler-filled icon-tabler-category">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M10 3h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z" />
                                                <path
                                                    d="M20 3h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z" />
                                                <path
                                                    d="M10 13h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z" />
                                                <path
                                                    d="M17 13a4 4 0 1 1 -3.995 4.2l-.005 -.2l.005 -.2a4 4 0 0 1 3.995 -3.8z" />
                                            </svg>
                                            <span class="ms-3">{{ __('Catalogos') }}</span>
                                        </x-responsive-nav-link>
                                    </li>
                                </ul>
                                @if (Auth::check())
                                    @if (Auth::user()->id_tipo_usuario == 1)
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Administrador') }}
                                        </div>
                                        <div class="border-t border-gray-200 dark:border-gray-600"></div>
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <x-dropdown-link href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </header>
                </div>
                {{-- ================================================================================================= --}}
            </div>
            {{-- =========================================Drop dawon============================ --}}
            <div class="ms-3 relative max-md:hidden mt-2">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <button type="button"
                                class="inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                {{-- Perfile --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                </svg>
                            </button>
                        </span>
                    </x-slot>

                    <x-slot name="content">
                        @if (Auth::check())
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Email') }}
                            </div>
                            <div class="block px-4 py-2 text-base text-gray-400">
                                {{ Auth::user()->correo }}
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Administrar cuenta') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}" wire:navigate.hover>
                                {{ __('Profile') }}
                            </x-dropdown-link>


                            <div class="border-t border-gray-200 dark:border-gray-600"></div>


                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>
            {{-- ================================================================================================= --}}
        </div>
    </div>
</nav>

{{-- ================================= Menu ==============================  --}}
@if (Auth::user()->id_tipo_usuario == 1)
    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <x-nav-link href="{{ route('admin.administrador.panel') }}" :active="request()->routeIs('admin.administrador.*')" wire:navigate.hover>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-layout-collage">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                            <path d="M10 4l4 16" />
                            <path d="M12 12l-8 2" />
                        </svg>
                        <span class="ms-3">{{ __('Dashboard') }}</span>
                    </x-nav-link>
                    @if (Route::is('admin.administrador.panel') || Route::is('admin.administrador.*'))
                        @livewire('componentes.panel')
                    @endif
                </li>
                {{-- <li>
                <x-nav-link href="{{ route('admin.administrador.ordenes') }}" :active="request()->routeIs('admin.administrador.ordenes')" wire:navigate.hover>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-files">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                        <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                    </svg>
                    <span class="ms-3">{{ __('Órdenes Servicio') }}</span>
                </x-nav-link>
            </li> --}}
                <li>

                    <x-nav-link href="{{ route('admin.catalogos.index') }}" :active="request()->routeIs('admin.catalogos.*')" wire:navigate.hover>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-category">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 3h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z" />
                            <path d="M20 3h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z" />
                            <path d="M10 13h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z" />
                            <path d="M17 13a4 4 0 1 1 -3.995 4.2l-.005 -.2l.005 -.2a4 4 0 0 1 3.995 -3.8z" />
                        </svg>
                        <span class="ms-3">{{ __('Catalogos') }}</span>
                    </x-nav-link>
                    @if (Route::is('admin.catalogos.*') || Route::is('admin.direcciones.*'))
                        @livewire('componentes.catalogos')
                    @endif
                </li>
            </ul>
        </div>
    </aside>
@elseif(Auth::user()->id_tipo_usuario == 2)
    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <x-nav-link href="{{ route('admin.administrador.panel') }}" :active="request()->routeIs('admin.administrador.panel')" wire:navigate.hover>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-layout-collage">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                            <path d="M10 4l4 16" />
                            <path d="M12 12l-8 2" />
                        </svg>
                        <span class="ms-3">{{ __('Dashboard') }}</span>
                    </x-nav-link>
                    @if (Route::is('admin.administrador.panel') || Route::is('admin.gestores.*'))
                        @livewire('componentes.panel')
                    @endif
                </li>
                {{-- <li>
                <x-nav-link href="{{ route('admin.administrador.ordenes') }}" :active="request()->routeIs('admin.administrador.ordenes')" wire:navigate.hover>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-files">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                        <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                    </svg>
                    <span class="ms-3">{{ __('Órdenes Servicio') }}</span>
                </x-nav-link>
            </li> --}}
                <li>

                    <x-nav-link href="{{ route('admin.catalogos.index') }}" :active="request()->routeIs('admin.catalogos.*')" wire:navigate.hover>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-category">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 3h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z" />
                            <path d="M20 3h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z" />
                            <path d="M10 13h-6a1 1 0 0 0 -1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1 -1v-6a1 1 0 0 0 -1 -1z" />
                            <path d="M17 13a4 4 0 1 1 -3.995 4.2l-.005 -.2l.005 -.2a4 4 0 0 1 3.995 -3.8z" />
                        </svg>
                        <span class="ms-3">{{ __('Catalogos') }}</span>
                    </x-nav-link>
                    @if (Route::is('admin.catalogos.*') || Route::is('admin.direcciones.*'))
                        @livewire('componentes.catalogos')
                    @endif
                </li>
            </ul>
        </div>
    </aside>
@elseif(Auth::user()->id_tipo_usuario == 3)
    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <x-nav-link href="{{ route('gestor.panel') }}" :active="request()->routeIs('gestor.panel')" wire:navigate.hover>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-layout-collage">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                            <path d="M10 4l4 16" />
                            <path d="M12 12l-8 2" />
                        </svg>
                        <span class="ms-3">{{ __('Dashboard') }}</span>
                    </x-nav-link>
                    @if (Route::is('gestor.panel') || Route::is('gestor.gestores.*'))
                    @endif
                </li>
                {{-- <li>
                <x-nav-link href="{{ route('admin.administrador.ordenes') }}" :active="request()->routeIs('admin.administrador.ordenes')" wire:navigate.hover>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-files">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                        <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                    </svg>
                    <span class="ms-3">{{ __('Órdenes Servicio') }}</span>
                </x-nav-link>
            </li> --}}
            </ul>
        </div>
    </aside>
@elseif(Auth::user()->id_tipo_usuario == 4)
    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <x-nav-link href="{{ route('interesado.panel') }}" :active="request()->routeIs('interesado.panel')" wire:navigate.hover>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-layout-collage">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                            <path d="M10 4l4 16" />
                            <path d="M12 12l-8 2" />
                        </svg>
                        <span class="ms-3">{{ __('Dashboard') }}</span>
                    </x-nav-link>
                </li>
                {{-- <li>
                <x-nav-link href="{{ route('admin.administrador.ordenes') }}" :active="request()->routeIs('admin.administrador.ordenes')" wire:navigate.hover>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-files">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                        <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                    </svg>
                    <span class="ms-3">{{ __('Órdenes Servicio') }}</span>
                </x-nav-link>
            </li> --}}
            </ul>
        </div>
    </aside>
@endif
{{-- ================================================================================================= --}}

{{-- =============================================== Contenido =======================================  --}}
<div class="p-4 pt-8 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700  bg-white dark:bg-gray-800">
        {{ $content }}
    </div>
</div>
{{-- ================================================================================================= --}}
