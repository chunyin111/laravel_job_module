@props(['name'])
@error($name)
    <p {{ $attributes->merge(['class' => 'text-red-500 text-sm font-semibold mt-1']) }}> {{ $message }} </p>
@enderror
