<x-app-layout>

    <x-slot name="title">  Edit Playlist: {{ $playlist->name }}</x-slot>

    <div>
            <h1 class="font-light text-2x1"> Edit Playlist: {{ $playlist->name }}</h1>
            <div class="w-20 bg-blue-600 h-1 mt-2 mb-5 rounded-full"></div>
        </div>

    <form action="{{ route('playlists.edit', $playlist->slug) }}" method="post" enctype="multipart/form-data" novalidate>
    @csrf
    @method('put')

            <div class="w-full lg:w-1/2">
            <img class="rounded-lg w-full mb-6" src="{{ asset('storage/' . $playlist->thumbnail) }}" alt="{{ $playlist->name }}">
                <input type="file" name="thumbnail" id="thumbnail">
                @error('thumbnail')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
            </div>

            <div class="mb-6">
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" type="text" class="block mt-1 w-full"  name="name" :value="old('name') ?? $playlist->name" />
                @error('name')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
            </div>

            <div class="mb-6">
                <x-label for="price" :value="__('Price')" />
                <x-input id="price" type="text" class="block mt-1 w-full" type="text" name="price" :value="old('price') ?? $playlist->price" />
                @error('price')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
            </div>

            <div class="mb-6">
                <x-label for="description" :value="__('Description')" />
                <textarea id="description" class="block mt-1 w-full focus:outline-none rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" name="description" type="text" required>{{ old('description') ?? $playlist->description }} </textarea>
                @error('description')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
            </div>

            <div class="mb-6">
                <x-label for="tags" value="Tags"></x-label>
                <select multiple name="tags[]" id="tags" class="w-full border focus:border-blue-500 border-gray-300 focus:outline-none rounded-lg px-3 focus:ring focus:ring-blue-200 transition duration-200">
                    @foreach($tags as $tag)
                        <option {{ $playlist->tags()->find($tag->id) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
        <x-button>Update</x-button>
    </form>

</x-app-layout>
