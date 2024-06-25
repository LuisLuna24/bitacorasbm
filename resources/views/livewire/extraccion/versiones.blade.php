<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            wire:model="currentPageTable1">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">No. Registro</th>
                    <th scope="col" class="px-6 py-3 text-center">Version</th>
                    <th scope="col" class="px-6 py-3 text-center">Analisis</th>
                    <th scope="col" class="px-6 py-3 text-center">Metodo</th>
                    <th scope="col" class="px-6 py-3 text-center">Conc ng/ul</th>
                    <th scope="col" class="px-6 py-3 text-center">260-280</th>
                    <th scope="col" class="px-6 py-3 text-center">260-230</th>
                    <th scope="col" class="px-6 py-3 text-center">Validacion</th>
                    <th scope="col" class="px-6 py-3 text-center">Fecha Edicion</th>
                    <th scope="col" class="px-6 py-3 text-center">Ver</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vextraccions as $extraccion)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                            wire:key="analisis-{{ $extraccion->id }}">
                            {{ $extraccion->no_registro }}
                        </th>
                        <td class="px-6 py-4 text-center">
                            {{ $extraccion->version }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $extraccion->analisis->nombre }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $extraccion->metodo->nombre}}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $extraccion->conc_ng_ul }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $extraccion->dato260_280 }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $extraccion->conc_ng_ul }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $extraccion->validacion }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $extraccion->created_at->format('d-m-Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <x-button wire:click="view({{ $extraccion->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
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
    <div class="m-3">
        {{ $vextraccions->links() }}
    </div>



    <x-dialog-modal wire:model="view_version">
        <x-slot name='title'>
            <h2 class="text-center">Vercion PCR</h2>
        </x-slot>
        <x-slot name='content'>
            <div class="grid gap-3">
                <div class="dark:text-white grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">No. Registro:</label>
                        <x-input wire:model="extraVer.no_registro" disabled />
                        <x-input-error for="extraVer.no_registro" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Fecha:</label>
                        <x-input type="date" wire:model="extraVer.fecha" disabled />
                        <x-input-error for="extraVer.fecha" />
                    </div>
                </div>
                <div class="dark:text-white grid grid-cols-2 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">Analisis:</label>
                        <x-input wire:model="extraVer.analisis" disabled />
                        <x-input-error for="extraVer.analisis" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Metodo:</label>
                        <x-input wire:model="extraVer.metodo" disabled />
                        <x-input-error for="extraVer.metodo" />
                    </div>
                </div>
                <div class="dark:text-white grid grid-cols-3 max-md:grid-cols-1 gap-3">
                    <div class="flex flex-col">
                        <label for="">Conc ng/ul:</label>
                        <x-input wire:model="extraVer.conc_ng_ul" disabled />
                        <x-input-error for="extraVer.conc_ng_ul" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">260/280:</label>
                        <x-input wire:model="extraVer.d260_280" disabled />
                        <x-input-error for="extraVer.d260_280" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">260/230:</label>
                        <x-input wire:model="extraVer.d260_230" disabled />
                        <x-input-error for="extraVer.d260_230" />
                    </div>
                </div>
                @livewire('extraccion.equipos-version', ['versionExtraccionId' => $versionExtraccionId])
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-danger-button wire:click="close_version">Cerrar</x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
