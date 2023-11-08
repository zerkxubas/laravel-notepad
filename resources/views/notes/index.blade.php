<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900 text-center font-bold text-2xl underline">
        {{ __('All Notes Here') }}
    </div>
    <div class="py-3">
        {{-- Checking if the records are set and is not empty --}}
        @if (isset($notes) && !$notes->isEmpty())
            {{-- if records exists --}}
            @foreach ($notes as $note)
                <div class="max-w-7xl mx-auto mb-5 sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">

                            <span class="font-bold text-lg text-gray-600">
                                {{ $note->title }}
                                <span class="text-sm opacity-70 float-right">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $note->created_at->diffForHumans() }}
                                </span>
                            </span>
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
                    <p class="text-red-600 text-center">No items in added yet!</p>
                </div>
            </div>

        @endif
    </div>
</x-app-layout>
