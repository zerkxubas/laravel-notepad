<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request()->routeIs('notes.index') ? __('Notes') : __('Trash Notes') }}
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900 text-center font-bold text-2xl underline">
        @if (request()->routeIs('notes.index'))
            <i class="fa-solid fa-clipboard-list text-gray-700 pe-2"></i>
            {{ __('All Notes Here') }}
        @else
            <i class="fa-solid fa-trash-can text-red-700 pe-2"></i>
            {{ __('All Trash Notes') }}
        @endif
    </div>

    @if (request()->routeIs('notes.index'))
        <div class="max-w-7xl mx-auto text-end mb-5 sm:px-6 lg:px-8 ">
            <a href="{{ route('notes.create') }}" class="rounded-full bg-blue-800 text-white px-7 py-2 hover:bg-blue-700">
                <i class="fa-solid fa-square-plus  pe-2"></i>
                Add New</a>
        </div>
    @endif
    {{-- Display Success Messages Here. --}}
    @if (session()->has('success'))
        <div class="text-center text-green-500">
            <i class="fa-solid fa-check pe-2"></i>{{ session('success') }}
        </div>
    @endif
    <div class="py-3">
        {{-- Checking if the records are set and is not empty --}}
        @if (isset($notes) && !$notes->isEmpty())
            {{-- if records exists --}}
            @foreach ($notes as $note)
                <div class="max-w-7xl mx-auto mb-5 sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg  hover:bg-gray-200">
                        <div class="p-6 text-gray-900">
                            @if (request()->routeIs('notes.index'))
                                <a href="{{ route('notes.show', ['note' => $note->uuid]) }}"
                                    class="font-bold text-lg text-gray-600">
                                    {{ $note->title }}
                                    <span class="text-sm opacity-70 float-right">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $note->created_at->diffForHumans() }}
                                    </span>
                                </a>
                            @else
                                <a href="{{ route('trash.show', $note->uuid) }}"
                                    class="font-bold text-lg text-gray-600">
                                    {{ $note->title }}
                                    <span class="text-sm opacity-70 float-right text-red-700">
                                        <i class="fa-regular fa-clock"></i>
                                        {{ $note->deleted_at->diffForHumans() }}
                                    </span>
                                </a>
                            @endif
                            <div class="flex items-center pt-2">
                                <input type="checkbox" class="appearance-none checked:bg-blue-500" />
                                <p class="text-gray-600 ml-2 px-3 text-justify">
                                    {{ Str::limit($note->content, 100, '...') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="max-w-7xl mx-auto mb-5 sm:px-6 lg:px-8">
                {{-- <div class=" overflow-hidden shadow-sm sm:rounded-lg"> --}}
                {{ $notes->links() }}
                {{-- </div> --}}
            </div>
        @else
            <div class="max-w-7xl mx-auto mb-5 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @if (request()->routeIs('notes.index'))
                        <p class="text-red-600 text-center">No items added yet!</p>
                    @else
                        <p class="text-red-600 text-center">Recycle Bin is empty.</p>
                    @endif
                </div>
            </div>

        @endif
    </div>
</x-app-layout>
