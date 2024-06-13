<div>
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

    <div class="grid gap-5">
        {{-- ==========================================Filtros====================================== --}}
        <div class="dark:text-white flex w-full gap-3">
            <div class="flex flex-col">
                <label for="">Mostrar:</label>
                <x-select wire:model.live="datos">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </x-select>
            </div>
            <div class="flex flex-col">
                <label for="">Estado:</label>
                <x-select wire:model.live="validacion">
                    <option value="">Todos</option>
                    <option value="Validado">Validado</option>
                    <option value="Sin Validacion">No Validado</option>
                </x-select>
            </div>
            <div class="flex flex-col w-full">
                <label for="">Buscar:</label>
                <x-input wire:model.live="search" placeholder="(No. registros)" class="w-full" />
            </div>
            <div class="flex flex-col">
                <label for="">Fecha</label>
                <x-input type="date" wire:model.live="date" />
            </div>
            <div class="grid place-items-end">
                <x-button wire:click="new">Nuevo</x-button>
            </div>
        </div>
        {{-- ==========================================Tabla====================================== --}}

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">No. Registro</th>
                        <th scope="col" class="px-6 py-3 text-center">Analisis</th>
                        <th scope="col" class="px-6 py-3 text-center">Fecha</th>
                        <th scope="col" class="px-6 py-3 text-center">Validado</th>
                        <th scope="col" class="px-6 py-3 text-center">Usuario</th>
                        @if (auth()->user()->nivel != 3)
                            <th scope="col" class="px-6 py-3 text-center">Editar</th>
                        @endif
                        <th scope="col" class="px-6 py-3 text-center">Ver Bitacora</th>
                        <th scope="col" class="px-6 py-3 text-center">Verciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($extracciones as $extraccion)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                wire:key="extraccion-{{ $extraccion->id }}">
                                {{ $extraccion->no_registro }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $extraccion->analisis->nombre }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $extraccion->fecha }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $extraccion->validacion }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $extraccion->user->name }}
                            </td>
                            @if (auth()->user()->nivel != 3)
                                @if ($extraccion->validacion == 'Sin Validacion')
                                    <td class="px-6 py-4 text-center">
                                        <x-button wire:click="editar({{ $extraccion->id }})"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </x-button>
                                    </td>
                                @else
                                    <td class="px-6 py-4 text-center">
                                    </td>
                                @endif
                            @endif

                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="view({{ $extraccion->id }})"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>
                                </x-button>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="version({{ $extraccion->id }})"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-versions">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M10 5m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                                        <path d="M7 7l0 10" />
                                        <path d="M4 8l0 8" />
                                    </svg>
                                </x-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


