<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Item
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{route('action.items.add',$route['id'])}}" method="post">
                    <input type="text" name="item_name" placeholder="name">
                    <br>
                    <input type="text" name="item_type" placeholder="type">
                    <br>
                    <textarea type="text" name="item_payload" placeholder="paylaod"></textarea>
                    <br>
                    <button type="submit">
                        Add
                    </button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
