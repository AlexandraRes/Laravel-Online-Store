<?php

return [
    'page_title' => 'Мои заказы - ',
    'title' => 'Мои заказы',
    'table' => [
        'headers' => [
            'order' => 'Заказ',
            'date' => 'Дата',
            'order_status' => 'Статус заказа',
            'payment_status' => 'Статус оплаты',
            'order_amount' => 'Сумма заказа',
            'action' => 'Действие',
        ],
        'empty' => 'У вас нет заказов!',
        'button' => [
            'text' => 'Просмотреть детали',
        ],
    ],
    'statuses' => [
        'order' => [
            'new' => 'Новый',
            'processing' => 'В обработке',
            'shipped' => 'Отправлен',
            'delivered' => 'Доставлен',
            'canceled' => 'Отменён',
        ],
        'payment' => [
            'pending' => 'Ожидает оплаты',
            'paid' => 'Оплачен',
            'failed' => 'Ошибка оплаты',
        ],
    ],
    'mobile' => [
        'labels' => [
            'order' => 'Заказ:',
            'date' => 'Дата:',
            'order_status' => 'Статус заказа:',
            'payment_status' => 'Статус оплаты:',
            'order_amount' => 'Сумма заказа:',
        ],
    ],
];
