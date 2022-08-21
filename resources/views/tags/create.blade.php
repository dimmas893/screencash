<x-app-layout>
    <x-slot name="title">Create new Tag</x-slot>
         <div>
            <h1 class="font-light text-2x1">Create New Tags</h1>
            <div class="w-20 bg-blue-600 h-1 mt-2 mb-5 rounded-full"></div>
        </div>

        <form action="{{ route('tags.create') }}" method="post" novalidate>
            @csrf

            <div class="mb-6">
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" type="text" placeholder="Masukan Tags" class="mt-2 block mt-1 w-full border-gray-300"  name="name" :value="old('name')" />
                @error('name')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
            </div>

        <x-button>Create</x-button>
    </form>
</x-app-layout>
