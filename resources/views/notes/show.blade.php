<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request()->routeIs('notes.show') ? __('Notes') : __('Trash Notes') }}
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900 text-center font-bold text-2xl underline hover:cursor-pointer">
        @if (request()->routeIs('notes.show'))
            <i class="fa-solid fa-book-open pe-2 text-gray-600"></i>{{ __('View Note') }}
        @else
            <i class="fa-regular fa-trash-can pe-2 text-gray-600"></i>{{ __('Trash Note Review') }}
        @endif
    </div>
    <div class="max-w-7xl mx-auto text-end mb-5 sm:px-6 lg:px-8 ">
        @if (request()->routeIs('notes.show'))
            <a href="{{ route('notes.index') }}" class="rounded-full bg-gray-700 text-white px-7 py-2 hover:bg-slate-600">
                <i class="fa-solid fa-arrow-left-long pe-2 fa-lg"></i>
                Back To Notes</a>
        @else
            <a href="{{ route('trash.view') }}" class="rounded-full bg-gray-700 text-white px-7 py-2 hover:bg-slate-600">
                <i class="fa-solid fa-arrow-left-long pe-2 fa-lg"></i>
                Back To Trash</a>
        @endif
    </div>
    @if (session()->has('success'))
        <div class="text-center text-green-500">
            <i class="fa-solid fa-check pe-2"></i>{{ session('success') }}
        </div>
    @endif
    <div class="py-3">
        <div class="max-w-7xl mx-auto mb-5 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <div class="lg:flex justify-between">
                    <span class="text-gray-600 text-xs"><i class="fa-regular fa-clock pe-2"></i>Created :
                        {{ $note->created_at->diffForHumans() }}</span>
                    <span class="text-gray-600 text-xs"><i class="fa-solid fa-retweet pe-2"></i>Last Updated :
                        {{ $note->updated_at->diffForHumans() }}</span>
                </div>
                <h3 class="text-gray-700 text-center text-4xl mt-5 mb-5 hover:cursor-pointer">{{ $note->title }}</h3>
                <p class="text-justify text-gray-500 mb-10">{{ $note->content }}</p>

                @if (request()->routeIs('notes.show'))
                    <a href="{{ route('notes.edit', ['note' => $note->uuid]) }}"
                        class="rounded-full bg-gray-700 text-white px-7 py-2 hover:bg-gray-600">
                        <i class="fa-solid fa-file-pen pe-2"></i>Edit My Note</a>
                    <form action="{{ route('notes.destroy', $note->uuid) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="mt-5 rounded-full bg-red-800 text-white px-7 py-1 hover:bg-red-600"
                            type="submit" onclick="return confirm('Are you sure to move this to trash?')">
                            <i class="fa-solid fa-trash-arrow-up pe-2"></i>Move To Trash</button>
                    </form>
                @else
                {{-- Restore Button --}}
                    <div class="mb-5">
                        <form action="{{ route('trash.update', $note->uuid) }}" method="post">
                            @method('PATCH')
                            @csrf
                            <button class="rounded-full bg-green-700 text-white px-7 py-2 hover:bg-green-800">
                                <i class="fa-solid fa-rotate-left pe-2"></i>Restore Note</button>
                        </form>
                    </div>

                {{-- Permanent Delete Button --}}
                    <div class="mb-5">
                        <form action="{{ route('trash.destroy', $note->uuid) }}" method="post">
                            @method('DELETE')
                            @csrf
                        <button class="rounded-full bg-red-700
                         text-white px-7 py-2 hover:bg-red-800" onclick="return confirm('Are you sure to delete this permanent? This cannot be undone!')">
                            <i class="fa-solid fa-calendar-xmark pe-2"></i>Permanent Delete</button>
                        </form>
                    </div>
                    <span class="text-gray-600 text-xs"><i class="fa-regular fa-clock pe-2"></i>Archieved :
                        {{ $note->deleted_at->diffForHumans() }}</span>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
