<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-500 leading-tight">
            Access Denied
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg items-center p-1.5">
                @if(Session::has('message') && !empty(Session::get('message') ?? []))
                    @switch(Session::get('message.type'))
                        @case('success')
                        <div class="bg-green-200 text-center rounded m-1.5 p-1.5 pt-2" >
                            {{Session::get('message.msg')??''}}
                        </div>
                        @break

                        @case('error')

                        <img src="https://cdn.pixabay.com/photo/2018/04/22/22/57/hacker-3342696_640.jpg" class="block m-auto rounded">

                        <div class="bg-red-500 text-center rounded m-1.5 p-1.5 pt-2" >
                            {{Session::get('message.msg')??''}}
                        </div>
                        @break

                        @default
                        <div class="bg-gray-400 text-center rounded m-1.5 p-1.5 pt-2" >
                            {{Session::get('message.msg')??''}}
                        </div>
                    @endswitch
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
