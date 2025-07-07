<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500 mb-4">
        {{__('my_order_detail.title')}}
    </h1>
    <div class="grid min-[620px]:max-[1300px]:grid-cols-2 min-[1300px]:grid-cols-4 gap-4 grid-flow-dense mb-4">

        <!-- Card -->
        <div class="flex flex-col  bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            {{__('my_order_detail.cards.customer')}}
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <div>
                            {{$order->address->full_name}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col  bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 22h14" />
                        <path d="M5 2h14" />
                        <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
                        <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            {{__('my_order_detail.cards.order_date')}}
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">
                            {{$order->created_at->format('d-m-Y H:i:s')}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col  bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
                        <path d="m12 12 4 10 1.7-4.3L22 16Z" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            {{__('my_order_detail.cards.order_status')}}
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">

                        @php
                            $status = app(\App\Livewire\MyOrderDetailPage::class)->getStatusBadgeHtml($order->status);
                        @endphp

                        {!! $status !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col  bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5z" />
                        <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        <path d="M21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2" />
                        <path d="M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            {{__('my_order_detail.cards.payment_status')}}
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        @php
                            $payment_status = app(\App\Livewire\MyOrderDetailPage::class)->getPaymentStatusBadgeHtml($order->payment_status);
                        @endphp

                        {!! $payment_status !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>

    <div class="grid md:max-[1300px]:grid-cols-2 min-[1300px]:grid-cols-4 gap-4 grid-flow-dense">
        <div class=" md:max-[1300px]:col-span-2 min-[1300px]:col-span-3 bg-white overflow-x-auto rounded-lg shadow-md p-6">
            <div class="grid grid-cols-[5rem_repeat(4,1fr)] max-sm:hidden gap-x-4 p-4 pt-0">
                <div></div>
                <div class="text-lg font-bold text-slate-500">
                    {{ __('my_order_detail.table.headers.product') }}
                </div>
                <div class="text-lg font-bold text-slate-500">
                    {{ __('my_order_detail.table.headers.price') }}
                </div>
                <div class="text-lg font-bold text-slate-500">
                    {{ __('my_order_detail.table.headers.quantity') }}
                </div>
                <div class="text-lg font-bold text-slate-500">
                    {{ __('my_order_detail.table.headers.total') }}
                </div>
            </div>
            <div class="max-sm:divide-y divide-slate-300">
                @foreach ($order->items as $item)
                    <div class="grid grid-cols-2 sm:grid-cols-[fit-content(5rem)_repeat(4,1fr)] items-center gap-4 p-4 @if ($loop->last) pb-0  @endif text-pretty" wire:key="{{$item->id}}">
                        <div class="max-sm:col-span-2">
                            <img class="h-20 w-25 sm:h-15 sm:w-20" src="{{url('storage', $item->product->images[0])}}"
                                alt="{{$item->product->name}}">
                        </div>
                        <div class="flex flex-col justify-between sm:justify-center h-full">
                            <div class="sm:hidden text-lg font-bold text-slate-500">
                                {{ __('my_order_detail.table.headers.product') }}
                            </div>
                            <div>{{$item->product->name}}</div>
                        </div>
                        <div class="flex flex-col justify-between sm:justify-center h-full">
                            <div class="sm:hidden text-lg font-bold text-slate-500">
                                {{ __('my_order_detail.table.headers.price') }}
                            </div>
                            <div>{{ Number::format($item->unit_amount, 2) }} MDL</div>
                        </div>
                        <div class="flex flex-col justify-between sm:justify-center h-full">
                            <div class="sm:hidden text-lg font-bold text-slate-500">
                                {{ __('my_order_detail.table.headers.quantity') }}
                            </div>
                            <div>{{$item->quantity}}</div>
                        </div>
                        <div class="flex flex-col justify-between sm:justify-center h-full">
                            <div class="sm:hidden text-lg font-bold text-slate-500">
                                {{ __('my_order_detail.table.headers.total') }}
                            </div>
                            <div>{{ Number::format($item->total_amount, 2) }} MDL</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="min-[1300px]:col-span-3 bg-white overflow-x-auto rounded-lg shadow-md p-6">
            <h1 class="text-lg font-bold text-slate-500 mb-3">
                {{ __('my_order_detail.shipping.shipping_address') }}
            </h1>
            <div class="flex gap-4 max-[1300px]:flex-wrap justify-between items-center">
                <div>
                    <p>
                        {{ $order->address->street_address}}, {{ $order->address->state}},
                        {{ $order->address->city}}, {{ $order->address->zip_code}}
                    </p>
                </div>
                <div class="flex space-x-4">
                    <p class="font-bold text-slate-400">
                        {{ __('my_order_detail.shipping.phone') }}
                    </p>
                    <p>
                        {{ $order->address->phone}}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 text-nowrap">
            <h2 class="text-lg font-bold text-slate-500 mb-4">
                {{ __('my_order_detail.summary.summary') }}
            </h2>
            <div class="flex gap-2 justify-between mb-2">
                <span>
                    {{ __('my_order_detail.summary.subtotal') }}
                </span>
                <span>
                    {{ Number::format($order->grand_total, 2) }} MDL

                </span>
            </div>
            <div class="flex gap-2 justify-between mb-2 text-red-500">
                <span>
                    {{ __('my_order_detail.summary.taxes') }}
                </span>
                <span>
                    {{ Number::format(0, 2) }} MDL
                </span>
            </div>
            <div class="flex gap-2 justify-between mb-2 text-red-500">
                <span>
                    {{ __('my_order_detail.summary.shipping') }}
                </span>
                <span>
                    {{ Number::format(0, 2) }} MDL
                </span>
            </div>
            <hr class="my-2">
            <div class="flex gap-2 justify-between mb-2">
                <span class="font-semibold">
                    {{ __('my_order_detail.summary.grand_total') }}
                </span>
                <span class="font-semibold">
                    {{ Number::format($order->grand_total, 2) }} MDL
                </span>
            </div>

        </div>

    </div>

</div>
