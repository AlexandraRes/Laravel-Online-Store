<?php

return [
    'page_title' => 'My Orders - ',
    'title' => 'My Orders',
    'table' => [
        'headers' => [
            'order' => 'Order',
            'date' => 'Date',
            'order_status' => 'Order Status',
            'payment_status' => 'Payment Status',
            'order_amount' => 'Order Amount',
            'action' => 'Action',
        ],
        'empty' => "You don't have any orders!",
        'button' => [
            'text' => 'View Details',
        ],
    ],
    'statuses' => [
        'order' => [
            'new' => 'New',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            'canceled' => 'Canceled',
        ],
        'payment' => [
            'pending' => 'Pending',
            'paid' => 'Paid',
            'failed' => 'Failed',
        ],
    ],
    'mobile' => [
        'labels' => [
            'order' => 'Order:',
            'date' => 'Date:',
            'order_status' => 'Order Status:',
            'payment_status' => 'Payment Status:',
            'order_amount' => 'Order amount:',
        ],
    ],
];
