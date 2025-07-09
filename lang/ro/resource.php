<?php

return [
    'shared' => [
        'fields' => [
            'id' => 'ID',
            'name' => 'Denumire',
            'user_name' => 'Utilizator',
            'email' => 'E-mail',
            'email_verified_at' => 'Email verificat la data',
            'password' => 'Parolă',
            'slug' => 'Legătură',
            'image' => 'Imagine',
            'images' => 'Imagini',
            'is_active' => 'Activ',
            'updated_at' => 'Actualizat',
            'created_at' => 'Creat',
            'view' => 'Vizualizează',
            'edit' => 'Editează',
            'delete' => 'Șterge',
            'price' => 'Preț',
            'in_stock' => 'În stoc',
            'on_sale' => 'La reducere',
            'is_featured' => 'Recomandat',
            'description' => 'Descriere',
            'category' => 'Categorie',
            'brand' => 'Brand',
            'status' => 'Statutul',
            'payment_method' => 'Metodă de plată',
            'payment_status' => 'Statutul achitării',
            'grand_total' => 'Total general',
            'currency' => 'Vulta',
            'shipping_method' => 'Metoda de livrare',

        ],
        'bulk' => [
            'delete' => 'Șterge selecția',
            'delete_heading' => 'Confirmare ștergere',
            'delete_description' => 'Ești sigur că vrei să ștergi înregistrările selectate? Această acțiune nu poate fi anulată.',
            'delete_success' => 'Înregistrările selectate au fost șterse cu succes.',
        ],
        'sections' => [
            'product_information' => 'Informații produs',
            'price' => 'Preț',
            'associations' => 'Asocieri',
            'images' => 'Imagini',
            'status' => 'Stare',
        ],
        'navigation' => [
            'content' => 'Conținut',
        ],
    ],
    'brand' => [
        'title' => [
            'singular' => 'mărcii',
            'plural' => 'Mărci',
        ],
    ],
    'category' => [
        'title' => [
            'singular' => 'categorie',
            'plural' => 'Categorii',
        ],
    ],
    'product' => [
        'title' => [
            'singular' => 'produs',
            'plural' => 'Produse',
        ],
    ],
    'user' => [
        'title' => [
            'singular' => 'utilizator',
            'plural' => 'Utilizatori',
        ],
    ],
    'order' => [
        'title' => [
            'singular' => 'Comandă',
            'plural' => 'Comenzi',
        ],
        'new_order' => 'Comandă nouă',
        'status' => [
            'new' => 'Nou',
            'processing' => 'În procesare',
            'shipped' => 'Expediat',
            'delivered' => 'Livrat',
            'canceled' => 'Anulat',
        ],
        'payment_status' => [
            'pending' => 'În așteptare',
            'paid' => 'Plătit',
            'failed' => 'Eșuat',
        ],
        'payment_method' => [
            'cod' => 'Plată la livrare',
            'stripe' => 'Stripe',
        ],
    ],
];
