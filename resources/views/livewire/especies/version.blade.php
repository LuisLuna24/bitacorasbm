<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-center">vercion</th>
                    <th scope="col" class="px-6 py-3 text-center">Usuario</th>
                    <th scope="col" class="px-6 py-3 text-center">Fecha Edicion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vespecies as $especie)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{$especie->nombre}}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{$especie->version}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$especie->user->name}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$especie->created_at->format('d-m-Y')}}
                            </td>

                        </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    <div class="m-3">
        {{$vespecies->links()}}
    </div>
</div>
