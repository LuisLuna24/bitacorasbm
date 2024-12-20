<div>
    <x-message />
    <div class=" border-b-slate-500 border-b-2 md:col-span-2 text-slate-500 flex justify-between items-end pb-1">
        <p>Editar datos de inicio de secion</p>
        <x-button-return href="{{route('admin.registros.empleados')}}">Regresar</x-button-return>
    </div>
    <form wire:submit="editUser" class="bg-slate-300 dark:bg-slate-800 p-5 rounded-md mt-3">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="flex flex-col">
                <label for="">Nombre de usuario:</label>
                <x-input type="text" wire:model="nombre_usuario" onkeyup="mayuscula(this)" />
                <x-input-error for="nombre_usuario" class="mt-2" />
            </div>
            <div class="flex flex-col">
                <label for="">Correo:</label>
                <x-input type="email" wire:model="correo" />
                <x-input-error for="correo" class="mt-2" />
            </div>
        </div>
        <div class="flex justify-end mt-5">
            <x-button>
                Guardar
            </x-button>
        </div>
    </form>

    <div class=" border-b-slate-500 border-b-2 md:col-span-2 text-slate-500 mt-5">
        <p>Restaurar contraseña</p>
    </div>
    <form wire:submit="resetPassword" class="bg-slate-300 dark:bg-slate-800 p-5 rounded-md mt-3">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="flex flex-col">
                <label for="">Contraseña:</label>
                <x-input type="password" wire:model="contraseña" />
                <x-input-error for="contraseña" class="mt-2" />
            </div>

            <div class="flex flex-col">
                <label for="">Confirmar contraseña:</label>
                <x-input type="password" wire:model="contraseña_confirmation" />
                <x-input-error for="contraseña_confirmation" class="mt-2" />
            </div>
        </div>
        <div class="flex justify-end mt-5">
            <x-button>
                Guardar
            </x-button>
        </div>
    </form>

    <div class=" border-b-slate-500 border-b-2 md:col-span-2 text-slate-500 mt-5">
        <p>Datos de empleado</p>
    </div>
    <form wire:submit="editEmpleado" class="bg-slate-300 dark:bg-slate-800 p-5 rounded-md mt-3">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="flex flex-col md:col-span-2">
                <label for="">No. Empleado:</label>
                <x-input type="number" wire:model="no_empleado" />
                <x-input-error for="no_empleado" class="mt-2" />
            </div>
            <div class="flex flex-col md:col-span-2">
                <label for="">Nombre:</label>
                <x-input type="text" wire:model="nombre" onkeyup="mayuscula(this)" />
                <x-input-error for="nombre" class="mt-2" />
            </div>
            <div class="flex flex-col">
                <label for="">Apellido Paterno:</label>
                <x-input wire:model="ap_paterno" onkeyup="mayuscula(this)" />
                <x-input-error for="ap_paterno" class="mt-2" />
            </div>
            <div class="flex flex-col">
                <label for="">Apellido Materno:</label>
                <x-input wire:model="ap_materno" onkeyup="mayuscula(this)" />
                <x-input-error for="ap_materno" class="mt-2" />
            </div>
            
        </div>
        <div class="flex justify-end mt-5">
            <x-button>
                Guardar
            </x-button>
        </div>
    </form>

    <div class="bg-gray-500 dark:bg-gray-900 opacity-75 fixed z-[10000] left-0 top-0 h-screen w-full  items-center justify-center hidden"
        wire:loading.class.remove="hidden" wire:loading.class="flex"
        wire:target="editEmpleado,resetPassword,editUser">

        <div class="preloader_box">
            <img src="{{ asset('images/G_Logo.png') }}" alt="" class="preloader_img">
            <div class="lds-dual-ring"></div>
        </div>

    </div>
</div>
