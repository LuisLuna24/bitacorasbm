<x-app-layout>
    <x-slot name="header">
        <x-nav-inventarios>
            <x-slot name='title'>
                Inventarios
            </x-slot>
        </x-nav-inventarios>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex flex-wrap justify-center items-center gap-5">
                    <x-card >
                        <x-slot name="title">
                            Equipos
                        </x-slot>
                        <x-slot name="body">
                            <p>Agregar, editar, elimiar y visualisar equipos</p>
                            <br>
                            <x-button-routing href="{{ route('inventarios.equipos') }}">Entrar</x-button-routing>
                        </x-slot>
                    </x-card>
                    <x-card>
                        <x-slot name="title">
                            Reactivos
                        </x-slot>
                        <x-slot name="body">
                            <p>Agregar, editar, elimiar y visualisar reactivos </p>
                            <br>
                            <x-button-routing href="{{ route('inventarios.reactivos') }}">Entrar</x-button-routing>
                        </x-slot> 
                    </x-card>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
