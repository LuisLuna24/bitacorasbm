<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">Inventario</th>
                <th scope="col" class="px-6 py-3 text-center">Equipo</th>
                <th scope="col" class="px-6 py-3 text-center">Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipos_extraccion as $equipo)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center" wire:key="analisis-{{ $equipo->id }}">
                    {{$equipo->equipos->inventario}}
                </th>
                <td class="px-6 py-4 text-center">
                    {{$equipo->equipos->nombre}}
                </td>
                <td class="px-6 py-4 text-center">
                    {{$equipo->equipos->descripcion}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
