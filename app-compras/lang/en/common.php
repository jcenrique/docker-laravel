<?php

declare(strict_types=1);

return [
    'name' => 'Name',
    'email' => 'Email',
    'password' => 'Password',
    'email_verified_at' => 'Email verified',
    'created_at' => 'Creation date',
    'updated_at' => 'Update date',
    'deleted_at' => 'Deletion date',

    /*
    |--------------------------------------------------------------------------
    | Filament Resource
    |--------------------------------------------------------------------------
    */

    'panel_avalaible_titles' => [
        'title'=> 'Panels available',
        'description' => 'Select the panel you want to switch to',
        'admin' => 'Admin Panel',
        'app' => 'Application Panel',
    ],

    'user_resource_label' => 'User',
    'user_resource_plural_label' => 'Users',



    'user_management_nav_group' => 'User Management',

    'latest_users' => 'Latest Users',
    'latest_users_description' => 'List of the latest registered users in the system',
    'latest_users_empty' => 'No users registered yet.',

      /*|--------------------------------------------------------------------------
    | Category Resource
    |--------------------------------------------------------------------------
    */
    'category_resource_label' => 'Category',
    'category_resource_plural_label' => 'Categories',
    'image' => 'Image',
    'image_helper_text' => 'The image must be in PNG, JPG, or JPEG format and must not exceed 2MB in size.',
    'active' => 'Active',
    'description' => 'Description',
    'slug' => 'Slug',

    /*|--------------------------------------------------------------------------
    | Market Resource
    |--------------------------------------------------------------------------
    */
    'market_resource_label' => 'Market',
    'market_resource_plural_label' => 'Markets',
    'logo' => 'Logo',

    /*|--------------------------------------------------------------------------
    | Product Resource
    |--------------------------------------------------------------------------
    */
    'product_resource_label' => 'Product',
    'product_resource_plural_label' => 'Products',
    'price' => 'Price',

    'brand' => 'Brand',
    'is_active' => 'Is Active',
    'category' => 'Category',
    'market' => 'Market',
    'is_unique_market' => 'Unique product per market',

          /*|--------------------------------------------------------------------------
    | Section Resource
    |--------------------------------------------------------------------------
    */
    'section_resource_label' => 'Section',
    'section_resource_plural_label' => 'Sections',

    /*|--------------------------------------------------------------------------
    | Client Resource
    |--------------------------------------------------------------------------
    */
    'clients_nav_group' => 'Client Management',

    'client_resource_label' => 'Client',
    'client_resource_plural_label' => 'Clients',

    /*|--------------------------------------------------------------------------
    | Order Resource
    |--------------------------------------------------------------------------
    */
    'order_resource_label' => 'Order',
    'order_resource_plural_label' => 'Orders',
    'notes' => 'Notes',
    'order_date' => 'Order date',
    'total_price' => 'Total price',
    'order_status' => 'Order status',
    'items_count' => 'Items count',
    'order_statuses' => [
        'pending' => 'Pending',
        'processing' => 'Processing',
        'completed' => 'Completed',
        'canceled' => 'Canceled',
    ],

];
