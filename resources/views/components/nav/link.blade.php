@if (isset($to)) 
     <x-link :to="$to" disabled="{{ $disabled ?? Request::routeIs($to) }}" {{ $attributes }}>{{ $slot }}</x-link> 
@elseif (isset($href))
    <x-link :href="$href" disabled="{{ $disabled ?? Request::is($href) }}" {{ $attributes }}>{{ $slot }}</x-link> 
@else
    <x-link href="#" disabled {{ $attributes }}>{{ $slot }}</x-link> 
@endif