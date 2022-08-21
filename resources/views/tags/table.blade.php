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
                <th class="border-b border-gray-400 py-2 text-left px-2">Playlist</th>
                @can('admin')
                <th class="border-b border-gray-400 py-2 text-left px-2">Action</th>
                @endcan
              </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag) 
                    <tr>   
                        <td class="border-b border-gray-300 py-2 text-left px-2">{{ $tags->count() * ($tags->currentPage() - 1) + $loop->iteration }}</td>
                        <td class="border-b border-gray-300 py-2 text-left px-2">{{ $tag->name }}</td>
                        <td class="border-b border-gray-300 py-2 text-left px-2">{{ $tag->playlists_count }}</td>
                        <td class="border-b border-gray-300 py-2 text-left px-2">
                            @can('admin')
                        <div class="flex items-center">
                            <a href="{{ route('tags.edit', $tag->slug) }}" class="text-blue-500 mr-2 hover:text-blue-600 fond-medium underline uppercase text-sm">Edit</a>
                                <div x-data="{ open: false }">
                                    <x-modal state="open" x-show="open" title="Are you sure ?">
                                        <div class="flex items-center">
                                            <form class="mr-4" action="{{ route('tags.delete', $tag->slug) }}" method="post">
                                                @csrf 
                                                @method('delete')
                                                <x-button>Yes</x-button>
                                            </form>
                                            <x-button  @click="open = false">No</x-button>
                                        </div>
                                    </x-modal>
                                    <button @click="open = true" type="submit" class="text-red-500 hover:text-red-600 fond-medium underline uppercase text-sm">Delete</button>
                                </div>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>

        <div>
        {{ $tags->links() }}
        </div>
</x-app-layout>
