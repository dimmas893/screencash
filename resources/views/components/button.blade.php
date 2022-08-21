<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 h-10 bg-blue-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring ring-blue-200 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
