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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="m-3">
        {{ $vpcrs->links() }}
    </div>
</div>
