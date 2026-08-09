@props(['disabled' => false, 'for' => 'noname'])

<input 
    id="{{ $for }}" 
    {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge(['class' => 'form-control' . (session('errors') && $errors->has($for) ? ' is-invalid' : '')]) !!} 
>