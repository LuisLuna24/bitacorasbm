<div>
    <x-message />
    <section class="flex flex-col md:flex-row w-full gap-3 mb-5 items-end">
        <div class="flex flex-col max-md:w-full">
            <label for="">Mostar:</label>
            <x-select wire:model.change="pageView">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </x-select>
        </div>
        <div class="flex flex-col max-md:w-full">
            <label for="">Estatus:</label>
            <x-select wire:model.change="estatus">
                <option value="">Todos</option>
                <option value="1">Activos</option>
                <option value="2">Inactivos</option>
            </x-select>
        </div>
        <div class="flex flex-col w-full relative ">
            <label for="">Buscar:</label>
            <x-input wire:model.live.debounce.500ms="search" placeholder="(Nombre)" />
            <button type="button" class="absolute  right-3 -translate-y-1/2 top-2/3 p-1 text-white text-2xl"
                wire:click="resetSerch">x</button>
        </div>
        <div class="max-md:w-full">
            <x-button-new wire:click="newRegister" class="max-md:w-full" />
        </div>
    </section>
    <section>
        <x-table>
            <x-slot name="titles">
                <x-th>No.</x-th>
                <x-th>Analisis</x-th>
                <x-th>Agaroza</x-th>
                <x-th>Voltaje</x-th>
                <x-th>Tiempo</x-th>
                <x-th>Usuario</x-th>
                <x-th>Especies</x-th>
                <x-th>Editar</x-th>
                <x-th>Validación</x-th>
                <x-th>Estatus</x-th>
            </x-slot>
            <x-slot name="content">
                @forelse ($collection as $index => $item)
                    <x-tr>
                        <x-td wire:key="ite-{{ $item->id }}">{{ $item->no_registro }}</x-td>
                        <x-td>{{ $item->analisis->nombre }}</x-td>
                        <x-td>{{ $item->agaroza }}</x-td>
                        <x-td>{{ $item->voltaje }}</x-td>
                        <x-td>{{ $item->tiempo }}</x-td>
                        <x-td>{{ $item->usuario->name }}</x-td>
                        <x-td><x-button-catalogo
                                wire:click="especiesRegister({{ $item->id }})"></x-button-catalogo></x-td>
                        <x-td><x-button-edit wire:click="editRegister({{ $item->id }})"></x-button-edit></x-td>
                        <x-td>
                            @if (Auth::user()->tipo_usuario_id == 1)
                                <x-button-validation
                                    wire:click="validateRegister({{ $item->id }})"></x-button-validation>
                            @endif
                        </x-td>
                        <x-td>
                            <label for="{{ $item->id }}"
                                class="relative inline-block h-8 w-14 cursor-pointer rounded-full bg-gray-300 transition [-webkit-tap-highlight-color:_transparent] has-[:checked]:bg-green-500"
                                wire:click="statusRegister({{ $item->id }})"
                                wire:target="statusRegister({{ $item->id }})">


                                <input type="checkbox" id="{{ $item->id }}"
                                    class="peer sr-only [&:checked_+_span_svg[data-checked-icon]]:block [&:checked_+_span_svg[data-unchecked-icon]]:hidden"
                                    @if ($item->estado) checked @endif @disabled(true) />

                                <span
                                    class="absolute inset-y-0 start-0 z-10 m-1 inline-flex size-6 items-center justify-center rounded-full bg-white text-gray-400 transition-all peer-checked:start-6 peer-checked:text-green-600">
                                    <svg data-unchecked-icon xmlns="http://www.w3.org/2000/svg" class="size-4"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    <svg data-checked-icon xmlns="http://www.w3.org/2000/svg" class="hidden size-4"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </label>
                        </x-td>
                    </x-tr>
                @empty
                    <x-tr>
                        <td colspan="10" class="px-6 py-4 text-center">Sin Resultados</td>
                    </x-tr>
                @endforelse

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hidden"
                    wire:loading.class.remove="hidden" wire:target="search,pageView,estatus">
                    <th scope="row" colspan="7">
                        <div class="flex flex-row gap-2 justify-center px-6 py-3">
                            <div class="w-4 h-4 rounded-full bg-lime-700 animate-bounce"></div>
                            <div class="w-4 h-4 rounded-full bg-lime-700 animate-bounce [animation-delay:-.3s]"></div>
                            <div class="w-4 h-4 rounded-full bg-lime-700 animate-bounce [animation-delay:-.5s]"></div>
                        </div>
                    </th>
                </tr>
            </x-slot>
        </x-table>
        <div class="mt-5">
            {{ $collection->onEachSide(1)->links() }}
        </div>
    </section>

    <x-dialog-modal wire:model="statusModal">
        <x-slot name="title">
            <h2 class="text-center">Cambiar Estado</h2>
        </x-slot>
        <x-slot name="content">
            <form wire:submit="statusUpdate">
                <div class="flex flex-col text-center">
                    @if ($estatusModal == 1)
                        <label for="">¿Está seguro de cambiar el estado a inactivo?</label>
                    @else
                        <label for="">¿Está seguro de cambiar el estado a activo?</label>
                    @endif

                </div>
                <div class="flex justify-between mt-3">
                    <x-button>Aceptar</x-button>
                    <x-danger-button wire:click="closeStatusModal">Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="validateModal">
        <x-slot name="title">
            <h2 class="text-center">Validación</h2>
        </x-slot>
        <x-slot name="content">
            <form wire:submit="validateSubmit">
                <div class="flex flex-col">
                    <label for="validacion">Validación:</label>
                    <x-select wire:model="validacion">
                        <option value="" disabled>Seleccione una opción</option>
                        <option value="1">Aprobado</option>
                        <option value="2">Rechazado</option>
                    </x-select>
                </div>
                <div class="flex flex-col">
                    <label for="observaciones">Observaciones:</label>
                    <x-input wire:model="observaciones" />
                </div>
                <div class="flex justify-between mt-3">
                    <x-button>Guardar</x-button>
                    <x-danger-button wire:click="closeValidateModal">Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="especiesModal">
        <x-slot name="title">
            <h2 class="text-center">Especies</h2>
        </x-slot>
        <x-slot name="content">
            <x-table>
                <x-slot name="titles">
                    <x-th>No.</x-th>
                    <x-th>Especie</x-th>
                    <x-th>Resultado</x-th>
                </x-slot>
                <x-slot name="content">
                    @forelse ($especies as $index => $item)
                        <x-tr>
                            <x-td wire:key="esp-{{ $item->id }}">{{ $index + 1 }}</x-td>
                            <x-td>{{ $item->especies->nombre }}</x-td>
                            <x-td><x-resultado :resultado="$item->resultado" /></x-td>
                        </x-tr>
                    @empty
                        <x-tr>
                            <td colspan="2" class="px-6 py-4 text-center">Sin Resultados</td>
                        </x-tr>
                    @endforelse
                </x-slot>
            </x-table>
        </x-slot>
        <x-slot name="footer">
                <x-danger-button wire:click="closeEspeciesModal">Cerrar</x-danger-button>
        </x-slot>
    </x-dialog-modal>

    <div class="bg-gray-500 dark:bg-gray-900 opacity-75 fixed z-[10000] left-0 top-0 h-screen w-full  items-center justify-center hidden"
        wire:loading.class.remove="hidden" wire:loading.class="flex"
        wire:target="newRegister,editRegister,statusRegister,statusUpdate,submitForm,vercionRegister,validateRegister,validateSubmit">

        <div class="preloader_box">
            <img src="{{ asset('images/G_Logo.png') }}" alt="" class="preloader_img">
            <div class="lds-dual-ring"></div>
        </div>

    </div>
</div>
