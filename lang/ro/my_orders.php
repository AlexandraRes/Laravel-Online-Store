<?php

return [
    'page_title' => 'Comenzile mele - ',
    'title' => 'Comenzile mele',
    'table' => [
        'headers' => [
            'order' => 'Comandă',
            'date' => 'Data',
            'order_status' => 'Statutul comenzii',
            'payment_status' => 'Statutul achitării',
            'order_amount' => 'Suma comenzii',
            'action' => 'Acțiune',
        ],
        'empty' => 'Nu aveți nicio comandă!',
        'button' => [
            'text' => 'Vezi detalii',
        ],
    ],
    'statuses' => [
        'order' => [
            'new' => 'Nouă',
            'processing' => 'În procesare',
            'shipped' => 'Expediată',
            'delivered' => 'Livrată',
            'canceled' => 'Anulată',
        ],
        'payment' => [
            'pending' => 'În așteptare',
            'paid' => 'Plătită',
            'failed' => 'Eșuată',
        ],
    ],
    'mobile' => [
        'labels' => [
            'order' => 'Comanda:',
            'date' => 'Data:',
            'order_status' => 'Statutul comenzii:',
            'payment_status' => 'Statutul achitării:',
            'order_amount' => 'Suma comenzii:',
        ],
    ],
];
