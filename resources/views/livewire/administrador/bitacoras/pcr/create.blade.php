<div>
    <x-message />
    <div>
        <style>
            .porsentaje {
                width: {{ $porsentaje }}%;
            }
        </style>

        <div class="">
            {{-- steps --}}
            <div class="">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ $currentStep }} / {{ $totalSteps }}
                    -
                    {{ $titles[$currentStep] }}</p>
                <div class="mt-4 overflow-hidden rounded-full bg-gray-300 w-full">
                    <div class="h-1 rounded-full bg-lime-600 porsentaje"></div>
                </div>
            </div>



            <form wire:submit.prevent="register" class="bg-slate-300 dark:bg-slate-800 p-5 rounded-md mt-3">

                @if ($currentStep == 1)
                    <fieldset class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="flex flex-col">
                            <label for="">No. Registro:</label>
                            <x-input wire:model="no_registro" placeholder="Numero de la bitacora" />
                            <x-input-error for="no_registro" class="mt-2" />
                        </div>
                        <div class="flex flex-col">
                            <label for="">Análisis:</label>
                            <x-select type="text" wire:model="analisis">
                                <option value="" disabled>Seleccione una opción</option>
                                @foreach ($analises as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error for="analisis" class="mt-2" />
                        </div>

                        <div class="flex flex-col">
                            <label for="">Sanitizo:</label>
                            <x-select type="text" wire:model="sanitizo">
                                <option value="" disabled>Seleccione una opción</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </x-select>
                            <x-input-error for="sanitizo" class="mt-2" />
                        </div>
                        <div class="flex flex-col">
                            <label for="">Tiempo UV:</label>
                            <x-select type="text" wire:model="tiempouv">
                                <option value="" disabled>Seleccione una opción</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </x-select>
                            <x-input-error for="tiempouv" class="mt-2" />
                        </div>
                    </fieldset>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-3">
                        <div class="flex flex-col">
                            <label for="">Agaroza:</label>
                            <x-input wire:model="agaroza" />
                            <x-input-error for="agaroza" class="mt-2" />
                        </div>
                        <div class="flex flex-col">
                            <label for="">Tiempo:</label>
                            <x-input wire:model="tiempo" placeholder="(minutos)" />
                            <x-input-error for="tiempo" class="mt-2" />
                        </div>

                        <div class="flex flex-col">
                            <label for="">Voltaje:</label>
                            <x-input wire:model="voltaje" />
                            <x-input-error for="voltaje" class="mt-2" />
                        </div>
                    </div>
                @endif

                @if ($currentStep == 2)
                    <fieldset>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="flex flex-col">
                                <label for="">Especie:</label>
                                <x-select wire:model="especie">
                                    <option value="" disabled>Seleccione una opción</option>
                                    @foreach ($especies as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </x-select>
                                <x-input-error for="especie" class="mt-2" />
                            </div>
                            <div class="flex flex-col">
                                <label for="">Resultado:</label>
                                <x-select wire:model="resultado">
                                    <option value="" disabled>Seleccione una opción</option>
                                    <option value="1">Positivo</option>
                                    <option value="2">Negativo</option>
                                </x-select>
                                <x-input-error for="resultado" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex justify-center md:justify-end max-md:w-full my-3">
                            <x-button type="button" wire:click="addSubcategory">Agregar</x-button>
                        </div>
                        <div>
                            <x-table>
                                <x-slot name="titles">
                                    <x-th>No.</x-th>
                                    <x-th>Especie</x-th>
                                    <x-th>Resultado</x-th>
                                    <x-th>Eliminar</x-th>
                                </x-slot>
                                <x-slot name="content">
                                    @forelse ($listName as $index => $item)
                                        <x-tr>
                                            <x-td wire:key="espe-{{ $index }}">{{ $index + 1 }}</x-td>
                                            <x-td>{{ $item['especie_nomb'] }}</x-td>
                                            <x-td>{{ $item['resultado_nomb'] }}</x-td>
                                            <x-td>
                                                <x-danger-button
                                                    wire:click="deteSubcategory({{ $index }})">X</x-danger-button>
                                            </x-td>
                                        </x-tr>
                                    @empty
                                        <x-tr>
                                            <td colspan="3" class="text-center px-6 py-4">No hay resultados
                                                disponibles</td>
                                        </x-tr>
                                    @endforelse
                                </x-slot>
                            </x-table>
                        </div>
                    </fieldset>
                @endif

                @if ($currentStep == 3)
                    <fieldset>
                        <x-table>
                            <x-slot name="titles">
                                <x-th></x-th>
                                <x-th>No. de inventario</x-th>
                                <x-th>Nombre</x-th>
                            </x-slot>
                            <x-slot name="content">
                                @forelse ($equipos as $item)
                                    <x-tr>
                                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                            wire:key="{{ $item->id }}">
                                            <x-checkbox type="checkbox" wire:model="selectedTagsEquipo"
                                                value="{{  $item->id }} " />
                                        </th>
                                        <x-td>{{ $item->no_inventario }}</x-td>
                                        <x-td>{{ $item->nombre }}</x-td>
                                    </x-tr>
                                @empty
                                    <x-tr>
                                        <td colspan="4" class="text-center px-6 py-4">No hay datos disponibles</td>
                                    </x-tr>
                                @endforelse
                            </x-slot>

                        </x-table>
                        <div class="mt-3">
                            {{ $equipos->onEachSide(1)->links() }}
                        </div>
                    </fieldset>
                @endif

                @if ($currentStep == 4)
                @endif

                {{-- contenedor botones --}}
                <div class="flex justify-between mt-10">
                    @if ($currentStep > 1 && $currentStep <= $totalSteps)
                        <x-danger-button wire:click="decreaseStep" type="button">Anterior</x-danger-button>
                    @else
                        <div><x-danger-button wire:click="cancelRegister" type="button">Cancelar</x-danger-button>
                        </div>
                    @endif

                    @if ($currentStep < $totalSteps)
                        <x-button wire:click="increaseStep" type="button">Siguiente</x-button>
                    @elseif ($currentStep == $totalSteps)
                        <x-button type="submit">Guardar</x-button>
                    @endif
                </div>

            </form>

        </div>

        <div class="bg-gray-500 dark:bg-gray-900 opacity-75 fixed z-[10000] left-0 top-0 h-screen w-full  items-center justify-center hidden"
            wire:loading.class.remove="hidden" wire:loading.class="flex"
            wire:target="register,decreaseStep,cancelRegister,increaseStep">

            <div class="preloader_box">
                <img src="{{ asset('images/G_Logo.png') }}" alt="" class="preloader_img">
                <div class="lds-dual-ring"></div>
            </div>

        </div>
    </div>
</div>
