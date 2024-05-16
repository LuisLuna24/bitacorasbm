<x-app-layout>
    <x-slot name="header">
        <x-nav-catalogos>
            <x-slot name='title'>
                Analisis
            </x-slot>
        </x-nav-catalogos>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-10">
                @livewire('analises.table')
            </div>
        </div>
    </div>
</x-app-layout>
