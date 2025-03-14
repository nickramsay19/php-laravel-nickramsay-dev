@php
    $id = 'input-' . ($name ?? '') . '-' . Str::random(5);

    $inline = isset($inline) && boolval($inline);
    $mylabel = isset($label) ? $label : '';
    \Log::info('got inline' . strval($inline) . ') ' . $mylabel);

    if (!isset($type)) {
        $type = 'text';
    }
@endphp

<div {{ $attributes->class(['flex flex-col gap-1' => !$inline]) }}>
    @if (isset($label) && strlen($label) > 0)
        <label for="{{ $id }}">{{ $label }}</label>
    @endif

    @if ($type == 'textarea')
        <x-input.textarea id="{{ $id }}" type="{{ $type ?? 'text' }}" name="{{ $name ?? '' }}" placeholder="{{ $placeholder ?? ($label ?? '') }}" {{ $attributes->filter(fn ($value, $key) => $key != 'class') }}>
            {{ $slot }}
        </x-input.textarea>
    @else
        <input
            id="{{ $id }}" 
            type="{{ $type ?? 'text' }}" 
            name="{{ $name ?? '' }}" 
            placeholder="{{ $placeholder ?? ($label ?? '') }}" 
            value="{{ $value ?? '' }}" 
            class="px-0.5" 
            {{ $attributes->whereStartsWith('x-') }}
        />
    @endif
</div>