<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            wire:model="currentPageTable1">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">Versión</th>
                    <th scope="col" class="px-6 py-3 text-center">No. Registro</th>
                    <th scope="col" class="px-6 py-3 text-center">Reactivo</th>
                    <th scope="col" class="px-6 py-3 text-center">Fecha Apertura</th>
                    <th scope="col" class="px-6 py-3 text-center">Fecha Caducidad</th>
                    <th scope="col" class="px-6 py-3 text-center">Validado</th>
                    <th scope="col" class="px-6 py-3 text-center">Usuario</th>
                    <th scope="col" class="px-6 py-3 text-center">Ver</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vrpcr as $pcr)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->version }}
                        </td>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                            wire:key="analisis-{{ $pcr->id }}">
                            @foreach ($pcr->extraccions as $pc)
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
                                </svg>
                            </x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="m-3">
        {{ $vrpcr->links() }}
    </div>

    {{-- ================================================================================View================================================= --}}

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
                            <x-select wire:model="rpcrView.reactivo" disabled>
                                <option value="">Seleccione un reactivo</option>
                                @foreach ($reactivos as $reactivo)
                                    <option value="{{ $reactivo->id }}">{{ $reactivo->nombre }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error for="rpcrView.reactivo" />
                        </div>
                        <div class="flex flex-col">
                            <label for="">Fecha Apertura::</label>
                            <x-input type="date" wire:model='rpcrView.fecha_apertura' class="w-full" disabled />
                            <x-input-error for="rpcrView.fecha_apertura" />
                        </div>
                    </div>

                    <div class="grid gap-3 w-full">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center">No. Registro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vpcreals as $rpcr)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                                wire:key="rpcr-{{ $rpcr->id }}">
                                                {{ $rpcr->extraccion->no_registro }}
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
                    <x-danger-button wire:click="cancel_view">Cerrar</x-danger-button>
                </div>
            </div>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>
</div>
