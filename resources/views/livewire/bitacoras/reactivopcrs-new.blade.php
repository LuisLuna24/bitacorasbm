<div>
    <form class="grid gap-3" wire:submit="create">
        <div class="grid grid-cols-1 max-md:grid-cols-1 gap-5">
            <div class="grid grid-cols-2 max-md:grid-cols-1 gap-3">
                <div class="flex flex-col">
                    <label for="">Reactivo:</label>
                    <x-select wire:model="reactivo">
                        @foreach ($reactivos as $reactivo)
                            <option value="{{ $reactivo->id }}">{{ $reactivo->nombre }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="reactivo" />
                </div>
                <div class="flex flex-col">
                    <label for="">Fecha Apertura::</label>
                    <x-input type="date" wire:model='fecha_apertura' />
                    <x-input-error for="fecha_apertura" />
                </div>
            </div>

            <div class="grid gap-3 w-full">
                <div class="w-full">
                    <x-input wire:model.live="search_registro" placeholder="Buscar(no_registro)" class="w-full" />
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">No. Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rpcrs as $rpcr)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                        wire:key="rpcr-{{ $rpcr->id }}">
                                        <x-checkbox wire:model="selectedTagsEspecie"
                                            value="{{ $rpcr->id }} " /><span
                                            class="text-white">{{ $rpcr->no_registro }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-5 flex justify-around">
            <x-button>Agregar</x-button>
            <x-danger-button wire:click="cancel_new">Cancelar</x-danger-button>
        </div>
    </form>
</div>
