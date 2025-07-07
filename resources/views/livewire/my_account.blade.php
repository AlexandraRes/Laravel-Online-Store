<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500 mb-4">
        {{ __('my_account.title') }}
    </h1>

    <div class="grid gap-4 p-[1.5rem] bg-white rounded-lg break-words md:grid-cols-3">

        <div>
            <h2 class="text-2xl text-slate-400 font-bold mb-4">
                {{ __('my_account.current_information.title') }}
            </h2>

            <div class="space-y-2">
                <div class="flex items-center gap-4">
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M9 9C9 7.3425 10.3425 6 12 6C13.6575 6 15 7.3425 15 9C15 10.6575 13.6575 12 12 12C10.3425 12 9 10.6575 9 9ZM12 7.5C12.825 7.5 13.5 8.175 13.5 9C13.5 9.825 12.825 10.5 12 10.5C11.175 10.5 10.5 9.825 10.5 9C10.5 8.175 11.175 7.5 12 7.5Z"
                            fill="#475569" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 13.5C9.9975 13.5 6 14.505 6 16.5V18H18V16.5C18 14.505 14.0025 13.5 12 13.5ZM12 15C14.025 15 16.35 15.9675 16.5 16.5H7.5C7.6725 15.96 9.9825 15 12 15Z"
                            fill="#475569" />
                    </svg>
                    <div class="text-slate-600">
                        {{$user->name}}
                    </div>
                </div>

                <div class="flex items-center gap-4">

                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M19.2 5H4.8C3.81 5 3.009 5.81 3.009 6.8L3 17.6C3 18.59 3.81 19.4 4.8 19.4H19.2C20.19 19.4 21 18.59 21 17.6V6.8C21 5.81 20.19 5 19.2 5ZM19.2 17.6H4.8V8.6L12 13.1L19.2 8.6V17.6ZM4.8 6.8L12 11.3L19.2 6.8H4.8Z"
                            fill="#475569" />
                    </svg>
                    <div class="text-slate-600">
                        {{$user->email}}
                    </div>
                </div>
            </div>
        </div>

        <div class="md:col-span-2">
            <h2 class="text-2xl text-slate-400 font-bold mb-4">
                {{ __('my_account.update_information.title') }}
            </h2>

            <form class="space-y-4" wire:submit.prevent='updateData'>
                <div>
                    <label for="login" class="block text-sm font-medium text-slate-600 mb-1 ">
                        {{ __('my_account.update_information.form.login') }}
                    </label>
                    @error('login')
                        <span class="text-sm text-red-500">
                            {{$message}}
                        </span>
                    @enderror
                    <input type="text" id="login" wire:model.lazy="login"
                        class="w-full px-3 py-2 border @error('login') border-red-500 @else border-slate-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-slate-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-600 mb-1">
                        {{ __('my_account.update_information.form.email') }}
                    </label>
                    @error('email')
                        <span class="text-sm text-red-500">
                            {{$message}}
                        </span>
                    @enderror
                    <input type="email" id="email" wire:model.lazy="email"
                        class="w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-slate-500">
                </div>

                <div class="flex justify-between gap-4">
                    <button type="button" onclick="window.location.href='{{ route('home') }}'"
                        class="w-1/4 min-w-[100px] bg-slate-500 text-white py-2 px-4 rounded-md hover:bg-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-colors">
                        {{ __('my_account.update_information.form.button.cancel') }}
                    </button>

                    <button type="submit"
                        class="w-1/4 min-w-[100px] bg-slate-500 text-white py-2 px-4 rounded-md hover:bg-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-colors">
                        <span wire:loading wire:target='updateData'>
                            {{ __('my_account.update_information.form.button.updating') }}
                        </span>
                        <span wire:loading.remove wire:target='updateData'>
                            {{ __('my_account.update_information.form.button.update') }}
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
