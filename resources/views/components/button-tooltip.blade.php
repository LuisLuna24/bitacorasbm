@props(['value'])

<button
    {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-lime-600 dark:bg-lime-600 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white tracking-widest hover:bg-lime-700 dark:hover:bg-lime-700 focus:bg-lime-700 dark:focus:bg-lime-700 active:bg-lime-900 dark:active:bg-lime-900 focus:outline-none focus:ring-2 focus:bg-lime-900 focus:ring-offset-2 dark:focus:bg-lime-900 disabled:opacity-50 transition ease-in-out duration-150']) }}
    data-tippy-content="{{ $messageText }}">

    {{ $value ?? $slot }}
    

</button>
