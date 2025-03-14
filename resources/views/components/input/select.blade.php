@props([
    'name' => '',
    'multiple' => false,
    'value' => null,
])

@php 
    if ($multiple && $value == null) {
        $value = '[]';
    } else if ($multiple && is_string($value)) {
        $value = htmlspecialchars_decode($value);
    }
@endphp

<div 
    x-ref="select"
    x-data="{
        value: {{ strval($value) }},
        options: [],
        toggle(event, option) {
            if (option.disabled) {
                return;
            }

            let index = this.value.indexOf(option.value);
            if (index > -1) {
                this.value.splice(index, 1);
            } else {
                this.value.push(option.value);
            }

            this.$refs.select.value = this.value;
            this.$refs.select.dispatchEvent(new Event('input'));
        },
    }"
    x-modelable="value"
    x-init="
        options = Array.from($refs.formSelect.children); 
        value = value?.length ? value : ($el.value ?? []);
    "
    {{ $attributes->whereStartsWith('x-') }}
    {{ $attributes->whereStartsWith(':') }}
    {{ $attributes->class('flex flex-row flex-wrap gap-2 w-full') }}
>
    <select x-ref="formSelect" name="{{ $name }}" x-model="value" class="hidden" {{ $multiple ? 'multiple' : '' }}>
        {{ $slot }}
    </select>

    <template x-for="option in options">
        <option @click="toggle($event, option)" x-html="option.innerHTML" class="bg-transparent" :class="{ [option.classList]: true, 'text-accent font-semibold': value.indexOf(option.value) > -1, 'italic cursor-pointer': !option.disabled }"></option>
    </template>
</div>