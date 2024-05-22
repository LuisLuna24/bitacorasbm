<x-app-layout>
    <x-slot name="header">
        <x-nav-catalogos>
            <x-slot name='title'>
                Catalogos
            </x-slot>
        </x-nav-catalogos>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-10">
                <div class="flex flex-wrap justify-center items-center gap-5">
                    <x-card >
                        <x-slot name="title">
                            Especies
                        </x-slot>
                        <x-slot name="body">
                            <p>Agregar, editar, elimiar y visualisar especies</p>
                            <br>
                            <x-button-routing href="{{ route('catalogos.especies') }}">Entrar</x-button-routing>
                        </x-slot>
                    </x-card>
                    <x-card>
                        <x-slot name="title">
                            Analisis
                        </x-slot>
                        <x-slot name="body">
                            <p>Agregar, editar, elimiar y visualisar analisis </p>
                            <br>
                            <x-button-routing href="{{ route('catalogos.analises') }}">Entrar</x-button-routing>
                        </x-slot> 
                    </x-card>
                    <x-card>
                        <x-slot name="title">
                            Metodos
                        </x-slot>
                        <x-slot name="body">
                            <p>Agregar, editar, elimiar y visualisar metodos</p>
                            <br>
                            <x-button-routing href="{{ route('catalogos.metodos') }}">Entrar</x-button-routing>
                        </x-slot>
                    </x-card>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
