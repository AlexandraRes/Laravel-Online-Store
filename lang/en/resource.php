<?php

return [
    'shared' => [
        'fields' => [
            'id' => 'ID',
            'name' => 'Name',
            'user_name' => 'User',
            'email' => 'Email',
            'email_verified_at' => 'Email verified at',
            'password' => 'Password',
            'slug' => 'Slug',
            'image' => 'Image',
            'images' => 'Images',
            'is_active' => 'Active',
            'updated_at' => 'Updated',
            'created_at' => 'Created',
            'view' => 'View',
            'edit' => 'Edit',
            'delete' => 'Delete',
            'price' => 'Price',
            'in_stock' => 'In Stock',
            'on_sale' => 'On Sale',
            'is_featured' => 'Featured',
            'description' => 'Description',
            'category' => 'Category',
            'brand' => 'Brand',
            'status' => 'Status',
            'payment_method' => 'Payment Method',
            'payment_status' => 'Payment Status',
            'grand_total' => 'Grand Total',
            'currency' => 'Currency',
            'shipping_method' => 'Shipping method',
            'notes' => 'Notes',
            'items' => 'Items',
            'item' => 'Item',
            'quantity' => 'Quantity',
            'unit_amount' => 'Unit amount',
            'total_amount' => 'Total amount',
            'full_name' => 'Full Name',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'phone' => 'Phone',
            'city' => 'City',
            'state' => 'State',
            'zip_code' => 'Zip code',
        ],
        'bulk' => [
            'delete' => 'Delete selected',
            'delete_heading' => 'Delete confirmation',
            'delete_description' => 'Are you sure you want to delete the selected records? This action cannot be undone.',
            'delete_success' => 'Selected records were successfully deleted.',
        ],
        'sections' => [
            'product_information' => 'Product Information',
            'order_information' => 'Order Information',
            'order_items' => 'Ordered Items',
            'price' => 'Price',
            'associations' => 'Associations',
            'images' => 'Images',
            'status' => 'Status',
            'address' => 'Address',
        ],
        'navigation' => [
            'content' => 'Content'
        ]
    ],
    'brand' => [
        'title' => [
            'singular' => 'brand',
            'plural' => 'Brands',
        ],
    ],
    'category' => [
        'title' => [
            'singular' => 'category',
            'plural' => 'Categories',
        ],
    ],
    'product' => [
        'title' => [
            'singular' => 'product',
            'plural' => 'Products',
        ],
    ],
    'user' => [
        'title' => [
            'singular' => 'user',
            'plural' => 'Users',
        ],
    ],
    'address' => [
        'title' => [
            'singular' => 'address',
            'plural' => 'Addresses',
        ],
    ],
    'order' => [
        'title' => [
            'singular' => 'Order',
            'plural' => 'Orders',
        ],
        'new_order' => 'New order',
        'status' => [
            'new' => 'New',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            'canceled' => 'Canceled',
        ],
        'payment_status' => [
            'pending' => 'Pending',
            'paid' => 'Paid',
            'failed' => 'Failed',
        ],
        'payment_method' => [
            'cod' => 'Cash On Delivery',
            'stripe' => 'Stripe',
        ],
    ],
];
