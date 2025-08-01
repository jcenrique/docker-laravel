<?php

declare(strict_types=1);

return [
    'name' => 'Izena',
    'email' => 'Emaila',
    'password' => 'Pasahitza',
    'email_verified_at' => 'Emaila egiaztatuta',
    'created_at' => 'Sortu denbora',
    'updated_at' => 'Eguneratu denbora',
    'deleted_at' => 'Ezabatutako denbora',

    'market_management_nav_group' => 'Merkatuaren kudeaketa',

    /*
    |--------------------------------------------------------------------------
    | Filament Resource
    |--------------------------------------------------------------------------
    */
    'panel_avalaible_titles' => [
        'title' => 'Eskuragarri dauden panelak',
        'description' => 'Aldatu nahi duzun panelaren hautaketa',
        'admin' => 'Administrazio Panel',
        'app' => 'Aplikazio Panel',
    ],
    'user_resource_label' => 'Erabiltzaileak',
    'user_resource_plural_label' => 'Erabiltzaileak',



    'user_management_nav_group' => 'Erabiltzaileen kudeaketa',

    'latest_users' => 'Azken Erabiltzaileak',
    'latest_users_description' => 'Sistemara azken erregistratutako erabiltzaileen zerrenda',
    'latest_users_empty' => 'Oraindik ez dago erabiltzaile erregistraturik.',


    /*|--------------------------------------------------------------------------
    | Category Resource
    |--------------------------------------------------------------------------
    */
    'category_resource_label' => 'Kategoria',
    'category_resource_plural_label' => 'Kategoriek',
    'image' => 'Irudia',
    'image_helper_text' => 'Irudia PNG, JPG edo JPEG formatuan izan behar da eta 2MB-ko tamaina gainditu behar ez du.',
    'active' => 'Aktiboa',
    'description' => 'Deskribapena',
    'slug' => 'Slug',

    /*|--------------------------------------------------------------------------
    | Market Resource
    |--------------------------------------------------------------------------
    */
    'market_resource_label' => 'Merkatua',
    'market_resource_plural_label' => 'Merkatuak',
    'logo' => 'Logo',

    /*|--------------------------------------------------------------------------
    | Product Resource
    |--------------------------------------------------------------------------
    */
    'product_resource_label' => 'Produktu',
    'product_resource_plural_label' => 'Produktuak',

    'brand' => 'Marka',
    'price' => 'Prezioa',
    'is_active' => 'Aktiboa',
    'category' => 'Kategoria',
    'market' => 'Merkatua',
    'is_unique_market' => 'Produktu bakarra merkatuan',

          /*|--------------------------------------------------------------------------
    | Section Resource
    |--------------------------------------------------------------------------
    */
    'section_resource_label' => 'Atala',
    'section_resource_plural_label' => 'Atalak',


    /*|--------------------------------------------------------------------------
    | Client Resource
    |--------------------------------------------------------------------------
    */
    'clients_nav_group' => 'Bezeroen kudeaketa',

    'client_resource_label' => 'Bezero',
    'client_resource_plural_label' => 'Bezeroak',

     /*|--------------------------------------------------------------------------
    | Order Resource
    |--------------------------------------------------------------------------
    */
    'order_resource_label' => 'Eskaria',
    'order_resource_plural_label' => 'Eskariak',
    'notes' => 'Oharra',
    'order_date' => 'Eskariaren data',
    'total_price' => 'Prezio osoa',
    'order_status' => 'Eskariaren egoera',
    'items_count' => 'Produktu kopurua',
    'order_statuses' => [
        'pending' => 'Zain',
        'processing' => 'Prozesatzen',
        'completed' => 'Osatua',
        'canceled' => 'Ezeztatuta',
    ],
];
