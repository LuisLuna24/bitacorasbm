<div class="flex flex-wrap justify-center items-center gap-5">
    @if (session('add_msg'))
        <x-alert-add>
            <x-slot name="content">{{ session('add_msg') }}</x-slot>
        </x-alert-add>
    @endif

    @if (session('up_msg'))
        <x-alert-up>
            <x-slot name="content">{{ session('up_msg') }}</x-slot>
        </x-alert-up>
    @endif
    @if (session('down_msg'))
        <x-alert-down>
            <x-slot name="content">{{ session('down_msg') }}</x-slot>
        </x-alert-down>
    @endif


    <x-card>
        <x-slot name="title">
            Usuarios
        </x-slot>
        <x-slot name="body">
            <p>Agrega, editar, borrar y permisos de usuarios</p>
            <br>
            <x-button wire:click="user">Acceder</x-button>
        </x-slot>
    </x-card>

    <!-- ------------------------------------------------------------------------------------Usuarios------------ -->
    <x-dialog-modal wire:model="open_users">
        <x-slot name='title'>
            <h2 class="text-center">Usuarios</h2>
            @if (session('add_msg'))
                <x-alert-add>
                    <x-slot name="content">{{ session('add_msg') }}</x-slot>
                </x-alert-add>
            @endif

            @if (session('up_msg'))
                <x-alert-up>
                    <x-slot name="content">{{ session('up_msg') }}</x-slot>
                </x-alert-up>
            @endif
            @if (session('down_msg'))
                <x-alert-down>
                    <x-slot name="content">{{ session('down_msg') }}</x-slot>
                </x-alert-down>
            @endif
        </x-slot>
        <x-slot name='content'>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                    wire:model="currentPageTable1">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">Nombre</th>
                            <th scope="col" class="px-6 py-3 text-center">Correo</th>
                            <th scope="col" class="px-6 py-3 text-center">Editar</th>
                            <th scope="col" class="px-6 py-3 text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                    wire:key="analisis-{{ $usuario->id }}">
                                    {{ $usuario->name }}
                                </th>
                                <td class="px-6 py-4 text-center">
                                    {{ $usuario->email }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <x-button wire:click="editUser({{ $usuario->id }})"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-user-edit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                            <path
                                                d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                        </svg></x-button>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <x-danger-button wire:click="deleteUser({{ $usuario->id }})"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-user-x">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                            <path d="M22 22l-5 -5" />
                                            <path d="M17 22l5 -5" />
                                        </svg></x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <!-- ------------------------------------------------------------------------------------editar Usuario------------ -->
    <x-dialog-modal wire:model="edit_user">
        <x-slot name='title'>
            <h2 class="text-center">Editar usuario</h2>
        </x-slot>
        <x-slot name='content'>
            <form wire:submit="updateUser">
                <div>
                    <x-label>Nombre:</x-label>
                    <x-input wire:model="userEdit.name" type="text" class="block mt-1 w-full" />
                    <x-input-error for="userEdit.name" />
                </div>
                <div>
                    <x-label>Correo:</x-label>
                    <x-input wire:model="userEdit.email" type="text" class="block mt-1 w-full" />
                    <x-input-error for="userEdit.email" />
                </div>
                @if(auth()->user()->nivel === 3)
                <div>
                    <x-label>Nivel:</x-label>
                    <x-select wire:model="userEdit.nivel" type="text" class="block mt-1 w-full">
                        <option value="">Seleccionar Nivel</option>
                        <option value="1">Usuario</option>
                        <option value="2">Administrador</option>
                    </x-select>
                    <x-input-error for="userEdit.nivel" />
                </div>
                @endif
                <div class="mt-5 flex justify-around">
                    <x-button>Actualizar</x-button>
                    <x-danger-button wire:click="cancel_user">Cancelar</x-danger-button>
                </div>
            </form>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>

    <!-- ------------------------------------------------------------------------------------delte Usuario------------ -->
    <x-dialog-modal wire:model="delete_user">
        <x-slot name='title'>
            <h2 class="text-center">Eliminar usuario</h2>
        </x-slot>
        <x-slot name='content'>
            <div>
                <div>
                    <x-label>Nombre:</x-label>
                    <x-input wire:model="userDelete.name" type="text" class="block mt-1 w-full" />
                    <x-input-error for="userDelete.name" />
                </div>
                <div class="mt-5 flex justify-around">
                    <x-button wire:click='down_user'>Eliminar</x-button>
                    <x-danger-button wire:click="cancel_user">Cancelar</x-danger-button>
                </div>
            </div>
        </x-slot>
        <x-slot name='footer'></x-slot>
    </x-dialog-modal>
</div>
