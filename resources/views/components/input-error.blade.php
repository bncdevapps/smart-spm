@props(['for'])

@error($for)
<p {{ $attributes->merge(['class' => 'text-danger', 'style' => 'font-size:.875em;']) }}>{{ $message }}</p>
@enderror