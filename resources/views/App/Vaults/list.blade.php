<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('pages.vault.my')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl relative">
                        {{__('pages.vault.title')}}
                        <a class="absolute right-0 bg-transparent bg-green-400 text-white py-1 px-3.5 border border-blue hover:border-transparent rounded"
                            href="{{@route('vaults.add')}}"
                        >{{__('pages.vault.add')}}</a>
                    </div>
                    <br>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-3 border-l-2 border-t-2 border-gray-200 ">
                    @foreach ($vaults as $vault)
                    <div class="p-6 border-r-2 border-b-2 border-gray-200 hover:shadow-outline-teal">
                        <div class="flex items-center">
                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                                <a  href="{{route('vaults.show',['id'=>$vault->id])}}"
                                    target="_blank">
                                    {{$vault->name}}
                                </a>
                            </div>
                        </div>

                        <div class="ml-12">
                            <div class="mt-2 text-sm text-gray-500">
                                {{$vault->description}}
                            </div>

                            <a href="{{route('vaults.show',['id'=>$vault->id])}}"
                               target="_blank">
                                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                    <div>{{__('pages.vault.view')}}</div>

                                    <div class="ml-1 text-indigo-500">
                                        <svg viewBox="0 0 20 20" fill="currentColor" class="arrow-right w-4 h-4">
                                            <path fill-rule="evenodd"
                                                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
