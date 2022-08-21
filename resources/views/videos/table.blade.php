<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

        <div>
            <h1 class="font-light text-2x1">{{ $title }}</h1>
            <div class="w-20 bg-blue-600 h-1 mt-2 mb-5 rounded-full"></div>
        </div>
    <!-- table -->
        <table class="w-full">
        <thead>
              <tr>
                <th class="border-b border-gray-400 py-2 text-left px-2">No</th>
                <th class="border-b border-gray-400 py-2 text-left px-2">Episode</th>
                <th class="border-b border-gray-400 py-2 text-left px-2">Intro</th>
                <th class="border-b border-gray-400 py-2 text-left px-2">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($videos as $video) 
                    <tr>
                        <td class="border-b border-gray-300 py-2 text-left px-2">{{ $videos->count() * ($videos->currentPage() - 1) + $loop->iteration }}</td>

                        <td class="border-b border-gray-300 py-2 text-left px-2">{{ $video->title }}</td>
                        <td class="border-b border-gray-300 py-2 text-left px-2">
                            <span class="uppercase font-semibold text-xs">{{ $video->intro ? 'Yes' : 'No' }}</span>
                        </td>
                        <td class="border-b border-gray-300 py-2 text-left px-2">
                                <div class="flex items-center">
                                     <a class="text-blue-500 mr-2 hover:text-blue-600 fond-medium underline uppercase text-sm" href="{{ route('videos.edit', [$playlist, $video->unique_video_id]) }}">edit</a>
                                        <div x-data="{ open: false }">
                                            <x-modal state="open" x-show="open" title="Are you sure ?">
                                                <div class="mb-5">
                                                    <h4 class="text-lg capitalize">{{ $video->title }}</h4>
                                                    <span class="text-xs uppercase text-gray-600">Episode: {{ $video->episode }}</span>
                                                    <span class="text-xs uppercase text-gray-600">-</span>
                                                    <span class="text-xs uppercase text-gray-600">Runtime: {{ $video->runtime }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <form class="mr-4" action="{{ route('videos.delete', [$playlist->slug, $video->unique_video_id]) }}" method="post">
                                                        @csrf 
                                                        @method('delete')
                                                        <x-button>Yes</x-button>
                                                    </form>
                                                    <x-button  @click="open = false">No</x-button>
                                                </div>
                                            </x-modal>
                                            <button @click="open = true" type="submit" class="text-red-500 hover:text-red-600 fond-medium underline uppercase text-sm">Delete</button>
                                        </div>
                                    </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
         {{ $videos->links() }}
</x-app-layout>
