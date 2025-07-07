<?php

return [
    'page_title' => 'Детали заказа - ',
    'title' => 'Детали заказа',
    'cards' => [
        'customer' => 'Клиент',
        'order_date' => 'Дата заказа',
        'order_status' => 'Статус заказа',
        'payment_status' => 'Статус оплаты',
    ],
    'order_statuses' => [
        'new' => 'Новый',
        'processing' => 'В обработке',
        'shipped' => 'Отправлен',
        'delivered' => 'Доставлен',
        'canceled' => 'Отменён',
    ],
    'payment_statuses' => [
        'pending' => 'В ожидании',
        'paid' => 'Оплачен',
        'failed' => 'Неудача оплаты',
    ],
    'table' => [
        'headers' => [
            'product' => 'Товар',
            'price' => 'Цена',
            'quantity' => 'Количество',
            'total' => 'Итого',
        ],
    ],
    'shipping' => [
        'shipping_address' => 'Адрес доставки',
        'phone' => 'Телефон:',
    ],
    'summary' => [
        'summary' => 'Итог',
        'subtotal' => 'Промежуточный итог',
        'taxes' => 'Налоги',
        'shipping' => 'Доставка',
        'grand_total' => 'Общий итог',
    ],
];
