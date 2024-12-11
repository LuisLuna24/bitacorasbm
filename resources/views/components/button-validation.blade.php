<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-lime-600 dark:bg-lime-600 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-lime-700 dark:hover:bg-lime-700 focus:bg-lime-700 dark:focus:bg-lime-700 active:bg-lime-900 dark:active:bg-lime-900 focus:outline-none focus:ring-2 focus:bg-lime-900 focus:ring-offset-2 dark:focus:bg-lime-900 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="icon icon-tabler icons-tabler-outline icon-tabler-file-check">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
        <path d="M9 15l2 2l4 -4" />
    </svg>{{ $slot }}
</button>
