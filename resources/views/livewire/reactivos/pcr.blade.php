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
                    @foreach ($reactivo_pcrs as $reactivo_pcr)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                wire:key="reactivo_pcr-{{ $reactivo_pcr->id }}">
                                {{ $reactivo_pcr->id }}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{ $reactivo_pcr->reactivo_id }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $reactivo_pcr->pcr_id }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $reactivo_pcr->validacion }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $reactivo_pcr->user->name }}
                            </td>
                            @if (auth()->user()->nivel != 3)
                                @if ($reactivo_pcr->validacion == 'Sin Validación')
                                    <td class="px-6 py-4 text-center">
                                        <x-button wire:click="editar({{ $reactivo_pcr->id }})"><svg
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
                                <x-button wire:click="view({{ $reactivo_pcr->id }})"><svg
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
                                <x-button wire:click="version({{ $reactivo_pcr->id }})"><svg
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
</div>