{{--------------------------------------------------------------Crear Registro-----------------------------------------}}
    <x-dialog-modal wire:model="nuevo_registro">
        <x-slot name='title'>
            <h2 class="text-center">Nueva Extraccion</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="crear_registro" class="grid gap-3">
                <div class="dark:text-white grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">No. Registro:</label>
                        <x-input wire:model="no_registro" />
                        <x-input-error for="no_registro" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Fecha:</label>
                        <x-input type="date" wire:model="fecha" />
                        <x-input-error for="fecha" />
                    </div>
                </div>
                <div class="dark:text-white grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">Analisis:</label>
                        <x-input wire:model="analisis" />
                        <x-input-error for="analisis" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Metodo:</label>
                        <x-input wire:model="metodo" />
                        <x-input-error for="metodo" />
                    </div>
                </div>
                <div class="dark:text-white grid grid-cols-3 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">Conc ng/ul:</label>
                        <x-input wire:model="conc_ng_ul" />
                        <x-input-error for="conc_ng_ul" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">260/280:</label>
                        <x-input wire:model="d260_280" />
                        <x-input-error for="d260_280" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">260/230:</label>
                        <x-input wire:model="d260_230" />
                        <x-input-error for="d260_230" />
                    </div>
                </div>

                <div>
                    <h2>Equipos:</h2>
                    <hr class="mb-2">
                    <ul class="flex flex-wrap justify-around gap-5 overflow-auto max-h-36 v-scroll">
                        @foreach($equipos as $equipo)
                            <li><x-checkbox wire:model="selectEquipos" value="{{$equipo->id}} " /><span class="text-white">{{$equipo->nombre}}</span></li>
                        @endforeach
                    </ul>
                    <x-input-error for="selectEquipos" />
                    <hr class="mb-2 mt-2">
                </div>

                <div class="dark:text-white flex justify-around">
                    <div class="flex flex-col">
                        <x-button>Agregar</x-button>
                    </div>
                    <div class="flex flex-col">
                        <x-danger-button wire:click="cancelar_registro">Cancelar</x-danger-button>
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>


    {{--------------------------------------------------------------Editar Registro-----------------------------------------}}
    <x-dialog-modal wire:model="editar_registro">
        <x-slot name='title'>
            <h2 class="text-center">Editar Extraccion</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="update_registro" class="grid gap-3">
                <div class="dark:text-white grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">No. Registro:</label>
                        <x-input wire:model="extraEdit.no_registro" />
                        <x-input-error for="extraEdit.no_registro" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Fecha:</label>
                        <x-input type="date" wire:model="extraEdit.fecha" />
                        <x-input-error for="extraEdit.fecha" />
                    </div>
                </div>
                <div class="dark:text-white grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">Analisis:</label>
                        <x-input wire:model="extraEdit.analisis" />
                        <x-input-error for="extraEdit.analisis" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Metodo:</label>
                        <x-input wire:model="extraEdit.metodo" />
                        <x-input-error for="extraEdit.metodo" />
                    </div>
                </div>
                <div class="dark:text-white grid grid-cols-3 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">Conc ng/ul:</label>
                        <x-input wire:model="extraEdit.conc_ng_ul" />
                        <x-input-error for="extraEdit.conc_ng_ul" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">260/280:</label>
                        <x-input wire:model="extraEdit.d260_280" />
                        <x-input-error for="extraEdit.d260_280" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">260/230:</label>
                        <x-input wire:model="extraEdit.d260_230" />
                        <x-input-error for="extraEdit.d260_230" />
                    </div>
                </div>

                <div>
                    <h2>Equipos:</h2>
                    <hr class="mb-2">
                    <ul class="flex flex-wrap justify-around gap-5 overflow-auto max-h-36 v-scroll">
                        @foreach($equipos as $equipo)
                            <li><x-checkbox wire:model="extraEdit.selectEquipos" value="{{$equipo->id}} " /><span class="text-white">{{$equipo->nombre}}</span></li>
                        @endforeach
                    </ul>
                    <x-input-error for="extraEdit.selectEquipos" />
                    <hr class="mb-2 mt-2">
                </div>

                <div class="dark:text-white flex justify-around">
                    <div class="flex flex-col">
                        <x-button>Actualizar</x-button>
                    </div>
                    <div class="flex flex-col">
                        <x-danger-button wire:click="cancelar_actualizar">Cancelar</x-danger-button>
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>


    {{--------------------------------------------------------------Ver Registro-----------------------------------------}}
    <x-dialog-modal wire:model="ver_registro">
        <x-slot name='title'>
            <h2 class="text-center">Bitacora Extraccion</h2>
        </x-slot>
        <x-slot name='content'>
            <div class="grid gap-5">
                <div class="dark:text-white grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">No. Registro:</label>
                        <x-input wire:model="extraVer.no_registro" disabled/>
                        <x-input-error for="extraVer.no_registro" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Fecha:</label>
                        <x-input type="date" wire:model="extraVer.fecha" disabled/>
                        <x-input-error for="extraVer.fecha" />
                    </div>
                </div>
                <div class="dark:text-white grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">Analisis:</label>
                        <x-input wire:model="extraVer.analisis" disabled/>
                        <x-input-error for="extraVer.analisis" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Metodo:</label>
                        <x-input wire:model="extraVer.metodo" disabled/>
                        <x-input-error for="extraVer.metodo" />
                    </div>
                </div>
                <div class="dark:text-white grid grid-cols-3 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">Conc ng/ul:</label>
                        <x-input wire:model="extraVer.conc_ng_ul" disabled/>
                        <x-input-error for="extraVer.conc_ng_ul" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">260/280:</label>
                        <x-input wire:model="extraVer.d260_280" disabled/>
                        <x-input-error for="extraVer.d260_280" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">260/230:</label>
                        <x-input wire:model="extraVer.d260_230" disabled/>
                        <x-input-error for="extraVer.d260_230" />
                    </div>
                </div>
                @livewire('extraccion.equipos',
                [
                    'extraccionIdVer'=> $extraccionIdVer
                ])
                <div class="w-full flex justify-around">
                    <x-button wire:click="validar_registro">Validar</x-button>
                    <x-danger-button wire:click="cancelar_ver">Cancelar</x-danger-button>
                </div>
            </div>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="validar">
        <x-slot name='title'>
            <h2 class="text-center">Bitacora Extraccion</h2>
        </x-slot>
        <x-slot name='content'>
            <div class="grid gap-5">
                <div class="dark:text-white grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">No. Registro:</label>
                        <x-input wire:model="extraVer.no_registro" disabled/>
                        <x-input-error for="extraVer.no_registro" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Fecha:</label>
                        <x-input type="date" wire:model="extraVer.fecha" disabled/>
                        <x-input-error for="extraVer.fecha" />
                    </div>
                </div>
                <div class="dark:text-white grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">Analisis:</label>
                        <x-input wire:model="extraVer.analisis" disabled/>
                        <x-input-error for="extraVer.analisis" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Metodo:</label>
                        <x-input wire:model="extraVer.metodo" disabled/>
                        <x-input-error for="extraVer.metodo" />
                    </div>
                </div>
                <div class="dark:text-white grid grid-cols-3 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">Conc ng/ul:</label>
                        <x-input wire:model="extraVer.conc_ng_ul" disabled/>
                        <x-input-error for="extraVer.conc_ng_ul" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">260/280:</label>
                        <x-input wire:model="extraVer.d260_280" disabled/>
                        <x-input-error for="extraVer.d260_280" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">260/230:</label>
                        <x-input wire:model="extraVer.d260_230" disabled/>
                        <x-input-error for="extraVer.d260_230" />
                    </div>
                </div>
                @livewire('extraccion.equipos',
                [
                    'extraccionIdVer'=> $extraccionIdVer
                ])
                <div class="w-full flex justify-around">
                    <x-button wire:click="validar_registro">Validar</x-button>
                    <x-danger-button wire:click="cancelar_ver">Cancelar</x-danger-button>
                </div>
            </div>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>



</div>
