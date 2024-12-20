<div>
    <div>
        <style>
            .porsentaje {
                width: {{ $porsentaje }}%;
            }
        </style>

        <div class="">
            {{-- steps --}}
            <div class="">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-300">{{ $currentStep }} / {{ $totalSteps }}
                    -
                    {{ $titles[$currentStep] }}</p>
                <div class="mt-4 overflow-hidden rounded-full bg-gray-300 w-full">
                    <div class="h-1 rounded-full bg-lime-600 porsentaje"></div>
                </div>
            </div>

            <x-message />

            <form wire:submit.prevent="register" class="bg-slate-300 dark:bg-slate-800 p-5 rounded-md mt-3">

                @if ($currentStep == 1)
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
                @endif

                @if ($currentStep == 2)
                @endif

                @if ($currentStep == 3)
                @endif

                {{-- contenedor botones --}}
                <div class="flex justify-between mt-10">
                    @if ($currentStep > 1 && $currentStep <= $totalSteps)
                        <x-danger-button wire:click="decreaseStep" type="button">Anterior</x-danger-button>
                    @else
                        <div><x-danger-button wire:click="cancelRegister" type="button">Cancelar</x-danger-button>
                        </div>
                    @endif

                    @if ($currentStep < $totalSteps)
                        <x-button wire:click="increaseStep" type="button">Siguiente</x-button>
                    @elseif ($currentStep == $totalSteps)
                        <x-button type="submit">Guardar</x-button>
                    @endif
                </div>

            </form>

        </div>

        <div class="bg-gray-500 dark:bg-gray-900 opacity-75 fixed z-[10000] left-0 top-0 h-screen w-full  items-center justify-center hidden"
        wire:loading.class.remove="hidden" wire:loading.class="flex"
        wire:target="register,decreaseStep,cancelRegister,increaseStep">

        <div class="preloader_box">
            <img src="{{ asset('images/G_Logo.png') }}" alt="" class="preloader_img">
            <div class="lds-dual-ring"></div>
        </div>

    </div>
    </div>
</div>
