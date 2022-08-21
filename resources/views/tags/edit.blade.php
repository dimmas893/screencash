<x-app-layout>

    <x-slot name="title">  Edit Tag: {{ $tag->name }}</x-slot>

        <div>
            <h1 class="font-light text-2x1"> Edit Tags: {{ $tag->name }}</h1>
            <div class="w-20 bg-blue-600 h-1 mt-2 mb-5 rounded-full"></div>
        </div>

            <form action="{{ route('tags.edit', $tag->slug) }}" method="post" novalidate>
                @csrf
                @method('put')
                <div class="mb-6">
                    <x-label for="name" :value="__('Name')" />
                    <x-input id="name" type="text" placeholder="Masukan Tags" class="mt-2 block mt-1 w-full border-gray-300"  name="name" value="{{old('name') ?? $tag->name}}" />
                    @error('name')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
                </div>

                 <x-button>Update</x-button>
            </form>
</x-app-layout>
