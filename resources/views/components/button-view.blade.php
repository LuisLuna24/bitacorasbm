<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-lime-600 dark:bg-lime-600 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-lime-700 dark:hover:bg-lime-700 focus:bg-lime-700 dark:focus:bg-lime-700 active:bg-lime-900 dark:active:bg-lime-900 focus:outline-none focus:ring-2 focus:bg-lime-900 focus:ring-offset-2 dark:focus:bg-lime-900 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>{{$slot}}
</button>






