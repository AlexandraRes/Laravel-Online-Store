<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">
        {{ __('my_orders.title') }}
    </h1>
    <div class="flex flex-col bg-white p-5 rounded-lg mt-4 shadow-lg">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="hidden lg:table min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    {{ __('my_orders.table.headers.order') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    {{ __('my_orders.table.headers.date') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    {{ __('my_orders.table.headers.order_status') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    {{ __('my_orders.table.headers.payment_status') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    {{ __('my_orders.table.headers.order_amount') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                    {{ __('my_orders.table.headers.action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($orders as $order)

                                @php
                                    $status = app(\App\Livewire\MyOrdersPage::class)->getStatusBadgeHtml($order->status);
                                    $payment_status = app(\App\Livewire\MyOrdersPage::class)->getPaymentStatusBadgeHtml($order->payment_status);
                                @endphp

                                <tr wire:key="{{$order->id}}"
                                    class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $order->id }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                        {{ $order->created_at->format('d-m-Y H:i:s')}}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                        {!! $status !!}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                        {!! $payment_status !!}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                        {{ Number::format($order->grand_total, 2)  }} MDL
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm font-medium">
                                        <a wire:navigate href="{{ route('my_orders.show', $order->id) }}"
                                            class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">
                                            {{ __('my_orders.table.button.text') }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800">
                                    <td colspan="6" class="p-4 text-center text-2xl font-semibold  text-slay-500">
                                        {{ __('my_orders.table.empty') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class='grid grid-cols-1 md:grid-cols-2 gap-6 lg:hidden'>
                        @forelse ($orders as $order)

                            @php
                                $status = app(\App\Livewire\MyOrdersPage::class)->getStatusBadgeHtml($order->status);
                                $payment_status = app(\App\Livewire\MyOrdersPage::class)->getPaymentStatusBadgeHtml($order->payment_status);
                            @endphp

                            <div wire:key="{{$order->id}}"
                                class="border border-slate-400 rounded shadow-md/50 shadow-slate-600">
                                <div class='p-6 space-y-3'>
                                    <div class="grid grid-cols-2 border-b-2 border-slate-500 pb-1">
                                        <div>
                                            {{ __('my_orders.mobile.labels.order') }}
                                        </div>
                                        <div class="font-semibold">
                                            {{ $order->id}}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            {{ __('my_orders.mobile.labels.date') }}
                                        </div>
                                        <div>
                                            {{ $order->created_at->format('d-m-Y H:i:s')}}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            {{ __('my_orders.mobile.labels.order_status') }}
                                        </div>
                                        <div>
                                            {!! $status !!}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            {{ __('my_orders.mobile.labels.payment_status') }}
                                        </div>
                                        <div>
                                            {!! $payment_status !!}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div>
                                            {{ __('my_orders.mobile.labels.order_amount') }}
                                        </div>
                                        <div>
                                            {{ Number::format($order->grand_total, 2)}} MDL
                                        </div>
                                    </div>
                                </div>

                                <div class="px-6 pb-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a wire:navigate href="{{ route('my_orders.show', $order->id) }}"
                                        class="block w-full bg-slate-500 text-white py-2 px-4 rounded-md hover:bg-slate-400">
                                        {{ __('my_orders.table.button.text') }}
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800">
                                <div colspan="6" class="p-4 text-center text-2xl font-semibold  text-slay-500">
                                    {{ __('my_orders.table.empty') }}
                                </div>
                            </div>
                        @endforelse
                    </div>
                    @if (count($orders) > 0)
                        <div class="mt-6">
                            {{ $orders->links('vendor.pagination.tailwind')}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
