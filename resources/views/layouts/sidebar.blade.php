<div class="w-1/5 bg-gray-800 min-h-screen px-4 py-6">
<div class="mb-8">
        <header class="font-medium px-2 text-gray-400 uppercase text-xs">Main</header>
        <a href="{{ route('dashboard') }}" class="block text-gray-200 px-2 py-2">Dashboard</a>
    </div>

    @can('create playlist')
    <div class="mb-8">
        <header class="font-medium px-2 text-gray-400 uppercase text-xs">Playlist</header>
        <a href="{{ route('playlists.create') }}" class="block text-gray-200 px-2 py-2">Create</a
        ><a href="{{ route('playlists.table') }}" class="block text-gray-200 px-2 py-2">Table</a>
    </div>
    @endcan

    @can('create tags')
    <div class="mb-8">
        <header class="font-medium px-2 text-gray-400 uppercase text-xs">Tags</header>
        <a href="{{ route('tags.create') }}" class="block text-gray-200 px-2 py-2">Create</a
        ><a href="{{ route('tags.table') }}" class="block text-gray-200 px-2 py-2">Table</a>
    </div>
    @endcan

    @can('show users')
    <div class="mb-8">
        <header class="font-medium px-2 text-gray-400 uppercase text-xs">User</header>
        <a href="#" class="block text-gray-200 px-2 py-2">Table</a>
    </div> 
    @endcan
    
    <div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            
            <a href="route('logout')" class="font-medium px-2 text-gray-400 uppercase text-xs block text-gray-200 px-2 py-2"
            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
</div>