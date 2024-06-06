<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bitacoras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-10">
                <div class="flex flex-wrap justify-center items-center gap-5">
                    <x-card >
                        <x-slot name="title">
                            Bitacora PCR
                        </x-slot>
                        <x-slot name="body">
                            <p>Agregar, editar, elimiar y visualisar bitacoras de PCR</p>
                            <br>
                            <x-button-routing href="{{ route('bitacoras.pcr') }}" wire:navigate.hover>Entrar</x-button-routing>
                        </x-slot>
                    </x-card>
                    <x-card>
                        <x-slot name="title">
                            Bitacora PCR Tiempo Real</span>
                        </x-slot>
                        <x-slot name="body">
                            <p>Agregar, editar, elimiar y visualisar bitacoras de PCR Tiempo Real </p>
                            <br>
                            <x-button-routing href="{{ route('bitacoras.pcreal') }}" wire:navigate.hover>Entrar</x-button-routing>
                        </x-slot> 
                    </x-card>
                    <x-card>
                        <x-slot name="title">
                            Bitacora Extraccion
                        </x-slot>
                        <x-slot name="body">
                            <p>Agregar, editar, elimiar y visualisar bitacoras de Extraccion</p>
                            <br>
                            <x-button-routing href="{{ route('bitacoras.extraccion') }}" wire:navigate.hover>Entrar</x-button-routing>
                        </x-slot>
                    </x-card>
                    <x-card>
                        <x-slot name="title">
                            Bitacora Reactivos
                        </x-slot>
                        <x-slot name="body">
                            <p>Agregar, editar, elimiar y visualisar bitacoras de Reactivos</p>
                            <br>
                            <x-button-routing  href="{{ route('bitacoras.reactivos') }}" wire:navigate.hover>Entrar</x-button-routing>
                        </x-slot>
                    </x-card>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
