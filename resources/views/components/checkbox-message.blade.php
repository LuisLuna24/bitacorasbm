<div class="flex justify-center items-center mb-1">
    <input type="checkbox" {!! $attributes->merge([
        'class' =>
            'rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-lime-600 shadow-sm focus:ring-lime-500 dark:focus:ring-lime-600 dark:focus:ring-offset-gray-800',
    ]) !!}>
    <label for="checkbox" class="ml-1">{{ $slot }}</label>
</div>
