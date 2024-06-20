<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            wire:model="currentPageTable1">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">Version</th>
                    <th scope="col" class="px-6 py-3 text-center">No. Registro</th>
                    <th scope="col" class="px-6 py-3 text-center">Reactivo</th>
                    <th scope="col" class="px-6 py-3 text-center">Fecha Apertura</th>
                    <th scope="col" class="px-6 py-3 text-center">Fecha Caducidad</th>
                    <th scope="col" class="px-6 py-3 text-center">Validado</th>
                    <th scope="col" class="px-6 py-3 text-center">Usuario</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="m-3">
        {{ $vrpcr->links() }}
    </div>
</div>
