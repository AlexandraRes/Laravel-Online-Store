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
            'notes' => 'Comentarii',
            'items' => 'Produse',
            'item' => 'Produsul',
            'quantity' => 'Cantitate',
            'unit_amount' => 'Preț unitar',
            'total_amount' => 'Suma totală',
            'full_name' => 'Nume complet',
            'first_name' => 'Prenume',
            'last_name' => 'Nume de familie',
            'phone' => 'Telefon',
            'city' => 'Oraș',
            'state' => 'Stat / Regiune',
            'zip_code' => 'Cod poștal',
        ],
        'bulk' => [
            'delete' => 'Șterge selecția',
            'delete_heading' => 'Confirmare ștergere',
            'delete_description' => 'Ești sigur că vrei să ștergi înregistrările selectate? Această acțiune nu poate fi anulată.',
            'delete_success' => 'Înregistrările selectate au fost șterse cu succes.',
        ],
        'sections' => [
            'latest_orders' => 'Ultimele comenzi',
            'product_information' => 'Informații produs',
            'order_information' => 'Detaliile comenzii',
            'order_items' => 'Produsele comandate',
            'price' => 'Preț',
            'associations' => 'Asocieri',
            'images' => 'Imagini',
            'status' => 'Stare',
            'address' => 'Adresa',
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
    'address' => [
        'title' => [
            'singular' => 'adresă',
            'plural' => 'Adrese',
        ],
    ],
    'order' => [
        'title' => [
            'singular' => 'Comandă',
            'plural' => 'Comenzi',
        ],
        'new_order' => 'Comandă nouă',
        'status' => [
            'all' => 'Toate',
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
        'widget' => [
            'order_stats' => [
                'heading' => 'Informații despre comenzi',
                'description' => 'Widgeturile de mai jos oferă informații concise despre statusurile comenzilor.',
                'new_orders' => 'Comenzi noi',
                'new_orders_description' => 'Comenzile trebuie procesate până la ora 12:00',
                'processing_orders' => 'Comenzi în procesare',
                'shipped_orders' => 'Comenzi expediate',
            ],
            'second_order_stats' => [
                'heading' => 'Informații despre profit',
                'description' => 'Widgeturile de mai jos oferă informații despre profitul pentru întreaga perioadă.',
                'profit' => 'Profit',
            ]
        ],
    ],
];
