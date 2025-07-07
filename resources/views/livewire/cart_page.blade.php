<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4">
            {{ __('cart.title') }}
        </h1>
        <div class="flex flex-wrap gap-4">

            <div class="w-full md:flex-2">

                <div class="hidden md:block h-full bg-white rounded-lg shadow-md p-6">
                    <table class="w-full h-full">
                        <thead>
                            <tr>
                                <th class="text-left font-semibold px-2">
                                    {{ __('cart.table.product') }}
                                </th>
                                <th class="text-left font-semibold px-2">
                                    {{ __('cart.table.price') }}
                                </th>
                                <th class="text-left font-semibold px-2">
                                    {{ __('cart.table.quantity') }}
                                </th>
                                <th class="text-left font-semibold px-2">
                                    {{ __('cart.table.total') }}
                                </th>
                                <th class="text-left font-semibold px-2">
                                    {{ __('cart.table.remove') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($cart_items as $item)
                                <tr wire:key="{{$item['product_id']}}">
                                    <td class="py-4 px-2">
                                        <div class="flex flex-wrap items-center">
                                            <img class="size-16 mr-4 object-contain"
                                                src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">
                                            <div class="font-semibold text-pretty">{{ $item['name'] }}</div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-2 text-nowrap">
                                        <div>{{ Number::format($item['unit_amount'], 2) }} MDL</div>
                                    </td>
                                    <td class="py-4 px-2">
                                        <div class="flex items-center">
                                            <button wire:click="decreaseQty({{ $item['product_id'] }})"
                                                class="border rounded-md py-1 px-4 mr-2 cursor-pointer">-</button>
                                            <span class="text-center w-8">
                                                {{ $item['quantity'] }}
                                            </span>
                                            <button wire:click="increaseQty({{ $item['product_id'] }})"
                                                class="border rounded-md py-1 px-4 ml-2 cursor-pointer">+</button>
                                        </div>
                                    </td>
                                    <td class="py-4 px-2 text-nowrap">{{ Number::format($item['total_amount'], 2) }} MDL
                                    </td>
                                    <td class="px-2">
                                        <button wire:click="removeItem({{ $item['product_id']}})"
                                            class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700 cursor-pointer">
                                            <span wire:loading.remove wire:target="removeItem({{ $item['product_id']}})">
                                                {{ __('cart.button.remove') }}
                                            </span>
                                            <span wire:loading wire:target="removeItem({{ $item['product_id']}})">
                                                {{ __('cart.button.loading') }}

                                            </span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-2xl font-semibold  text-slay-500">
                                        {{ __('cart.empty') }}
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="flex md:hidden bg-white rounded-lg shadow-md p-6">
                    <table class="w-full h-full">
                        <tbody>

                            @forelse ($cart_items as $item)
                                <tr>
                                    <td colspan="2">
                                        <div class="font-semibold text-center text-xl">{{ $item['name'] }}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2" class="py-2 px-2 w-1/4">
                                        <img class="object-contain" src="{{ url('storage', $item['image']) }}"
                                            alt="{{ $item['name'] }}">
                                    </td>
                                    <td class="py-2 px-2">
                                        <div class="flex items-center justify-evenly">
                                            <button wire:click="decreaseQty({{ $item['product_id'] }})"
                                                class="border rounded-md py-1 px-4 mr-2 cursor-pointer">-</button>
                                            <span class="text-center w-8">{{ $item['quantity'] }}</span>
                                            <button wire:click="increaseQty({{ $item['product_id'] }})"
                                                class="border rounded-md py-1 px-4 ml-2 cursor-pointer">+</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-2 text-center text-lg">{{ Number::format($item['total_amount'], 2) }}
                                        MDL</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="px-2 py-2">
                                        <button wire:click="removeItem({{ $item['product_id'] }})"
                                            class="w-full bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700 cursor-pointer">
                                            <span wire:loading.remove
                                                wire:target="removeItem({{ $item['product_id'] }})">Remove</span>
                                            <span wire:loading
                                                wire:target="removeItem({{ $item['product_id'] }})">Loading...</span>
                                        </button>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-3xl font-semibold  text-slay-500">
                                        No itemes available in cart!
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>

            <div class="w-full md:flex-1">
                <div class="bg-white rounded-lg shadow-md p-6 text-nowrap">
                    <h2 class="text-lg font-semibold mb-4">
                        {{ __('cart.summary.title') }}
                    </h2>
                    <div class="flex justify-between mb-2">
                        <span>
                            {{ __('cart.summary.subtotal') }}
                        </span>
                        <span>{{ Number::format($grand_total, 2) }} MDL</span>
                    </div>
                    <div class="flex justify-between mb-2 text-red-500">
                        <span>
                            {{ __('cart.summary.taxes') }}
                        </span>
                        <span>{{ Number::format(0, 2) }} MDL</span>
                    </div>
                    <div class="flex justify-between mb-2 text-red-500">
                        <span>
                            {{ __('cart.summary.shipping') }}
                        </span>
                        <span>{{ Number::format(0, 2) }} MDL</span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">
                            {{ __('cart.summary.total') }}
                        </span>
                        <span class="font-semibold">{{ Number::format($grand_total, 2) }} MDL</span>
                    </div>

                    @if ($cart_items)
                        <a wire:navigate href="{{ route('checkout') }}"
                            class="block text-center bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full cursor-pointer">
                            {{ __('cart.summary.button') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
