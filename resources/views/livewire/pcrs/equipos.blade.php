<div class="mt-3">
    <div>
        <h2 class="text-center text-black dark:text-white text-2xl">
            Equipos
        </h2>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" wire:model="currentPageTable1">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">Inevntario</th>
                    <th scope="col" class="px-6 py-3 text-center">Nombre</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($equipos_pcr as $equipo_pcr)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center" wire:key="analisis-{{ $equipo_pcr->id }}">
                            {{$equipo_pcr->equipos->inventario}}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center" wire:key="analisis-{{ $equipo_pcr->id }}">
                            {{$equipo_pcr->equipos->nombre}}
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{$equipos_pcr->links()}}
</div>
