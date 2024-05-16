<div class="w-full flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $title}}
    </h2>
    <div class="flex gap-10">
        <x-nav-link href="{{route('inventarios.equipos')}}" :active="request()->routeIs('inventarios.equipos')" wire:navigate.hover>Equipos</x-nav-link>
        <x-nav-link href="{{route('inventarios.reactivos')}}" :active="request()->routeIs('inventarios.reactivos')" wire:navigate.hover>Reactivos</x-nav-link>
    </div>
</div>