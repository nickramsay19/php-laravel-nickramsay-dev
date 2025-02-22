@if ((isset($disabled) && $disabled) || (!isset($href) && !isset($to)))
    <span {{ $attributes->merge(['class' => 'text-disabled']) }}>
        {{ $slot }}
    </span>
@else
    <a href="{{ $href ?? route($to) }}" {{ $attributes->merge(['class' => 'text-accent hover:text-highlight no-underline']) }}>
        {{ $slot }}
    </a> 
@endif