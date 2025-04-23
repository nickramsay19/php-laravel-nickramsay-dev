<div {{ $attributes->merge(['class' => 'flex flex-row justify-between']) }}>
    <div>
        <span>{{ $page }} / {{ $totalPages }}</span>
    </div>

    <div class="flex flex-row gap-2">
        <x-link href="?page={{ $page - 1 }}" class="underline" :disabled="$page <= 1">prev</x-link>
        <x-link href="?page={{ $page + 1 }}" class="underline" :disabled="$page >= $totalPages">next</x-link>
    </div>
</div>