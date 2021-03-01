<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Item
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <form method="post" action="{{@route('action.vault.add')}}">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <label class="block font-medium text-md text-gray-700" for="vault_name">
                                        Vault Name
                                    </label>
                                    <input
                                        name="vault_name"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full" id="vault_name"
                                        type="text" autocomplete="off">
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <label class="block font-medium text-md text-gray-700" for="vault_desc">
                                        Vault Description
                                    </label>
                                    <input
                                        name="vault_desc"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full" id="vault_desc"
                                        type="text" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Save
                            </button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
