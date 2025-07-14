<?php

return [
    'shared' => [
        'fields' => [
            'id' => 'Ид',
            'name' => 'Название',
            'user_name' => 'Пользователь',
            'email' => 'Электронная почта',
            'email_verified_at' => 'Дата подтверждения email',
            'password' => 'Пароль',
            'slug' => 'Ссылка',
            'image' => 'Изображение',
            'images' => 'Изображения',
            'is_active' => 'Активен',
            'updated_at' => 'Обновлён',
            'created_at' => 'Создан',
            'view' => 'Просмотр',
            'edit' => 'Редактировать',
            'delete' => 'Удалить',
            'price' => 'Цена',
            'in_stock' => 'В наличии',
            'on_sale' => 'В распродаже',
            'is_featured' => 'Рекомендованный',
            'description' => 'Описание',
            'category' => 'Категория',
            'brand' => 'Бренд',
            'status' => 'Статус',
            'payment_method' => 'Способ оплаты',
            'payment_status' => 'Статус оплаты',
            'grand_total' => 'Общая сумма',
            'currency' => 'Валюта',
            'shipping_method' => 'Способ доставки',
            'notes' => 'Комментарии',
            'items' => 'Товары',
            'item' => 'Товар',
            'quantity' => 'Количество',
            'unit_amount' => 'Цена за единицу',
            'total_amount' => 'Cумма',
            'full_name' => 'Полное имя',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'phone' => 'Телефон',
            'city' => 'Город',
            'state' => 'Штат / Регион',
            'zip_code' => 'Почтовый индекс',
        ],
        'bulk' => [
            'delete' => 'Удалить выбранные',
            'delete_heading' => 'Подтверждение удаления',
            'delete_description' => 'Вы уверены, что хотите удалить выбранные записи? Это действие нельзя отменить.',
            'delete_success' => 'Выбранные записи успешно удалены.',
        ],
        'sections' => [
            'latest_orders' => 'Последние заказы',
            'product_information' => 'Информация о товаре',
            'order_information' => 'Детали заказа',
            'order_items' => 'Заказанные товары',
            'price' => 'Цена',
            'associations' => 'Связи',
            'images' => 'Изображения',
            'status' => 'Статус',
            'address' => 'Адресс',
        ],
        'navigation' => [
            'content' => 'Контент',
        ],
    ],
    'brand' => [
        'title' => [
            'singular' => 'бренд',
            'plural' => 'Бренды',
        ],
    ],
    'category' => [
        'title' => [
            'singular' => 'категория',
            'plural' => 'Категории',
        ],
    ],
    'product' => [
        'title' => [
            'singular' => 'продукт',
            'plural' => 'Продукты',
        ],
    ],
    'user' => [
        'title' => [
            'singular' => 'пользователь',
            'plural' => 'Пользователи',
        ],
    ],
    'address' => [
        'title' => [
            'singular' => 'адрес',
            'plural' => 'Адреса',
        ],
    ],
    'order' => [
        'title' => [
            'singular' => 'Заказ',
            'plural' => 'Заказы',
        ],
        'new_order' => 'Новый заказ',
        'status' => [
            'all' => 'Все',
            'new' => 'Новый',
            'processing' => 'В обработке',
            'shipped' => 'Отправлен',
            'delivered' => 'Доставлен',
            'canceled' => 'Отменён',
        ],
        'payment_status' => [
            'pending' => 'В ожидании',
            'paid' => 'Оплачено',
            'failed' => 'Неудачно',
        ],
        'payment_method' => [
            'cod' => 'Наличными при доставке',
            'stripe' => 'Stripe',
        ],
        'widget' => [
            'order_stats' => [
                'heading' => 'Информация о заказах',
                'description' => 'Виджеты ниже предоставляют краткую информацию о статусах заказов.',
                'new_orders' => 'Новые заказы',
                'new_orders_description' => 'Заказы должны быть обработаны до 12:00',
                'processing_orders' => 'Заказы в обработке',
                'shipped_orders' => 'Отгруженные заказы',
            ],
            'second_order_stats' => [
                'heading' => 'Информация о прибыли',
                'description' => 'Виджеты ниже предоставляют информацию о прибыли за весь период.',
                'profit' => 'Прибыль',
            ]
        ],
    ],
];
