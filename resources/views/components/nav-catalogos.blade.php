<div class="w-full flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $title}}
    </h2>
    <div class="flex gap-10">
        <x-nav-link href="{{route('catalogos.analises')}}" :active="request()->routeIs('catalogos.analises')" wire:navigate.hover>Analisis</x-nav-link>
        <x-nav-link href="{{route('catalogos.especies')}}" :active="request()->routeIs('catalogos.especies')" wire:navigate.hover>Especies</x-nav-link>
        <x-nav-link href="{{route('catalogos.metodos')}}" :active="request()->routeIs('catalogos.metodos')" wire:navigate.hover>Metodo</x-nav-link>
    </div>
</div>