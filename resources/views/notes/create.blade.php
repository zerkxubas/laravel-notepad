<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900 text-center font-bold text-2xl underline">
        {{ __('Add New Notes') }}
    </div>
    <div class="max-w-7xl mx-auto text-end mb-5 sm:px-6 lg:px-8 ">
        <a href="{{ route('notes.index') }}" class="rounded-full bg-green-700 text-white px-7 py-2 hover:bg-gray-700 focus:bg-gray-700"  >
            <i class="fa-solid fa-arrow-left-long pe-2 fa-lg"></i>
            Back To Notes</a>
    </div>
    <div class="py-3">
            <div class="max-w-7xl mx-auto mb-5 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                    <form action="{{ route('notes.store') }}" method="post">
                        @csrf
                        <x-text-input type="text" name="title" field="title" :value="@old('title')" placeholder="Write your title here" class="w-full"></x-text-input>
                        {{-- field title is used for error props --}}
                        <x-text-area name="content" rows="10" field="content" :value="@old('content')" placeholder="Start typing here..." class="w-full mt-5"></x-text-area>
                        {{-- field content is used for error props --}}

                        <x-primary-button class="float-right mt-5 px-5">Save Note</x-primary-button>
                    </form>
                </div>
            </div>
    </div>
</x-app-layout>
