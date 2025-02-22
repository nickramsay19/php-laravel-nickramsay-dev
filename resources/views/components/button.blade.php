<button {{ $attributes->merge(['class' => 'text-sm font-semibold border border-accent']) }}>
    {{ $slot }}
</button>