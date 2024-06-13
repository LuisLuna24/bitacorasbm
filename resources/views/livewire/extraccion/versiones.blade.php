<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            wire:model="currentPageTable1">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">No. Registro</th>
                    <th scope="col" class="px-6 py-3 text-center">Analisis</th>
                    <th scope="col" class="px-6 py-3 text-center">Metodo</th>
                    <th scope="col" class="px-6 py-3 text-center">Conc ng/ul</th>
                    <th scope="col" class="px-6 py-3 text-center">260-280</th>
                    <th scope="col" class="px-6 py-3 text-center">260-230</th>
                    <th scope="col" class="px-6 py-3 text-center">Validacion</th>
                    <th scope="col" class="px-6 py-3 text-center">Fecha Edicion</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="m-3">
        {{ $vextraccions->links() }}
    </div>
</div>
