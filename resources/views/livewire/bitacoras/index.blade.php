<div class="flex flex-wrap justify-center items-center gap-5">
    <x-card>
        <x-slot name="title">
            Bitacora PCR
        </x-slot>
        <x-slot name="body">
            <p>Agregar, editar, elimiar y visualisar bitacoras de PCR</p>
            <br>
            <x-button-routing href="{{ route('bitacoras.pcr') }}">Entrar</x-button-routing>
        </x-slot>
    </x-card>
    <x-card>
        <x-slot name="title">
            Bitacora PCR Tiempo Real</span>
        </x-slot>
        <x-slot name="body">
            <p>Agregar, editar, elimiar y visualisar bitacoras de PCR Tiempo Real </p>
            <br>
            <x-button-routing href="{{ route('bitacoras.pcreal') }}">Entrar</x-button-routing>
        </x-slot>
    </x-card>
    <x-card>
        <x-slot name="title">
            Bitacora Extraccion
        </x-slot>
        <x-slot name="body">
            <p>Agregar, editar, elimiar y visualisar bitacoras de Extraccion</p>
            <br>
            <x-button-routing href="{{ route('bitacoras.extraccion') }}">Entrar</x-button-routing>
        </x-slot>
    </x-card>
    <x-card>
        <x-slot name="title">
            Bitacora Reactivos
        </x-slot>
        <x-slot name="body">
            <p>Agregar, editar, elimiar y visualisar bitacoras de Reactivos</p>
            <br>
            <x-button wire:click="tipo">Entrar</x-button>
        </x-slot>
    </x-card>



    <x-dialog-modal wire:model="tipo_bitacora">
        <x-slot name='title'>
            <h2 class="text-center text-4xl">Bitacora Reactivos</h2>
            <h2 class="text-center">Seleccione un tipo de bitacora</h2>
        </x-slot>
        <x-slot name='content'>
            <div class="flex justify-around p-10 max-md:flex-col gap-5">
                <x-button-routing href="{{ route('bitacoras.reactivopcrs') }}">PCR</x-button-routing>
                <x-button-routing href="{{ route('bitacoras.reactivospcreal') }}">PCR Tiempo Real</x-button-routing>
                <x-button-routing href="{{ route('bitacoras.extraccion') }}">Extraccion</x-button-routing>
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-danger-button wire:click="close_tipo">Cerrar</x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
