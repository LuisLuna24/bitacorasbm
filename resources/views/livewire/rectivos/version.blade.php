<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-center">Lote</th>
                    <th scope="col" class="px-6 py-3 text-center">Descripcion</th>
                    <th scope="col" class="px-6 py-3 text-center">Version</th>
                    <th scope="col" class="px-6 py-3 text-center">Existencia</th>
                    <th scope="col" class="px-6 py-3 text-center">Usuario</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vreactivos as $reactivos)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                {{$reactivos->nombre}}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{$reactivos->lote}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$reactivos->description}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$reactivos->version}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$reactivos->existencia}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$reactivos->user->name}}
                            </td>
                        </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    <div class="m-3">
        {{$vreactivos->links()}}
    </div>
</div>
