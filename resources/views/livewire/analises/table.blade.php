<div>
    @if (session('add_msg'))
        <x-alert-add>
            <x-slot name="content">{{session('add_analisis')}}</x-slot>
        </x-alert-add>
    @endif
    
    @if (session('up_msg'))
        <x-alert-up>
            <x-slot name="content">{{session('up_analisis')}}</x-slot>
        </x-alert-up>
    @endif
    


    <div class="flex gap-3 m-2">
        <x-select wire:model.live="datos">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
        </x-select>
        <x-input class="w-full" placeholder="Buscar Analisis (nombre)" wire:model.live="search" />
        <x-button class="m-2" wire:click="new">Nuevo</x-button>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" wire:model="currentPageTable1">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-center">Usuario</th>
                    <th scope="col" class="px-6 py-3 text-center">Editar</th>
                    <th scope="col" class="px-6 py-3 text-center">Verciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($analises as $analisis)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center" wire:key="analisis-{{ $analisis->id }}">
                                {{$analisis->nombre}}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{$analisis->user->name}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="edit({{ $analisis->id }})"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg></x-button>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="vercion({{ $analisis->id }})"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 18c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /><path d="M16 19h6" /><path d="M19 16v6" /></svg></x-button>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="m-3">
        {{$analises->links()}}
    </div>
    <!-- ------------------------------------------------------------------------------------Create------------ -->
    <x-dialog-modal wire:model="create_new">
        <x-slot name='title'>
            <h2 class="text-center">Nuevo Analisis</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="create">
                <div>
                    <x-label>Nombre:</x-label>
                    <x-input wire:model="nombre" type="text" class="block mt-1 w-full" />
                    <x-input-error for="nombre" />
                </div>
                <div class="mt-5 flex justify-around">
                    <x-button>Agregar</x-button>
                    <x-danger-button wire:click="cancel_new">Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <!-- ------------------------------------------------------------------------------------Verciones------------ -->
    
    <x-dialog-modal wire:model="version_view">
        <x-slot name='title'>
            <h2 class="text-center">Verciones Analisis</h2>
        </x-slot>
        <x-slot name='content'>
            @livewire('analises.version',[
                'VersionAnalisId'=>$VersionAnalisId
            ])
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <!-- ------------------------------------------------------------------------------------Update------------ -->
    <x-dialog-modal wire:model="update_new">
        <x-slot name='title'>
            <h2 class="text-center">Nuevo Analisis</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="update">
                <div>
                    <x-label>Nombre:</x-label>
                    <x-input wire:model="analisisEdit.nombre" type="text" class="block mt-1 w-full" />
                    <x-input-error for="analisisEdit.nombre" />
                </div>
                <div class="mt-5 flex justify-around">
                    <x-button>Guardar</x-button>
                    <x-danger-button wire:click="cancel_update">Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>
</div>
