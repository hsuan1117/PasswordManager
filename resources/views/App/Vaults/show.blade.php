<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('vaults.list')}}">
                My Vaults
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl relative">
                    {{$vault->name}}
                    <a class="absolute right-0 bg-transparent bg-green-400 text-white py-1 px-3.5 border border-blue hover:border-transparent rounded"
                    href="{{route('items.add',['id'=>$vault->id])}}"
                    >Add</a>
                    </div>
                    <br>
                    {{$vault->description}}
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 ">
                    @foreach ($vault->items as $item)
                        <div class="p-6">
                            <div class="flex items-center">
                                <li class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                                    <a href="{{route('items.show',[
                                        'id'=>$vault->id,'item'=>$item->id
                                    ])}}"
                                       target="_blank">
                                        {{$item->payload['name']}}
                                    </a>
                                </li>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</x-app-layout>
