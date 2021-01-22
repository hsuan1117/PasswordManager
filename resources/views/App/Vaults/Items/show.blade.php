<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Vaults
        </h2>
    </x-slot>

    @if($message)
        @switch($message['type'])
            @case('success')
            <div class="bg-green-200 text-center rounded m-1.5 p-1.5 pt-2" >
                {{$message['msg']??''}}
            </div>
            @break

            @case('error')
            <div class="bg-red-500 text-center rounded m-1.5 p-1.5 pt-2" >
                {{$message['msg']??''}}
            </div>
            @break

            @default
            <div class="bg-gray-400 text-center rounded m-1.5 p-1.5 pt-2" >
                {{$message['msg']??''}}
            </div>
        @endswitch
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl relative">
                    {{$item['name'] ?? 'New Item'}}
                    <!--<button class="absolute right-0 bg-transparent bg-green-400 text-white py-1 px-3.5 border border-blue hover:border-transparent rounded">Add</button>-->
                    </div>
                    <br>
                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 ">
<!--
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                                    {{$item['type'] ?? ''}}
                                </div>
                            </div>
                        </div>
-->
                    @livewire('item-website', [
                        'data'=>($item['secret'] ?? '' ),
                        'route'=> [
                            'id'=>$route['id'],
                            'item'=>($route['item'] ?? '')
                        ],
                        'type' => $type
                    ])
                </div>
            </div>
        </div>
</x-app-layout>
