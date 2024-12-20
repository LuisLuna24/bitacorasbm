@props(['value'])

<div class="flex">
    <label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
        {{ $value ?? $slot }}
    </label>
    <label class="text-red-600">*</label>
</div>