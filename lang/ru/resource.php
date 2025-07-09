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
        ],
        'bulk' => [
            'delete' => 'Удалить выбранные',
            'delete_heading' => 'Подтверждение удаления',
            'delete_description' => 'Вы уверены, что хотите удалить выбранные записи? Это действие нельзя отменить.',
            'delete_success' => 'Выбранные записи успешно удалены.',
        ],
        'sections' => [
            'product_information' => 'Информация о товаре',
            'price' => 'Цена',
            'associations' => 'Связи',
            'images' => 'Изображения',
            'status' => 'Статус',
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
    'order' => [
        'title' => [
            'singular' => 'Заказ',
            'plural' => 'Заказы',
        ],
        'new_order' => 'Новый заказ',
        'status' => [
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

    ],
];
