<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
        {{ __('checkout.title')}}
    </h1>
    <form wire:submit.prevent='placeOrder'>
        <div class="grid grid-cols-12 gap-4">
            <div class="flex md:col-span-12 lg:col-span-8 col-span-12">
                <!-- Card -->
                <div
                    class="flex justify-between flex-col flex-grow bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <!-- Shipping Address -->
                    <div class="mb-6">
                        <h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                            {{ __('checkout.shipping.title')}}
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <div class="flex flex-wrap justify-between">
                                    <label class="block text-gray-700 font-medium dark:text-white mb-1"
                                        for="first_name">
                                        {{ __('checkout.shipping.first_name')}}
                                    </label>
                                </div>
                                <input wire:model="first_name"
                                    class=" @error('first_name') text-red-500 @enderror w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="first_name" type="text">
                                </input>
                                @error('first_name')
                                    <span class="text-sm text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700 dark:text-white mb-1" for="last_name">
                                    {{ __('checkout.shipping.last_name')}}
                                </label>
                                <input wire:model="last_name"
                                    class=" @error('last_name') border-red-500 @enderror w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="last_name" type="text">
                                </input>
                                @error('last_name')
                                    <span class="text-sm text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 font-medium dark:text-white mb-1" for="phone">
                                {{ __('checkout.shipping.phone')}}
                            </label>
                            <input wire:model="phone"
                                class=" @error('phone') border-red-500 @enderror w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                id="phone" type="text">
                            </input>
                            @error('phone')
                                <span class="text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 font-medium dark:text-white mb-1" for="address">
                                {{ __('checkout.shipping.address')}}
                            </label>
                            <input wire:model="street_address"
                                class=" @error('street_address') border-red-500 @enderror w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                id="address" type="text">
                            </input>
                            @error('street_address')
                                <span class="text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 font-medium dark:text-white mb-1" for="city">
                                {{ __('checkout.shipping.city')}}
                            </label>
                            <input wire:model="city"
                                class=" @error('city') border-red-500 @enderror w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                id="city" type="text">
                            </input>
                            @error('city')
                                <span class="text-sm text-red-500">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-gray-700 font-medium dark:text-white mb-1" for="state">
                                    {{ __('checkout.shipping.state')}}
                                </label>
                                <input wire:model="state"
                                    class=" @error('state') border-red-500 @enderror w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="state" type="text">
                                </input>
                                @error('state')
                                    <span class="text-sm text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium dark:text-white mb-1" for="zip">
                                    {{ __('checkout.shipping.zip_code')}}
                                </label>
                                <input wire:model="zip_code"
                                    class=" @error('zip_code') border-red-500 @enderror w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"
                                    id="zip" type="text">
                                </input>
                                @error('zip_code')
                                    <span class="text-sm text-red-500">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="text-lg font-semibold mb-4">
                            {{ __('checkout.payment.title')}}
                        </div>
                        <ul class="grid w-full gap-6 md:grid-cols-2">
                            <li>
                                <input wire:model="payment_method" class="hidden peer" id="hosting-small" required=""
                                    type="radio" value="cod" />
                                <label
                                    class=" @error('payment_method') border-red-500 @else border-gray-200 @enderror inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                    for="hosting-small">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">
                                            {{ __('checkout.payment.cod')}}
                                        </div>
                                    </div>
                                    <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                        viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                        </path>
                                    </svg>
                                </label>
                            </li>
                            <li>
                                <input wire:model="payment_method" class="hidden peer" id="hosting-big" type="radio"
                                    value="stripe">
                                <label
                                    class=" @error('payment_method') border-red-500 @else border-gray-200 @enderror inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                    for="hosting-big">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">
                                            {{ __('checkout.payment.stripe')}}
                                        </div>
                                    </div>
                                    <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                        viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                        </path>
                                    </svg>
                                </label>
                                </input>
                            </li>
                        </ul>
                        @error('payment_method')
                            <span class="text-sm text-red-500">
                                {{$message}}
                            </span>
                        @enderror
                    </div>

                </div>
                <!-- End Card -->
            </div>
            <div class="flex flex-col justify-between md:col-span-12 lg:col-span-4 col-span-12">
                <div
                    class="flex justify-evenly flex-1 flex-col bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                        {{ __('checkout.order_summary.title')}}
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            {{ __('checkout.order_summary.subtotal')}}
                        </span>
                        <span>
                            {{ Number::format($grand_total, 2)}} MDL
                        </span>
                    </div>
                    <div class="flex justify-between mb-2 font-bold text-red-500">
                        <span>
                            {{ __('checkout.order_summary.taxes')}}
                        </span>
                        <span>
                            {{ Number::format(0, 2)}} MDL

                        </span>
                    </div>
                    <div class="flex justify-between mb-2 font-bold text-red-500">
                        <span>
                            {{ __('checkout.order_summary.shipping')}}
                        </span>
                        <span>
                            {{ Number::format(0, 2)}} MDL

                        </span>
                    </div>
                    <hr class="bg-slate-400 my-4 h-1 rounded">
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            {{ __('checkout.order_summary.total')}}
                        </span>
                        <span>
                            {{ Number::format($grand_total, 2)}} MDL
                        </span>
                    </div>
                    </hr>
                </div>
                <button type="submit"
                    class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                    <span wire:loading>
                        {{ __('checkout.button.processing')}}
                    </span>
                    <span wire:loading.remove>
                        {{ __('checkout.button.place_order')}}
                    </span>
                </button>
                <div
                    class="flex justify-evenly flex-1 flex-col bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                        {{ __('checkout.basket_summary.title')}}
                    </div>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                        @foreach ($cart_items as $item)
                            <li class="py-3 sm:py-4" wire:key="{{ $item->product_id }}">
                                <div class="flex items-center gap-2">
                                    <div class="flex-shrink-0 rounded-full border-2 border-slate-400 p-1">
                                        <img alt="{{ $item->name }}" class="w-12 h-12 rounded-full"
                                            src="{{ url('storage', $item->images[0]) }}">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $item->name }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{ __('checkout.basket_summary.quantity')}}
                                            {{ $item->quantity }}
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ Number::format($item->total_amount, 2) }} MDL
                                    </div>
                                </div>
                            </li>
                        @endforeach

                        <div class="mt-4">
                            {{ $cart_items->links('vendor.pagination.tailwind') }}
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
