@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'h-10 border focus:border-blue-500 focus:outline-none rounded-lg px-3 focus:ring focus:ring-blue-200 transition duration-200']) !!}>
