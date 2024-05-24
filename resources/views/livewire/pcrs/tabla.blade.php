<div>
    @if (session('add_msg'))
        <x-alert-add>
            <x-slot name="content">{{session('add_msg')}}</x-slot>
        </x-alert-add>
    @endif
    
    @if (session('up_msg'))
        <x-alert-up>
            <x-slot name="content">{{session('up_msg')}}</x-slot>
        </x-alert-up>
    @endif
    @if (session('down_msg'))
        <x-alert-down>
            <x-slot name="content">{{session('down_msg')}}</x-slot>
        </x-alert-down>
    @endif
    


    <div class="flex gap-3 m-2">
        <x-select wire:model.live="datos">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
        </x-select>
        <x-select wire:model.live="estate">
            <option value="Activo">Activo</option>
            <option value="Baja">Baja</option>
            <option value="Reparacion">Reparacion</option>
        </x-select>
        <x-input class="w-full" placeholder="Buscar Analisis (nombre)" wire:model.live="search" />
        <x-button class="m-2" wire:click="new">Nuevo</x-button>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" wire:model="currentPageTable1">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">No. Registro</th>
                    <th scope="col" class="px-6 py-3 text-center">Analisis</th>
                    <th scope="col" class="px-6 py-3 text-center">Fecha</th>
                    <th scope="col" class="px-6 py-3 text-center">Resultado</th>
                    <th scope="col" class="px-6 py-3 text-center">Especies</th>
                    <th scope="col" class="px-6 py-3 text-center">Validado</th>
                    <th scope="col" class="px-6 py-3 text-center">Usuario</th>
                    <th scope="col" class="px-6 py-3 text-center">Editar</th>
                    <th scope="col" class="px-6 py-3 text-center">Ver Bitacora</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($pcrs as $pcr)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center" wire:key="analisis-{{ $pcr->id }}">
                                {{$pcr->no_registro}}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{$pcr->analisis->nombre}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$pcr->fecha}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$pcr->resultado}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{--Mostrar especies--}}
                                @foreach ($pcr->especies as $especie)
                                <div class="flex flex-col">
                                    {{ $especie->nombre }}
                                </div>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 text-center">
                                Sin validar
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$pcr->user->name}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="edit({{ $pcr->id }})"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg></x-button>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="view({{ $pcr->id }})"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 18c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /><path d="M16 19h6" /><path d="M19 16v6" /></svg></x-button>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="m-3">
        {{--$equipos->links()--}}
    </div>
    <!-- ------------------------------------------------------------------------------------Create------------ -->
    <x-dialog-modal wire:model="create_new">
        <x-slot name='title'>
            <h2 class="text-center">Nuevo Equipo</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="create">
                <div>
                    <x-label>Inventario:</x-label>
                    <x-input wire:model="inventario" type="text" class="block mt-1 w-full" />
                    <x-input-error for="inventario" />
                </div>
                <div>
                    <x-label>Nombre:</x-label>
                    <x-input wire:model="nombre" type="text" class="block mt-1 w-full" />
                    <x-input-error for="nombre" />
                </div>
                <div>
                    <x-label>Descripcion:</x-label>
                    <x-input wire:model="descripcion" type="text" class="block mt-1 w-full" />
                    <x-input-error for="descripcion" />
                </div>
                <div class="mt-5 flex justify-around">
                    <x-button>Agregar</x-button>
                    <x-danger-button wire:click="cancel_new">Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <!-- ------------------------------------------------------------------------------------view------------ -->
    
    <x-dialog-modal wire:model="view_view">
        <x-slot name='title'>
            <h2 class="text-center">Ver Bitacora de pcr</h2>
        </x-slot>
        <x-slot name='content'>
            <div class="grid gap-3">
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">No. Registro:</label>
                        <x-input wire:model='VerPcr.no_registro' disabled/>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Analisis:</label>
                        <x-input wire:model='VerPcr.analisis' disabled/>
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Fecha:</label>
                        <x-input wire:model='VerPcr.fecha' disabled/>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Resultado:</label>
                        <x-input wire:model='VerPcr.resultado' disabled/>
                    </div>
                </div>
                <div class="grid grid-cols-3 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Agarosa</label>
                        <x-input wire:model='VerPcr.agarosa' disabled/>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Voltaje</label>
                        <x-input wire:model='VerPcr.voltaje' disabled/>
                    </div>
                    <div class="flex flex-col">
                        <label for="">Tiempo: (min)</label>
                        <x-input wire:model='VerPcr.tiempo' disabled/>
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5 place-items-center">
                    <div class="">
                        <label for="">Sanitizo:</label>
                        @if($sanitizado==1)
                        <x-input type='checkbox' checked="{{$sanitizado}}" wire:model='VerPcr.sanitizo' disabled/>
                        @else
                        <x-input type='checkbox'  wire:model='VerPcr.sanitizo' disabled/>
                        @endif
                    </div>
                    <div class="">
                        <label for="">Tiempo Uv</label>
                        @if($tiempouv==1)
                        <x-input type='checkbox' checked="{{$tiempouv}}" wire:model='VerPcr.tiempouv' disabled/>
                        @else
                        <x-input type='checkbox'  wire:model='VerPcr.tiempouv' disabled/>
                        @endif
                    </div>
                </div>
            </div>
            @livewire('pcrs.especies',[
                'especiesPcrId'=>$especiesPcrId
            ])
            @livewire('pcrs.equipos',[
                'especiesPcrId'=>$especiesPcrId
            ])
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <!-- ------------------------------------------------------------------------------------Update------------ -->
    <x-dialog-modal wire:model="update_new">
        <x-slot name='title'>
            <h2 class="text-center">Nuevo Equipo</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="update">
                <div>
                    <x-label>Inventario:</x-label>
                    <x-input wire:model="equipoEdit.inventario" type="text" class="block mt-1 w-full" />
                    <x-input-error for="equipoEdit.inventario" />
                </div>
                <div>
                    <x-label>Nombre:</x-label>
                    <x-input wire:model="equipoEdit.nombre" type="text" class="block mt-1 w-full" />
                    <x-input-error for="equipoEdit.nombre" />
                </div>
                <div>
                    <x-label>Descripcion:</x-label>
                    <x-input wire:model="equipoEdit.descripcion" type="text" class="block mt-1 w-full" />
                    <x-input-error for="equipoEdit.descripcion" />
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
