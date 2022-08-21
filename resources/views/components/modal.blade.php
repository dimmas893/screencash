<div  {{ $attributes->merge(["class"=>"absolute inset-0 w-full h-full bg-opacity-70 bg-black flex justify-center items-center"]) }}>
    <div class="bg-white md:max-w-xl w-1/2 rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
            <div>
                {{$title}}
            </div>
            <button class="focus:outline-none" @click="{{ $state }} = false">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>


            <div class="p-6">
                {{ $slot }}
            </div>
    </div>
</div>