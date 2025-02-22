@php
    $id = 'input-' . ($name ?? '') . '-' . Str::random(5);
@endphp

<div style="margin-top: 1em; display: block;">
    @if (isset($label) && strlen($label) > 0)
        <label for="{{ $id }}">{{ $label }}</label>
    @endif

    @if (!isset($type) || $type != 'textarea')
        <x-form.input id="{{ $id }}" type="{{ $type ?? 'text' }}" name="{{ $name ?? '' }}" placeholder="{{ $placeholder ?? ($label ?? '') }}" value="{{ $value ?? '' }}" />
    @else
        <x-form.textarea id="{{ $id }}" type="{{ $type ?? 'text' }}" name="{{ $name ?? '' }}" placeholder="{{ $placeholder ?? ($label ?? '') }}" {{ $attributes }}>
            {{ $slot }}
        </x-form.textarea>
    @endif
</div>