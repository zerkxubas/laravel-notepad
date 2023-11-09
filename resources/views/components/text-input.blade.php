@props(['disabled' => false, 'field' => ''])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm' .
        ($errors->has($field) ? ' border-red-500' : ' border-gray-300'),
]) !!}>

@error($field)
    <span class="text-red-600 text-xs px-2"><i class="fa-regular fa-circle-xmark pe-2"></i>{{ $message }}</span>
@enderror
