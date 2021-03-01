<div class="mt-10 sm:mt-0 p-2">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900 m-5">Item Content</h3>

                <p class="mt-1 text-sm text-gray-600 m-5">
                    Your information is stored <b>secured</b> in our server.
                </p>
            </div>
        </div>


        <div class="mt-5 md:mt-0 md:col-span-2">
            <form
                action="
                {{
                    ($type == 'add')?
                    route('action.items.website.add'):
                    route('action.items.website.modify')
                }}"
                method="post">

                <input type="hidden" name="item_id" value="{{$route['item'] ?? ''}}">
                <input type="hidden" name="vault_id" value="{{$route['id'] ?? ''}}">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="item_name">
                                    Item Name
                                </label>

                                <input
                                    value="{{ $data['name'] ?? '' }}"
                                    name="item_name"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full" id="item_name"
                                    type="text" autocomplete="off">
                            </div>
                            <input type="hidden" name="item_type" value="website">


                            <div class="py-8">
                                <div class="border-t border-gray-200"></div>
                            </div>


                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="domain">
                                    Domain
                                </label>

                                <input
                                    value="{{ $data['secret']['domain'] ?? '' }}"
                                    name="domain"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full" id="domain"
                                    type="text" autocomplete="off">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="account">
                                    Account
                                </label>
                                <input
                                    value="{{ $data['secret']['account'] ?? '' }}"
                                    name="account"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full" id="account"
                                    type="text" autocomplete="off">
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="password">
                                    Password
                                </label>
                                <input
                                    value="{{ $data['secret']['password'] ?? '' }}"
                                    name="password"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full" id="password"
                                    type="text" autocomplete="off">
                                <p>密碼等級:&nbsp; <span id="password_status" style="color: lightblue;">0</span>
                                </p>
                            </div>
                            <script>
                                var __var_api_time = Date.now();
                                $(function () {
                                    $('#password').on('keypress', function () {
                                        if (Date.now() - __var_api_time < 1000) {
                                            //__var_api_time = Date.now();
                                            return;
                                        }
                                        __var_api_time = Date.now();
                                        $.post({
                                            'url': "{{route('action.items.strength')}}",
                                            'data': {
                                                'info': [
                                                    $('#account').val(),
                                                    $('#domain').val()
                                                ],
                                                'password': $('#password').val()
                                            }
                                        }).then(function (result) {
                                            $('#password_status').text(result.score)
                                        })
                                    })
                                })
                            </script>
                        </div>
                    </div>

                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Save
                        </button>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
