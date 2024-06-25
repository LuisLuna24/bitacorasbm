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
                <option value="Sin Validacion">Sin Validacion</option>
            </x-select>
        </div>
        <div class="flex gap-3 m-2 w-full max-md:flex-col">
            <x-input class="w-full" placeholder="Buscar PCR Tiempo Real (No. registro)" wire:model.live="search" />
            <div>
                <label for="" class="text-black dark:text-white md:hidden">Fecha:</label>
                <x-input class=" max-md:w-full" type="date" wire:model.live="date" />
            </div>
        </div>
        @if(auth()->user()->nivel != 3 )
            <x-button class="m-2 max-md:w-full" wire:click="new">Nuevo</x-button>
        @endif
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
                    @if(auth()->user()->nivel != 3 )
                        <th scope="col" class="px-6 py-3 text-center">Editar</th>
                    @endif
                    <th scope="col" class="px-6 py-3 text-center">Ver Bitacora</th>
                    <th scope="col" class="px-6 py-3 text-center">Verciones</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($pcreals as $pcreal)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center" wire:key="analisis-{{ $pcreal->id }}">
                                {{$pcreal->no_registro}}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{$pcreal->analisis->nombre}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$pcreal->fecha}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$pcreal->resultado}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{--Mostrar especies--}}
                                @foreach ($pcreal->especies as $especie)
                                <div class="flex flex-col">
                                    {{ $especie->nombre }}
                                </div>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$pcreal->validacion}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$pcreal->user->name}}
                            </td>
                            @if(auth()->user()->nivel != 3 )
                                @if ($pcreal->validacion=='Sin Validacion')
                                    <td class="px-6 py-4 text-center">
                                        <x-button wire:click="edit({{ $pcreal->id }})"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg></x-button>
                                    </td>
                                @else
                                    <td class="px-6 py-4 text-center">
                                    </td> 
                                @endif
                            @endif
                            
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="view({{ $pcreal->id }})"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg></x-button>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <x-button wire:click="version({{ $pcreal->id }})"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-versions"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /><path d="M7 7l0 10" /><path d="M4 8l0 8" /></svg></x-button>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="m-3">
        {{$pcreals->links()}}
    </div>
    <!-- ------------------------------------------------------------------------------------Create------------ -->
    <x-dialog-modal wire:model="create_new">
        <x-slot name='title'>
            <h2 class="text-center">Nuevo Equipo</h2>
        </x-slot>
        <x-slot name='content'>
            <form class="grid gap-3" wire:submit="create">
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">No. Registro:</label>
                        <x-input wire:model='no_registro' />
                        <x-input-error for="no_registro" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Cantidad:</label>
                        <x-input wire:model='cantidad' value='1' />
                        <x-input-error for="cantidad" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Analisis:</label>
                        <x-select wire:model='analisis' >
                            <option value="">Seleccione un analisis</option>
                            @foreach ($analises as $analisis)
                                <option value="{{ $analisis->id }}">{{ $analisis->nombre }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="analisis" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Fecha:</label>
                        <x-input class="w-full" type="date" wire:model='fecha' />
                        <x-input-error for="fecha" />
                    </div>
                </div>
                <div class="grid grid-cols-1 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Resultado:</label>
                        <x-select wire:model='resultado' >
                            <option value="Negativo">Negativo</option>
                            <option value="Positivo">Positivo</option>
                        </x-select>
                        <x-input-error for="resultado" />
                    </div>
                </div>
                <div class="grid grid-cols-1 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Observaciones:</label>
                        <x-textarea wire:model='observaciones' ></x-textarea>
                        <x-input-error for="observaciones" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5 place-items-center">
                    <div class="">
                        <label for="">Sanitizo:</label>
                        <x-input type='checkbox'  wire:model='sanitizo' />
                    </div>
                    <div class="">
                        <label for="">Tiempo Uv</label>
                        <x-input type='checkbox'  wire:model='tiempouv' />
                    </div>
                </div>
                
                <div class="">
                    <h2>Especies:</h2>
                    <hr class="mb-2">
                    <ul class="grid grid-cols-3 place-items-center max-md:grid-cols-1 max-md:place-items-start gap-5  overflow-auto max-h-36 v-scroll">
                        @foreach($especies as $especie)
                            <li><x-checkbox wire:model="selectedTagsEspecie" value="{{$especie->id}} " /><span class="text-white">{{$especie->nombre}}</span></li>
                        @endforeach
                    </ul>
                    <x-input-error for="selectedTagsEspecie" />
                </div>
                
                <div class="">
                    <h2>Equipos:</h2>
                    <hr class="mb-2">
                    <ul class="grid grid-cols-3 place-items-center max-md:grid-cols-1 max-md:place-items-start gap-5 overflow-auto max-h-36 v-scroll">
                        @foreach($equipos as $equipo)
                            <li><x-checkbox wire:model="selectedTagsEquipo" value="{{$equipo->id}} " /><span class="text-white">{{$equipo->nombre}}</span></li>
                        @endforeach
                    </ul>
                    <x-input-error for="selectedTagsEquipo" />
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
                <div class="grid grid-cols-1 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">No. Registro:</label>
                        <x-input wire:model='VerPcreal.no_registro' disabled/>
                        <x-input-error for="VerPcreal.no_registro" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Analisis:</label>
                        <x-input wire:model='VerPcreal.analisis' disabled/>
                        <x-input-error for="VerPcreal.analisis" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Fecha:</label>
                        <x-input class="w-full" type="date" wire:model='VerPcreal.fecha' disabled/>
                        <x-input-error for="VerPcreal.fecha" />
                    </div>
                </div>
                <div class="grid grid-cols-1 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Resultado:</label>
                        <x-select wire:model='VerPcreal.resultado' disabled>
                            <option value="Negativo">Negativo</option>
                            <option value="Positivo">Positivo</option>
                        </x-select>
                        <x-input-error for="VerPcreal.resultado" />
                    </div>
                </div>
                <div class="grid grid-cols-1 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Observaciones:</label>
                        <x-textarea wire:model='VerPcreal.observaciones' disabled></x-textarea>
                        <x-input-error for="VerPcreal.observaciones" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5 place-items-center">
                    <div class="">
                        <label for="">Sanitizo:</label>
                        @if($sanitizado==1)
                        <x-input type='checkbox' checked="{{$sanitizado}}" wire:model='VerPcr.sanitizo' disabled/>
                        @else
                        <x-input type='checkbox'  wire:model='VerPcreal.sanitizo' disabled/>
                        @endif
                    </div>
                    <div class="">
                        <label for="">Tiempo Uv</label>
                        @if($tiempouvs==1)
                        <x-input type='checkbox' checked="{{$tiempouvs}}" wire:model='VerPcr.tiempouv' disabled/>
                        @else
                        <x-input type='checkbox'  wire:model='VerPcreal.tiempouv' disabled/>
                        @endif
                    </div>
                </div>
            </div>
            @livewire('pcreals.especies',[
                'especiesPcrId'=>$especiesPcrId
            ])
            @livewire('pcreals.equipos',[
                'especiesPcrId'=>$especiesPcrId
            ])
            <div class="flex justify-around mt-5">
                @if (auth()->user()->nivel === 2)
                    <x-button wire:click="alert_validar">Validar</x-button>
                @endif
                <x-danger-button wire:click="cerrar_view">Cerrar</x-danger-button>
            </div>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <!-- ------------------------------------------------------------------------------------Update------------ -->
    <x-dialog-modal wire:model="update_new">
        <x-slot name='title'>
            <h2 class="text-center">Nuevo Equipo</h2>
        </x-slot>
        <x-slot name='content'>
            <form class="grid gap-3" wire:submit="update">
                <div class="grid grid-cols-1 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">No. Registro:</label>
                        <x-input wire:model='pcrealEdit.no_registro' disabled />
                        <x-input-error for="pcrealEdit.no_registro" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Analisis:</label>
                        <x-select wire:model='pcrealEdit.analisis' >
                            <option value="">Seleccione un analisis</option>
                            @foreach ($analises as $analisis)
                                <option value="{{ $analisis->id }}">{{ $analisis->nombre }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="pcrealEdit.analisis" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Fecha:</label>
                        <x-input class="w-full" type="date" wire:model='pcrealEdit.fecha' />
                        <x-input-error for="pcrealEdit.fecha" />
                    </div>
                </div>
                <div class="grid grid-cols-1 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Resultado:</label>
                        <x-select wire:model='pcrealEdit.resultado' >
                            <option value="Negativo">Negativo</option>
                            <option value="Positivo">Positivo</option>
                        </x-select>
                        <x-input-error for="pcrealEdit.resultado" />
                    </div>
                </div>
                <div class="grid grid-cols-1 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Observaciones:</label>
                        <x-textarea wire:model='pcrealEdit.observaciones' ></x-textarea>
                        <x-input-error for="pcrealEdit.observaciones" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5 place-items-center">
                    <div class="">
                        <label for="">Sanitizo:</label>
                        @if($sanitizo_up==1)
                            <x-input type='checkbox'  wire:model='pcrealEdit.sanitizo' checked />
                        @else
                            <x-input type='checkbox'  wire:model='pcrealEdit.sanitizo' />
                        @endif
                    </div>
                    <div class="">
                        <label for="">Tiempo Uv</label>
                        @if($tiempouv_up==1)
                            <x-input type='checkbox'  wire:model='pcrealEdit.tiempouv' checked/>
                        @else
                            <x-input type='checkbox'  wire:model='pcrealEdit.tiempouv' />
                        @endif
                    </div>
                </div>
                
                <div class="">
                    <h2>Especies:</h2>
                    <hr class="mb-2">
                    <ul class="grid grid-cols-3 place-items-center max-md:grid-cols-1 max-md:place-items-start gap-5  overflow-auto max-h-36 v-scroll">
                        @foreach($especies as $especie)
                            <li><x-checkbox wire:model="pcrealEdit.selectedTagsEspecie" value="{{$especie->id}} " /><span class="text-white">{{$especie->nombre}}</span></li>
                        @endforeach
                    </ul>
                    <x-input-error for="pcrealEdit.selectedTagsEspecie" />
                </div>
                
                <div class="">
                    <h2>Equipos:</h2>
                    <hr class="mb-2">
                    <ul class="grid grid-cols-3 place-items-center max-md:grid-cols-1 max-md:place-items-start gap-5 overflow-auto max-h-36 v-scroll">
                        @foreach($equipos as $equipo)
                            <li><x-checkbox wire:model="pcrealEdit.selectedTagsEquipo" value="{{$equipo->id}} " /><span class="text-white">{{$equipo->nombre}}</span></li>
                        @endforeach
                    </ul>
                    <x-input-error for="pcrealEdit.selectedTagsEquipo" />
                </div>
                <div class="mt-5 flex justify-around">
                    <x-button>Actualizar</x-button>
                    <x-danger-button wire:click="cancel_update">Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <!-- ------------------------------------------------------------------------------------Validar------------ -->
    <x-dialog-modal wire:model="validar_vitacora">
        <x-slot name='title'>
            <h2 class="text-center">¿Validar bitacora PCR?</h2>
        </x-slot>
        <x-slot name='content'>
            <div class="flex flex-col">
                <label for="">No. Registro</label>
                <x-input wire:model='pcrealVal.no_registro' disabled/>
            </div>
            <div class="flex justify-around mt-4">
                <x-button wire:click="validar">Validar</x-button>
                <x-danger-button wire:click="cerrar_validar">Cancelar</x-danger-button>
            </div>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <!-- ------------------------------------------------------------------------------------Verciones------------ -->
    <x-dialog-modal wire:model="vercion_pcr">
        <x-slot name='title'>
            <h2 class="text-center">Verciones PCR</h2>
        </x-slot>
        <x-slot name='content'>
            @livewire('pcreals.versiones',['pcrealVercionId' => $pcrealVercionId,])
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>
</div>
