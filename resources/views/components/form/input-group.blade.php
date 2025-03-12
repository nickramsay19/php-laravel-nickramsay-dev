@php
    $id = 'input-' . ($name ?? '') . '-' . Str::random(5);

    $inline = isset($inline) && $inline;

    if (!isset($type)) {
        $type = 'text';
    }
@endphp

<div {{ $attributes->class(['flex flex-col gap-1' => !$inline]) }}>
    @if (isset($label) && strlen($label) > 0)
        <label for="{{ $id }}">{{ $label }}</label>
    @endif


    @if ($type == 'textarea')
        <x-form.textarea id="{{ $id }}" type="{{ $type ?? 'text' }}" name="{{ $name ?? '' }}" placeholder="{{ $placeholder ?? ($label ?? '') }}" {{ $attributes->filter(fn ($value, $key) => $key != 'class') }}>
            {{ $slot }}
        </x-form.textarea>
    @else
        <x-form.input id="{{ $id }}" type="{{ $type ?? 'text' }}" name="{{ $name ?? '' }}" placeholder="{{ $placeholder ?? ($label ?? '') }}" value="{{ $value ?? '' }}" />
    @endif
</div>