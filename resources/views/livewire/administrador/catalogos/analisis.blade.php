<div>
    <section class="flex flex-col md:flex-row w-full gap-3 mb-5 items-end">
        <div class="flex flex-col">
            <label for="">Mostar:</label>
            <x-select wire:model.change="pageView">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </x-select>
        </div>
        <div class="flex flex-col">
            <label for="">Estatus:</label>
            <x-select wire:model.change="estatus">
                <option value="">Todos</option>
                <option value="1">Activos</option>
                <option value="2">Inactivos</option>
            </x-select>
        </div>
        <div class="flex flex-col w-full">
            <label for="">Buscar:</label>
            <x-input wire:model.live="search" placeholder="(Nombre)" />
        </div>
        <div>
            <x-button-new wire:click="newRegister" />
        </div>
    </section>
    <section>
        <x-table>
            <x-slot name="titles">
                <x-th>No.</x-th>
                <x-th>Nombre</x-th>
                <x-th>Versión</x-th>
                <x-th>Editar</x-th>
                <x-th>Estatus</x-th>
            </x-slot>
            <x-slot name="content">
                @forelse ($collection as $index => $item)
                    <x-tr>
                        <x-td  wire:key="ite-{{$item->id}}">{{ $index + 1 }}</x-td>
                        <x-td>{{ $item->nombre }}</x-td>
                        <x-td>{{ $item->version }}</x-td>
                        <x-td><x-button-edit wire:click="editRegister({{$item->id}})"></x-button-edit></x-td>
                        <x-td>{{$item->estatus == 1 ? 'Activo' : ($item->estatus == 2 ? 'Inactivo' : 'Sin identificar') }}</x-td>
                    </x-tr>
                @empty
                    <x-tr>
                        <td colspan="5" class="px-6 py-4 text-center">Sin Resultados</td>
                    </x-tr>    
                @endforelse
            </x-slot>
        </x-table>
        <div class="mt-5">
            {{$collection->onEachSide(1)->links()}}
        </div>
    </section>

    <x-dialog-modal wire:model="modal">
        <x-slot name="title">
            Nuevo Análisis
        </x-slot>
        <x-slot name="content">
            <form wire:submit="submitForm">
                <div class="flex flex-col">
                    <label for="">Nombre</label>
                    <x-input wire:model="nombre" />
                </div>
                <div class="flex justify-between mt-3">
                    <x-button>Guardar</x-button>
                    <x-danger-button wire:click="closeModal" >Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
</div>
