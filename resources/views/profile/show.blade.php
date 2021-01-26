<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profile
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('profile.update-profile-information-form')

            <x-jet-section-border/>

            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <x-jet-section-border/>

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>
            @endif

            <x-jet-section-border/>

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            <x-jet-section-border/>

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>

            <x-jet-section-border/>

            <div class="mt-10 sm:mt-0">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 ">Master Key</h3>

                            <p class="mt-1 text-sm text-gray-600 ">
                                Set your master key.
                            </p>
                        </div>
                    </div>


                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form action="{{route('action.set_master_key')}}" method="post">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-4">
                                            <label class="block font-medium text-sm text-gray-700" for="key">
                                                Master Key
                                            </label>

                                            <input
                                                value=""
                                                name="key"
                                                class="form-input rounded-md shadow-sm mt-1 block w-full" id="key"
                                                type="password" autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        Set MasterKey
                                    </button>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
