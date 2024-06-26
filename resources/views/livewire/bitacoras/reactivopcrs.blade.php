<div wire:poll>
    @if (session('add_msg'))
        <x-alert-add>
            <x-slot name="content">{{ session('add_msg') }}</x-slot>
        </x-alert-add>
    @endif

    @if (session('up_msg'))
        <x-alert-up>
            <x-slot name="content">{{ session('up_msg') }}</x-slot>
        </x-alert-up>
    @endif
    @if (session('down_msg'))
        <x-alert-down>
            <x-slot name="content">{{ session('down_msg') }}</x-slot>
        </x-alert-down>
    @endif



    <div class="flex  m-2 max-md:flex-col max-md:justify-center">
        <div class="flex gap-3 m-2 max-md:w-full">
            <x-select wire:model.live="datos">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </x-select>
            <x-select wire:model.live="estate" class="max-md:w-full">
                <option value="">Todos</option>
                <option value="Validada">Validada</option>
                <option value="Sin Validacion">Sin Validación</option>
            </x-select>
        </div>
        <div class="flex gap-3 m-2 w-full max-md:flex-col">
            <x-input class="w-full" placeholder="Buscar PCR (No. registro)" wire:model.live="search" />
            <div>
                <label for="" class="text-black dark:text-white md:hidden">Fecha:</label>
                <x-input class=" max-md:w-full" type="date" wire:model.live="date" />
            </div>
        </div>
        @if (auth()->user()->nivel != 3)
            <x-button class="m-2 max-md:w-full" wire:click="new">Nuevo</x-button>
        @endif
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            wire:model="currentPageTable1">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">No. Registro</th>
                    <th scope="col" class="px-6 py-3 text-center">Reactivo</th>
                    <th scope="col" class="px-6 py-3 text-center">Fecha Apertura</th>
                    <th scope="col" class="px-6 py-3 text-center">Fecha Caducidad</th>
                    <th scope="col" class="px-6 py-3 text-center">Validado</th>
                    <th scope="col" class="px-6 py-3 text-center">Usuario</th>
                    @if (auth()->user()->nivel != 3)
                        <th scope="col" class="px-6 py-3 text-center">Editar</th>
                    @endif
                    <th scope="col" class="px-6 py-3 text-center">Ver Bitácora</th>
                    <th scope="col" class="px-6 py-3 text-center">Versiones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pcrs as $pcr)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                            wire:key="analisis-{{ $pcr->id }}">
                            {{-- Mostrar no_registro de pcr --}}
                            @foreach ($pcr->pcrs as $pc)
                                <div class="flex flex-col">
                                    {{ $pc->no_registro }}
                                </div>
                            @endforeach
                        </th>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->reactivo->nombre }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->fecha_apertura }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->reactivo->fecha_caducidad }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->validacion }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->user->name }}
                        </td>
                        @if (auth()->user()->nivel != 3)
                            @if ($pcr->validacion == 'Sin Validacion')
                                <td class="px-6 py-4 text-center">
                                    <x-button wire:click="edit({{ $pcr->id }})"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg></x-button>
                                </td>
                            @else
                                <td class="px-6 py-4 text-center">
                                </td>
                            @endif
                        @endif

                        <td class="px-6 py-4 text-center">
                            <x-button wire:click="view({{ $pcr->id }})"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path
                                        d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg></x-button>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <x-button wire:click="version({{ $pcr->id }})"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-versions">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M10 5m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                    <path d="M7 7l0 10" />
                                    <path d="M4 8l0 8" />
                                </svg></x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{--================================================================================Crear Nuevo=======================================--}}
    <x-dialog-modal wire:model="create_new">
        <x-slot name='title'>
            <h2 class="text-center">Nueva Bitácora</h2>
        </x-slot>
        <x-slot name='content'>
            @livewire('bitacoras.reactivopcrs-new')
        </x-slot>
        <x-slot name='footer'>
            <x-danger-button wire:click="cancel_new">Cerrar</x-danger-button>
        </x-slot>
    </x-dialog-modal>

    {{--================================================================================Editar=================================================--}}
    <x-dialog-modal wire:model="edit_register">
        <x-slot name='title'>
            <h2 class="text-center">Editar Bitácora</h2>
        </x-slot>
        <x-slot name='content'>
            <form class="grid gap-3" wire:submit="update">
                <div class="grid grid-cols-1 max-md:grid-cols-1 gap-5">
                    <div class="grid grid-cols-2 max-md:grid-cols-1 gap-3">
                        <div class="flex flex-col">
                            <label for="">Reactivo:</label>
                            <x-select wire:model="rpcrEdit.reactivo">
                                <option value="">Seleccione un reactivo</option>
                                @foreach ($reactivos as $reactivo)
                                    <option value="{{ $reactivo->id }}">{{ $reactivo->nombre }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error for="rpcrEdit.reactivo" />
                        </div>
                        <div class="flex flex-col">
                            <label for="">Fecha Apertura::</label>
                            <x-input type="date" wire:model='rpcrEdit.fecha_apertura' class="w-full" />
                            <x-input-error for="rpcrEdit.fecha_apertura" />
                        </div>
                    </div>
        
                    <div class="grid gap-3 w-full">
                        <div class="w-full">
                            <x-input wire:model.live="search_registro" placeholder="Buscar(no_registro)" class="w-full" />
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">No. Registro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rpcrs as $rpcr)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                                wire:key="rpcr-{{ $rpcr->id }}">
                                                <x-checkbox wire:model="rpcrEdit.selectedTagsPcr"
                                                    value="{{ $rpcr->id }} " /><span
                                                    class="text-white">{{ $rpcr->no_registro }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$rpcrs->links()}}
                        <x-input-error for="rpcrEdit.selectedTagsPcr" />
                    </div>
                </div>
                <div class="mt-5 flex justify-around">
                    <x-button>Guardar</x-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'>
            <x-danger-button wire:click="cancel_new">Cerrar</x-danger-button>
        </x-slot>
    </x-dialog-modal>

     {{--================================================================================View=================================================--}}
     <x-dialog-modal wire:model="view_register">
        <x-slot name='title'>
            <h2 class="text-center">Ver Bitácora</h2>
        </x-slot>
        <x-slot name='content'>
            <div class="grid gap-3">
                <div class="grid grid-cols-1 max-md:grid-cols-1 gap-5">
                    <div class="grid grid-cols-2 max-md:grid-cols-1 gap-3">
                        <div class="flex flex-col">
                            <label for="">Reactivo:</label>
                            <x-select wire:model="rpcrView.reactivo">
                                <option value="">Seleccione un reactivo</option>
                                @foreach ($reactivos as $reactivo)
                                    <option value="{{ $reactivo->id }}">{{ $reactivo->nombre }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error for="rpcrView.reactivo" />
                        </div>
                        <div class="flex flex-col">
                            <label for="">Fecha Apertura::</label>
                            <x-input type="date" wire:model='rpcrView.fecha_apertura' class="w-full" />
                            <x-input-error for="rpcrView.fecha_apertura" />
                        </div>
                    </div>
        
                    <div class="grid gap-3 w-full">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">No. Registro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vrpcr as $rpcr)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                                wire:key="rpcr-{{ $rpcr->id }}">
                                                {{ $rpcr->pcr->no_registro }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <x-input-error for="rpcrView.selectedTagsPcr" />
                    </div>
                </div>
                <div class="mt-5 flex justify-around">
                    <x-button wire:click="validar">Validar</x-button>
                    <x-danger-button wire:click="cancel_view">Cerrar</x-danger-button> 
                </div>
            </div>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>


    <x-dialog-modal wire:model="validar_register">
        <x-slot name='title'>
            <h2 class="text-center">¿Desea Validar este registro?</h2>
        </x-slot>
        <x-slot name='content'>
            <div class="grid gap-3">
                <div class="grid grid-cols-1 max-md:grid-cols-1 gap-5">
                </div>
                <div class="mt-5 flex justify-around">
                    <x-button wire:click="validar_view">Validar</x-button>
                    <x-danger-button wire:click="cancel_validar">Cerrar</x-danger-button> 
                </div>
            </div>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    {{--================================================================================Vercion=================================================--}}


    <x-dialog-modal wire:model="version_register">
        <x-slot name='title'>
            <h2 class="text-center">Versiones de Bitácora</h2>
        </x-slot>
        <x-slot name='content'>
            @livewire('bitacoras.versionesreactivopcrs', ['VercionReactivoId' => $VercionReactivoId])
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>
</div>
