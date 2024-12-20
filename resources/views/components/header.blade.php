<div>
    <div class="bg-blue-900 text-white text-center py-1">Atencion a clientes: <strong class="text-green-600">800 633
            5757</strong></div>

    <header class="bg-white dark:bg-gray-800" x-data="{ open: false }">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 items-center justify-between">
                <div class="md:flex md:items-center md:gap-12">
                    <a class="block text-teal-600" href="{{ route('welcome') }}">
                        <span class="sr-only">Home</span>
                        <x-application-mark class="block h-9 max-h-[36px]" />
                    </a>
                </div>

                <div class="hidden lg:block">
                    
                </div>

                <div class="flex items-center gap-4">

                    @if (Auth::check())
                        <div class="relative mt-2 block" x-data="{ open: false }" @click.away="open = false"
                            @close.stop="open = false">
                            <button type="button"
                                class="rounded-full focus:ring-4 focus:ring-lime-300 dark:focus:ring-gray-600"
                                @click="open = ! open">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                                </svg>
                                <div
                                    class="absolute inline-flex items-center justify-center w-3 h-3 mini:w-4 mini:h-4 
                                    @switch(Auth::user()->id_tipo_usuario)
                                    {{-- administrador --}}
                                            @case(1)
                                                
                                                bg-blue-800
                                            @break

                                            {{-- cliente --}}
                                            @case(2)
                                                
                                                bg-green-500
                                            @break

                                            {{-- gestor --}}
                                            @case(3)
                                                
                                                bg-yellow-300
                                            @break

                                             {{-- interesado --}}
                                            @case(4)
                                               
                                                bg-green-500
                                            @break

                                             {{-- empleado --}}
                                            @case(5)
                                               
                                               bg-purple-800
                                            @break
                                        @endswitch
                                      rounded-full -top-0 -end-0  mini:-top-0 mini:-end-0 dark:border-gray-900">
                                </div>
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600 absolute right-[0%]"
                                style="display: none;">

                                <div class="px-4 py-3" role="none">

                                    <p class="text-sm text-gray-900 dark:text-white truncate" role="none">
                                        {{ Auth::user()->nombre }} {{ Auth::user()->ap_paterno }}
                                        {{ Auth::user()->ap_materno }}
                                    </p>
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300"
                                        role="none">
                                        {{ Auth::user()->correo }}
                                    </p>

                                </div>
                                <ul class="py-1" role="none">

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        @switch(Auth::user()->id_tipo_usuario)
                                            @case(1)
                                                {{ __('Administrador') }}
                                            @break

                                            @case(2)
                                                {{ __('Administrar cuenta') }}
                                            @break

                                            @case(3)
                                                {{ __('Gestor') }}
                                            @break

                                            @case(4)
                                                {{ __('Interesado') }}
                                            @break

                                            @case(5)
                                                {{ __('Empleado') }}
                                            @break
                                        @endswitch
                                    </div>

                                    @if (Auth::user()->id_tipo_usuario == 1 || Auth::user()->id_tipo_usuario == 3 || Auth::user()->id_tipo_usuario == 5)
                                        <li>
                                            <a @switch(Auth::user()->id_tipo_usuario)
                                            @case(1)
                                            href="{{ route('admin.administrador.panel') }}"
                                            @break  

                                            @case(3)
                                            href="{{ route('gestor.gestor.panel') }}"
                                            @break

                                            @case(5)
                                            href="{{ route('empleado.empleado.panel') }}"
                                            @break
                                            @endswitch
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                                role="menuitem">Panel</a>
                                        </li>
                                    @endif

                                    @if (Auth::user()->id_tipo_usuario == 2 || Auth::user()->id_tipo_usuario == 4)
                                        <li>
                                            <a @switch(Auth::user()->id_tipo_usuario)
                                            @case(2)
                                            href="{{ route('cliente.cliente.perfil') }}"
                                            @break

                                            @case(4)
                                            href="{{ route('interesado.interesado.perfil') }}"
                                            @break
                                            @endswitch
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                                role="menuitem">Perfil</a>
                                        </li>
                                    @endif
                                    <li>

                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                                role="menuitem">Finalizar sesión</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    @else
                        <div class="sm:flex sm:gap-4">

                            <a class="rounded-md bg-blue-900 px-5 py-2.5 text-sm font-medium text-white shadow hover:bg-lime-700"
                                href="{{ route('login') }}">
                                Ingresa
                            </a>

                            <div class="hidden sm:flex">
                                <a class="rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-lime-600 hover:bg-lime-700 hover:text-white"
                                    href="{{ route('register') }}">
                                    Registrate
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="block lg:hidden">
                        <button class="rounded bg-gray-100 p-2 text-gray-600 transition hover:text-gray-600/75"
                            @click="open = ! open" x-on:click.away="open=false">
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
                </div>
            </div>
        </div>
        <div :class="{
            'block': open,
            'hidden': !open
        }" class="hidden lg:hidden ">

            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                    {{ __('inicio') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="https://gisenalabs.com.mx/empresa/">
                    {{ __('Empresa') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="https://gisenalabs.com.mx/servicios/">
                    {{ __('Servicios') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="https://gisenalabs.com.mx/reconocimientos/">
                    {{ __('Reconocimeintos') }}
                </x-responsive-nav-link>

                <div class="border-t border-gray-200 dark:border-gray-600"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    @if (Auth::check())
                        @switch(Auth::user()->id_tipo_usuario)
                            @case(1)
                                {{ __('Administrador') }}
                            @break

                            @case(2)
                                {{ __('Administrar cuenta') }}
                            @break

                            @case(3)
                                {{ __('Gestor') }}
                            @break

                            @case(4)
                                {{ __('Interesado') }}
                            @break

                            @case(5)
                                {{ __('Empleado') }}
                            @break
                        @endswitch
                    @else
                        {{ __('GisenaLabs') }}
                    @endif
                </div>

                @if (Auth::check())
                    @switch(Auth::user()->id_tipo_usuario)
                        @case(1)
                            <x-dropdown-link href="{{ route('admin.administrador.panel') }}">
                                {{ __('Panel') }}
                            </x-dropdown-link>
                        @break

                        @case(2)
                            <x-dropdown-link href="{{ route('cliente.cliente.perfil') }}" :active="request()->routeIs('cliente.panel')">
                                {{ __('Perfil') }}
                            </x-dropdown-link>
                        @break

                        @case(3)
                            <x-dropdown-link href="{{ route('gestor.gestor.panel') }}">
                                {{ __('Panel') }}
                            </x-dropdown-link>
                        @break

                        @case(4)
                            <x-dropdown-link href="{{ route('interesado.interesado.perfil') }}">
                                {{ __('Perfil') }}
                            </x-dropdown-link>
                        @break

                        @case(5)
                            <x-dropdown-link href="{{ route('empleado.empleado.panel') }}">
                                {{ __('Panel') }}
                            </x-dropdown-link>
                        @break
                    @endswitch

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Finalizar sesión') }}
                        </x-dropdown-link>
                    </form>
                @else
                    <x-dropdown-link href="{{ route('login') }}">
                        {{ __('Inicia sesión') }}
                    </x-dropdown-link>

                    <x-dropdown-link href="{{ route('register') }}">
                        {{ __('Registrate') }}
                    </x-dropdown-link>
                @endif
            </div>
            @if (Auth::check())
                <div class="pt-4 pb-1 border-t border-lime-600 dark:border-gray-600">
                    <div class="flex items-center px-4">
                        <div>
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                {{ Auth::user()->nombre }} {{ Auth::user()->ap_paterno }}
                                {{ Auth::user()->ap_materno }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ Auth::user()->correo }}</div>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </header>
</div>
