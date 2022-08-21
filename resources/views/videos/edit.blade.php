<x-app-layout>

    <x-slot name="title">{{ $title }}</x-slot>

    <div>
            <h1 class="font-light text-2x1">{{ $title }}</h1>
            <div class="w-20 bg-blue-600 h-1 mt-2 mb-5 rounded-full"></div>
        </div>

    <form action="{{ route('videos.edit', [$playlist->slug, $video->unique_video_id]) }}" method="post" enctype="multipart/form-data" novalidate>
    @csrf
    @method('put')
                <div class="mb-6">
                    <x-label for="title" :value="__('Title')" />
                    <x-input id="title" placeholder="Masukan Title" type="text" class="block mt-1 w-full border-gray-300"  name="title" value="{{old('title') ?? $video->title}}" />
                    @error('title')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
                </div>

                <div class="mb-6">
                    <x-label for="unique_video_id" :value="__('Unique Code')" />
                    <x-input id="unique_video_id" placeholder="Masukan Unique Code" type="text" class="block mt-1 w-full border-gray-300"  name="unique_video_id" value="{{old('unique_video_id') ?? $video->unique_video_id}}" />
                    @error('unique_video_id')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
                </div>

                <div class="flex lg:-mx-2">
                    <div class="lg:px-2 w-full lg:w-1/2 mb-6">
                        <div class="mb-6">
                            <x-label for="episode" :value="__('Episode')" />
                            <x-input id="episode" placeholder="Masukan Episode" type="text" class="block mt-1 w-full border-gray-300"  name="episode" value="{{old('episode') ?? $video->episode}}" />
                            @error('episode')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
                        </div>
                    </div>  
                     
                    
                    <div class="lg:px-2 w-full lg:w-1/2 mb-6">
                    <div class="mb-6">
                        <x-label for="runtime" :value="__('Runtime')" />
                        <x-input id="runtime" placeholder="Masukan Runtime" type="text" class="block mt-1 w-full border-gray-300"  name="runtime" value="{{old('runtime') ?? $video->runtime}}" />
                        @error('runtime')<div class="text-red-500 mt-2">{{ $message }}</div>@enderror
                    </div>
                </div> 
            </div>

            <div class="mb-6">
                <label for="intro" class="flex">
                     <input type="checkbox" name="intro" {{ $video->intro ? 'checked' : '' }} id="intro" class="mr-2 focus:outline-none focus:ring-transparent text-blue-500 rounded border-gray-300">
                        <span class="select-none font-medium uppercase text-sm">INTRO</span>
                </label>
            </div>
            <x-button>Update </x-button>
        </div>
    </form>

</x-app-layout>
