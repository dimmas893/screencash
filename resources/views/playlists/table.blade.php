<x-app-layout>
    <x-slot name="title"> Table Playlist</x-slot>

        <div>
            <h1 class="font-light text-2x1">Table Playlist</h1>
            <div class="w-20 bg-blue-600 h-1 mt-2 mb-5 rounded-full"></div>
        </div>
    <!-- table -->
        <table class="w-full">
        <thead>
              <tr>
                <th class="border-b border-gray-400 py-2 text-left px-2">No</th>
                <th class="border-b border-gray-400 py-2 text-left px-2">Name</th>
                <th class="border-b border-gray-400 py-2 text-left px-2">Published</th>
                <th class="border-b border-gray-400 py-2 text-left px-2">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($playlists as $item) 
                    <tr>
                        <td class="border-b border-gray-300 py-2 text-left px-2">{{ $playlists->count() * ($playlists->currentPage() - 1) + $loop->iteration }}</td>
                        <td class="border-b border-gray-300 py-2 text-left px-2">
                            <div>
                                <a class="block text-blue-500 hover:text-blue-600 hover:underline text-sm" href="{{ route('videos.table', $item->slug) }}">
                                    {{ $item->name }}
                                </a>
                                @foreach($item->tags as $tag)
                                   <span class="mr-1 text-xs">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="border-b border-gray-300 py-2 text-left px-2">{{ $item->created_at->format("d F, Y") }}</td>
                        <td class="border-b border-gray-300 py-2 text-left px-2">
                            <div class="flex items-center">
                                <a href="{{ route('videos.create', $item->slug) }}" class="text-blue-500 hover:text-blue-600 fond-medium underline uppercase text-sm">Add Video</a>
                                <a href="{{ route('playlists.edit', $item->slug) }}" class="text-blue-500 mx-2 hover:text-blue-600 fond-medium underline uppercase text-sm">Edit</a>
                                <div x-data="{ open: false }">
                                    <x-modal state="open" x-show="open" title="Are you sure ?">
                                        <div class="flex items-center">
                                            <form class="mr-4" action="{{ route('playlists.delete', $item->slug) }}" method="post">
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
         {{ $playlists->links() }}
</x-app-layout>
