@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-orange-700']) }}>
    {{ $value ?? $slot }}
</label>
