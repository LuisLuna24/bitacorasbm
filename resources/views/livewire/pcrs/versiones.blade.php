<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            wire:model="currentPageTable1">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">No. Registro</th>
                    <th scope="col" class="px-6 py-3 text-center">Analisis</th>
                    <th scope="col" class="px-6 py-3 text-center">Fecha</th>
                    <th scope="col" class="px-6 py-3 text-center">Resultado</th>
                    <th scope="col" class="px-6 py-3 text-center">Agarosa</th>
                    <th scope="col" class="px-6 py-3 text-center">Voltaje</th>
                    <th scope="col" class="px-6 py-3 text-center">Tiempo (min)</th>
                    <th scope="col" class="px-6 py-3 text-center">Sanitizo</th>
                    <th scope="col" class="px-6 py-3 text-center">Tiempo UV</th>
                    <th scope="col" class="px-6 py-3 text-center">Fecha Edicion</th>
                    <th scope="col" class="px-6 py-3 text-center">Ver</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vpcrs as $pcr)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                            wire:key="analisis-{{ $pcr->id }}">
                            {{ $pcr->no_registro }}
                        </th>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->analisis->nombre }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->fecha }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->resultado }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->agarosa }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->voltaje }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->tiempo }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->sanitizo }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->tiempouv }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pcr->created_at->format('d-m-Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <x-button wire:click="view({{ $pcr->id }})">
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
        {{ $vpcrs->links() }}
    </div>

    {{-- =======================================================================================Ver Verciones================================================ --}}
    <x-dialog-modal wire:model="view_version">
        <x-slot name='title'>
            <h2 class="text-center">Vercion PCR</h2>
        </x-slot>
        <x-slot name='content'>
            <div class="grid gap-3">
                <div class="grid grid-cols-1 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">No. Registro:</label>
                        <x-input wire:model='pcrVersion.no_registro' />
                        <x-input-error for="pcrVersion.no_registro" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Analisis:</label>
                        <x-input wire:model='pcrVersion.analisis'/>
                        <x-input-error for="pcrVersion.analisis" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Fecha:</label>
                        <x-input class="w-full" type="date" wire:model='pcrVersion.fecha' />
                        <x-input-error for="pcrVersion.fecha" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Resultado:</label>
                        <x-input wire:model='pcrVersion.resultado' />
                        <x-input-error for="pcrVersion.resultado" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Agarosa</label>
                        <x-input wire:model='pcrVersion.agarosa' />
                        <x-input-error for="pcrVersion.agarosa" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5">
                    <div class="flex flex-col">
                        <label for="">Voltaje</label>
                        <x-input wire:model='pcrVersion.voltaje' />
                        <x-input-error for="pcrVersion.voltaje" />
                    </div>
                    <div class="flex flex-col">
                        <label for="">Tiempo: (min)</label>
                        <x-input wire:model='pcrVersion.tiempo' />
                        <x-input-error for="pcrVersion.tiempo" />
                    </div>
                </div>
                <div class="grid grid-cols-2 max-md:grid-cols-1 gap-5 place-items-center">
                    <div class="">
                        <label for="">Sanitizo:</label>
                        @if ($sanitizado == 1)
                            <x-input type='checkbox' checked="{{ $sanitizado }}" wire:model='pcrVersion.sanitizo'
                                disabled />
                        @else
                            <x-input type='checkbox' wire:model='pcrVersion.sanitizo' disabled />
                        @endif
                    </div>
                    <div class="">
                        <label for="">Tiempo Uv</label>
                        @if ($tiempouvs == 1)
                            <x-input type='checkbox' checked="{{ $tiempouvs }}" wire:model='pcrVersion.tiempouv'
                                disabled />
                        @else
                            <x-input type='checkbox' wire:model='pcrVersion.tiempouv' disabled />
                        @endif
                    </div>
                </div>

                @livewire('pcrs.especies-version', ['versionPcrId' => $versionPcrId])
                @livewire('pcrs.equipos-version', ['versionPcrId' => $versionPcrId])
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-danger-button wire:click="close_version">Cerrar</x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
