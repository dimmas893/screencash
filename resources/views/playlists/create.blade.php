<x-app-layout>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </head>

    <x-slot name="title"> Create new Playlist</x-slot>

    <div>
            <h1 class="font-light text-2x1">Create New Playlist</h1>
            <div class="w-20 bg-blue-600 h-1 mt-2 mb-5 rounded-full"></div>
        </div>

    <form action="{{ route('playlists.create') }}" method="post" enctype="multipart/form-data" novalidate>
    @csrf

           <div class="mb-6">
                <input type="file" name="thumbnail" id="thumbnail">
                @error('thumbnail')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
            </div>

            <div class="mb-6">
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" placeholder="Masukan Name" type="text" class="block mt-1 w-full border-gray-300"  name="name" :value="old('name')" />
                @error('name')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
            </div>

            <div class="mb-6">
                <x-label for="price" :value="__('Price')" />
                <x-input id="price" placeholder="Masukan Nominal" type="text" class="block mt-1 w-full border-gray-300"  name="price" :value="old('price')" />
                @error('price')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
            </div>

            <div class="mb-6">
                <x-label for="description" :value="__('Description')" />
                <textarea id="description" placeholder="Masukan Description" class="block mt-2 w-full focus:outline-none rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" name="description" required>{{ old('description') }} </textarea>
                @error('description')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
            </div>

            <!-- <div class="mb-6">
                <x-label for="tags" value="Tags"></x-label>
                <select multiple name="tags[]" id="tags" class="w-full border focus:border-blue-500 border-gray-300 focus:outline-none rounded-lg px-3 focus:ring focus:ring-blue-200 transition duration-200">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div> -->

            <div class="mb-6">
                <x-label for="tags" value="Tags"></x-label>
                <select multiple name="tags[]" id="tags" class="js-example-basic-multiple w-full border focus:border-blue-500 border-gray-300 focus:outline-none rounded-lg px-3 focus:ring focus:ring-blue-200 transition duration-200">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>


        <x-button>Create</x-button>
    </form>




    <script src="/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        });
    </script>

</x-app-layout>
