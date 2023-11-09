<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900 text-center font-bold text-2xl underline">
        <i class="fa-regular fa-pen-to-square pe-2 text-gray-700"></i>{{ __('Edit Note') }}
    </div>
    <div class="max-w-7xl mx-auto text-end mb-5 sm:px-6 lg:px-8 ">
        <a href="{{ route('notes.index') }}" class="rounded-full bg-gray-700 text-white px-7 py-2 hover:bg-slate-600"  >
            <i class="fa-solid fa-arrow-left-long pe-2 fa-lg"></i>
            Back To Notes</a>
    </div>
    <div class="py-3">
            <div class="max-w-7xl mx-auto mb-5 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                    <form action="{{ route('notes.update', $note->uuid) }}" method="POST">
                        @method('put')
                        @csrf
                        <x-text-input type="text" name="title" field="title" :value="$note ? $note->title : '' " placeholder="Update your title here" class="w-full"></x-text-input>
                        {{-- field title is used for error props --}}
                        <x-text-area name="content" rows="10" field="content" :value="$note ? $note->content : '' " placeholder="Start typing here..." class="w-full mt-5"></x-text-area>
                        {{-- field content is used for error props --}}
                        <div class="flex justify-center mt-5">
                            <x-primary-button class="bg-indigo-800 float-right px-5 hover:bg-indigo-600"><i class="fa-solid fa-retweet pe-2"></i>Update Note</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</x-app-layout>
