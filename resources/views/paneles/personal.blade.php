<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (Auth::check())
            @switch(Auth::user()->tipo_usuario_id)
                {{-- 52 characters --}}
                @case(1)
                    Administrador
                @break

                @case(3)
                    Gestor
                @break

                @default
                    Personal
            @endswitch
        @else
            Usuario no identificado
        @endif | @yield('titulo')
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        .arrow .list_arrow {
            transform: rotate(90deg);
        }

        .list_arrow {
            transition: transform .3s;
        }

        .sidebar {
            scrollbar-width: none;
            overflow-y: scroll;
            overflow-x: hidden;
            scrollbar-color: #ffffff rgba(255, 255, 255, 0);
        }

        .sidebar:hover {
            scrollbar-width: thin;
        }

        /* loader */
        .lds-dual-ring,
        .lds-dual-ring:after {
            box-sizing: border-box;
        }

        .lds-dual-ring {
            display: inline-block;
            width: 96px;
            height: 96px;
        }

        .lds-dual-ring:after {
            content: "";
            display: block;
            width: 80px;
            height: 80px;
            margin: 8px;
            border-radius: 50%;
            border: 6.4px solid currentColor;
            border-color: blue transparent blue transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .preloader {
            background-color: rgb(19, 35, 73);
            position: fixed;
            left: 0;
            right: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        .preloader_box {
            position: relative;
        }

        .preloader_img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 45px;
            height: 45px;
        }

        .hidden {
            overflow: hidden;
        }

        .contenedor {
            scrollbar-gutter: stable;
            scrollbar-width: none;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .logo {
            transition: opacity 0.3s ease-in-out;
        }
    </style>
</head>

<body class="font-sans antialiased">

    <div class="preloader" id="onload">
        <div class="preloader_box">
            <img src="{{ asset('images/G_Logo.webp') }}" alt="" class="preloader_img">
            <div class="lds-dual-ring"></div>
        </div>
    </div>

    <nav id="nav" x-data="data()" style="transition: margin-left 0.5s;"
        class="fixed top-0 left-0 right-0 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 md:ml-[250px] ">
        <div class="px-2 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">

                <div class="flex items-center justify-start dark:text-gray-200">
                    <button @click="public()"
                        class=" p-1 rounded-lg focus:ring-2 focus:ring-gray-200 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <svg class="h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    {{-- <div class="ml-3">
                        <a class="hover:text-lime-600 text-blue-900"
                            @if (Auth::check()) @switch(Auth::user()->tipo_usuario_id)
                        @case(1)
                            href="{{ route('admin.administrador.panel') }}"
                        @break

                        @case(3)
                             href="{{ route('gestor.gestor.panel') }}"
                        @break

                        @case(5)
                             href="{{ route('empleado.empleado.panel') }}"
                        @break

                        @default
                        href="{{ route('welcome') }}"
                    @endswitch
                @else
                    href="{{ route('welcome') }}" @endif>
                            Principal</a>
                    </div> --}}
                </div>

                <div class="flex items-center">
                    <div class="relative mt-2 block" x-data="{ open: false }" @click.away="open = false"
                        @close.stop="open = false">
                        <button type="button"
                            class="rounded-full focus:ring-4 focus:ring-lime-300 dark:focus:ring-gray-600"
                            @click="open = ! open">
                            <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960"
                                width="36px" class="fill-black dark:fill-white">
                                <path
                                    d="M227.04-264.95q58.84-41.85 120.85-64.7 62.02-22.85 132.2-22.85 70.18 0 132.7 23.09 62.53 23.09 120.84 64.54 40.44-49.91 58.88-102.74 18.43-52.84 18.43-112.39 0-139.76-95.58-235.35t-235.33-95.59q-139.75 0-235.36 95.59-95.61 95.59-95.61 235.35 0 59.46 18.65 112.26 18.65 52.79 59.33 102.79Zm252.84-179.88q-59.04 0-99.25-40.32-40.22-40.32-40.22-99.24 0-58.93 40.34-99.24 40.34-40.31 99.37-40.31 59.04 0 99.25 40.43 40.22 40.44 40.22 99.37 0 58.92-40.34 99.11-40.34 40.2-99.37 40.2Zm.33 371.53q-83.9 0-158.08-31.99-74.17-31.98-129.51-87.32-55.34-55.33-87.33-129.37Q73.3-396.02 73.3-480.2q0-84 32.02-157.94t87.31-129.23q55.29-55.29 129.33-87.39 74.05-32.1 158.24-32.1 84 0 157.94 32.1t129.23 87.39q55.29 55.29 87.39 129.27 32.1 73.99 32.1 157.89 0 83.9-32.1 158.09-32.1 74.2-87.39 129.49-55.29 55.29-129.27 87.31Q564.11-73.3 480.21-73.3Zm-.21-75.76q53.46 0 102.85-15.31 49.39-15.32 96.39-50.85-47.32-33.27-96.69-50.47-49.36-17.19-102.55-17.19t-102.43 17.19q-49.25 17.2-96.57 50.47 47 35.53 96.27 50.85 49.27 15.31 102.73 15.31Zm0-365.55q30.52 0 50.13-19.52 19.61-19.52 19.61-50.14 0-30.61-19.61-50.26-19.61-19.64-50.13-19.64-30.52 0-50.13 19.64-19.61 19.65-19.61 50.26 0 30.62 19.61 50.14T480-514.61Zm0-69.74Zm.24 368.46Z" />
                            </svg>
                            <div
                                class="absolute inline-flex items-center justify-center w-3 h-3 mini:w-4 mini:h-4 
                                    @switch(Auth::user()->tipo_usuario_id)
                                    {{-- administrador --}}
                                            @case(1) 
                                                bg-blue-800
                                            @break
                                            {{-- gestor --}}
                                            @case(3)
                                                
                                                bg-yellow-300
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
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ Auth::user()->email }}
                                </p>

                            </div>
                            <ul class="py-1" role="none">

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    @switch(Auth::user()->tipo_usuario_id)
                                        @case(1)
                                            {{ __('Administrador') }}
                                        @break

                                        @case(3)
                                            {{ __('Gestor') }}
                                        @break

                                        @case(5)
                                            {{ __('Empleado') }}
                                        @break

                                        @default
                                            {{ __('Usuario no identificado') }}
                                    @endswitch
                                </div>

                                @if (Auth::user()->tipo_usuario_id == 1 || Auth::user()->tipo_usuario_id == 3 || Auth::user()->tipo_usuario_id == 5)
                                    <li>
                                        <a @switch(Auth::user()->tipo_usuario_id)
                                            @case(1)
                                            {{-- href="{{ route('admin.perfil.show') }}" --}}
                                            @break  

                                             @default

                                             href="{{ route('welcome') }}"
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
                </div>

            </div>
        </div>
    </nav>

    {{-- sidebar --}}
    <aside id="aside" style="transition: width 0.5s, transform 0.5s;"
        class="z-20 fixed top-0 left-0 w-[250px] h-screen bg-zinc-700 pb-5 pl-[15px] pr-[15px] -translate-x-full overflow-hidden  contenedor  md:translate-x-0 md:hover:w-[250px]  dark:bg-gray-800">

        {{-- Title page --}}
        {{-- <div class="aside_section-title bg-zinc-700 dark:bg-gray-800">
            <img src="{{ asset('images/Gisena_Logo.webp') }}" alt="" class="logo" id="LogoGisena">
        </div> --}}

        <div class="aside_section-title bg-zinc-700 dark:bg-gray-800">
            <img src="{{ asset('images/G_Logo.webp') }}" alt="" class="list_image">
            <span class="text-2xl ml-[15px] text-slate-100">Gisenalabs</span>
        </div>



        {{-- user type  --}}
        <div class="aside_section mt-4">
            <img src="{{ asset('images/user.svg') }}" alt="" class="list_image">
            <span class="text-sm ml-[15px] text-slate-100">
                @if (Auth::check())
                    @switch(Auth::user()->tipo_usuario_id)
                        {{-- 52 characters --}}
                        @case(1)
                            Administrador
                        @break

                        @case(2)
                            Empleado
                        @break

                        @default
                            Personal
                    @endswitch
                @else
                    Usuario no identificado
                @endif
            </span>
        </div>
        {{-- Links --}}
        <div class="w-full">

            <nav class="mt-10">
                <ul>

                    {{-- dashboard --}}
                    <li class="link">
                        <a @if (Auth::check()) {{--  --}}
                            @switch(Auth::user()->id_tipo_usuario)
                        @case(1)
                            href="{{ route('admin.administrador.panel') }}"
                        @break

                        @case(2)
                             href="{{ route('empleado.empleado.panel') }}"
                        @break

                        @default
                        href="{{ route('welcome') }}"
                    @endswitch
                @else
                    href="{{ route('welcome') }}" 
                    {{--  --}} @endif
                            class="list_item {{ request()->routeIs('*.panel') ? 'bg-lime-600' : '' }}">
                            <img src="{{ asset('images/dashboard.svg') }}" alt="" class="list_image">
                            <span class="list_span">Principal</span>
                        </a>
                    </li>
                    {{-- links user type --}}
                    @if (Auth::check())
                        @switch(Auth::user()->tipo_usuario_id)
                            @case(1)
                                <li class="mt-3 link">
                                    <div
                                        class="list_item list_button {{ request()->routeIs('admin.catalogos.*') ? 'bg-lime-600' : '' }}">
                                        <img src="{{ asset('images/catalogo.svg') }}" alt="" class="list_image">
                                        <span class="list_span">Catálogos</span>
                                        <img src="{{ asset('images/arrow.svg') }}" alt=""
                                            class="list_arrow h-8 ml-auto">
                                    </div>

                                    <ul class="h-0">
                                        @foreach ($rutas as $ruta)
                                            @if ($ruta->tipo_ruta == 1)
                                                <li class="">
                                                    <div class="h-1"></div>
                                                    <a href="{{ route($ruta->route) }}"
                                                        class="list_item {{ request()->routeIs($ruta->route) ? 'link_select' : '' }} ">
                                                        <img src="{{ asset('images/option.svg') }}" alt=""
                                                            class="list_image">
                                                        <span class="list_span-aside">{{ $ruta->nombre }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="mt-3 link">
                                    <div
                                        class="list_item list_button {{ request()->routeIs('admin.inventarios.*') ? 'bg-lime-600' : '' }}">
                                        <img src="{{ asset('images/inventario.svg') }}" alt="" class="list_image">
                                        <span class="list_span">Inventarios</span>
                                        <img src="{{ asset('images/arrow.svg') }}" alt=""
                                            class="list_arrow h-8 ml-auto">
                                    </div>

                                    <ul class="h-0">
                                        @foreach ($rutas as $ruta)
                                            @if ($ruta->tipo_ruta == 2)
                                                <li class="">
                                                    <div class="h-1"></div>
                                                    <a href="{{ route($ruta->route) }}"
                                                        class="list_item {{ request()->routeIs($ruta->route) ? 'link_select' : '' }} ">
                                                        <img src="{{ asset('images/option.svg') }}" alt=""
                                                            class="list_image">
                                                        <span class="list_span-aside">{{ $ruta->nombre }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="mt-3 link">
                                    <div
                                        class="list_item list_button {{ request()->routeIs('admin.registros.*') || request()->routeIs('admin.empleados.*') ? 'bg-lime-600' : '' }}">
                                        <img src="{{ asset('images/registro.svg') }}" alt="" class="list_image">
                                        <span class="list_span">Registros</span>
                                        <img src="{{ asset('images/arrow.svg') }}" alt=""
                                            class="list_arrow h-8 ml-auto">
                                    </div>

                                    <ul class="h-0">
                                        @foreach ($rutas as $ruta)
                                            @if ($ruta->tipo_ruta == 3)
                                                <li class="">
                                                    <div class="h-1"></div>
                                                    <a href="{{ route($ruta->route) }}"
                                                        class="list_item {{ request()->routeIs($ruta->route) ? 'link_select' : '' }} ">
                                                        <img src="{{ asset('images/option.svg') }}" alt=""
                                                            class="list_image">
                                                        <span class="list_span-aside">{{ $ruta->nombre }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="mt-3 link">
                                    <div
                                        class="list_item list_button {{ request()->routeIs('admin.bitacoras.*')  ? 'bg-lime-600' : '' }}">
                                        <img src="{{ asset('images/orden.svg') }}" alt="" class="list_image">
                                        <span class="list_span">Bitacoras</span>
                                        <img src="{{ asset('images/arrow.svg') }}" alt=""
                                            class="list_arrow h-8 ml-auto">
                                    </div>

                                    <ul class="h-0">
                                        @foreach ($rutas as $ruta)
                                            @if ($ruta->tipo_ruta == 4)
                                                <li class="">
                                                    <div class="h-1"></div>
                                                    <a href="{{ route($ruta->route) }}"
                                                        class="list_item {{ request()->routeIs($ruta->route) ? 'link_select' : '' }} ">
                                                        <img src="{{ asset('images/option.svg') }}" alt=""
                                                            class="list_image">
                                                        <span class="list_span-aside">{{ $ruta->nombre }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @break

                            @case(2)
                            @break

                            @default
                        @endswitch
                    @else
                    @endif
                </ul>{{-- end links --}}
            </nav>
        </div>
    </aside>

    <div id="box_shadow" x-data="data()" @click="method_a()"
        class="z-10 fixed left-0 right-0 top-0 bottom-0 bg-gradient-to-l from-white/50  to-black/30 hidden md:hidden dark:bg-gradient-to-l dark:from-black/50  dark:to-white/30">
    </div>

    <div id="home" class="pt-[58px]  min-h-screen md:ml-[250px] bg-gray-100 dark:bg-gray-900 flex flex-col"
        style="transition:margin-left 0.5s;">
        <header class="bg-gray-100 dark:bg-gray-900 mt-3">
            <div class="mx-auto py-2 px-4 md:flex md:justify-between mt-5">
                <div class="">
                    <h2 class="font-bold text-3xl text-dark dark:text-gray-200 leading-tight">
                        <strong>@yield('titulo')</strong>
                    </h2>
                </div>
                <div class="">
                    <a @if (Auth::check()) {{--  --}}
                            @switch(Auth::user()->tipo_usuario_id)
                        @case(1)
                            href="{{ route('admin.administrador.panel') }}"
                        @break

                        @case(3)
                             href="{{ route('gestor.gestor.panel') }}"
                        @break

                        @case(5)
                             href="{{ route('empleado.empleado.panel') }}"
                        @break

                        @default
                        href="{{ route('welcome') }}"
                    @endswitch
                @else
                    href="{{ route('welcome') }}" 
                    {{--  --}} @endif
                        class="text-blue-600 dark:text-blue-400 hover:text-lime-600">Inicio</a>
                    <span class="dark:text-gray-200 text-gray-500">/ @yield('titulo')</span>
                </div>
            </div>
        </header>
        <!-- Page Content -->
        <main class="px-4 dark:text-gray-200 mt-4 mb-2">
            @yield('content')
        </main>

        <div
            class="h-[45px] w-full bg-white mt-auto flex items-center border-t border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <h2 class="ml-auto pr-5 dark:text-gray-200">Version 1.1.0</h2>
        </div>
    </div>


    @stack('modals')


    @livewireScripts
</body>

<script>
    function data() {

        return {
            aside: document.getElementById('aside'),
            box: document.getElementById('box_shadow'),
            nav: document.getElementById('nav'),
            open: false,
            home: document.getElementById('home'),
            // logo: document.getElementById('LogoGisena'),

            public() {
                var ancho = window.innerWidth;
                if (ancho < 768) {
                    this.box.classList.remove('hidden');
                    this.aside.classList.remove('-translate-x-full');
                    this.aside.classList.remove('w-[80px]');
                } else if (ancho > 767) {

                    if (this.open) {
                        this.nav.classList.remove('md:ml-[80px]');
                        this.home.classList.remove('md:ml-[80px]');
                        this.aside.classList.remove('md:w-[80px]');
                        // this.logo.src = "{{ asset('images/Gisena_Logo.webp') }}";
                        // this.logo.classList.remove('md:w-[52px]');
                        this.open = !this.open;
                    } else {
                        this.nav.classList.add('md:ml-[80px]');
                        this.aside.classList.add('md:w-[80px]');
                        this.home.classList.add('md:ml-[80px]');
                        // this.logo.src = "{{ asset('images/G_Logo.webp') }}";
                        // this.logo.classList.add('md:w-[52px]');

                        this.open = !this.open;

                    }
                }
            },
            method_a() {
                var ancho = window.innerWidth;
                if (ancho < 768) {
                    this.box.classList.add('hidden');
                    this.aside.classList.add('-translate-x-full');
                    this.open = false;
                }
            }

        }
    }

    let list_button = document.querySelectorAll('.list_button');

    list_button.forEach(list_button => {

        list_button.addEventListener('click', () => {

            list_button.classList.toggle('arrow');

            let height = 0;
            let menu = list_button.nextElementSibling;
            if (menu.clientHeight == "0") {
                height = menu.scrollHeight;
            }
            menu.style.height = `${height}px`;
        })

    });
</script>



<script src="{{ asset('js/preloader.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>

</html>
