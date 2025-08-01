<?php

declare(strict_types=1);

return [
    'name' => 'Nombre',
    'email' => 'Email',
    'password' => 'Contraseña  ',
    'email_verified_at' => 'Email verificado',
    'created_at' => 'Fecha de creación',
    'updated_at' => 'Fecha de actualización',
    'deleted_at' => 'Fecha de eliminación',

    'market_management_nav_group' => 'Gestión del supermercado',

    /*
    |--------------------------------------------------------------------------
    | Filament Resource
    |--------------------------------------------------------------------------
    */

    /*|--------------------------------------------------------------------------
    | User Resource
    |--------------------------------------------------------------------------
    */

    'user_resource_label' => 'Usuario',
    'user_resource_plural_label' => 'Usuarios',



    'user_management_nav_group' => 'Gestión de Usuarios',

    'panel_avalaible_titles' => [
        'title'=> 'Paneles disponibles',
        'description' => 'Seleccione el panel al que desea cambiar',
        'admin' => 'Panel de Administración',
        'app' => 'Panel de Aplicación',
    ],

    'latest_users' => 'Últimos Usuarios',
    'latest_users_description' => 'Lista de los últimos usuarios registrados en el sistema',
    'latest_users_empty' => 'No hay usuarios registrados aún.',


    /*|--------------------------------------------------------------------------
    | Category Resource
    |--------------------------------------------------------------------------
    */
    'category_resource_label' => 'Categoría',
    'category_resource_plural_label' => 'Categorías',
    'image' => 'Imagen',
    'image_helper_text' => 'La imagen debe ser en formato PNG, JPG o JPEG y no debe exceder los 2MB de tamaño.',
    'active' => 'Activo',
    'description' => 'Descripción',
    'slug' => 'Slug',

    /*|--------------------------------------------------------------------------
    | Market Resource
    |--------------------------------------------------------------------------
    */
    'market_resource_label' => 'Supermercado',
    'market_resource_plural_label' => 'Supermercados',
    'logo' => 'Logo',

    /*|--------------------------------------------------------------------------
    | Product Resource
    |--------------------------------------------------------------------------
    */
    'product_resource_label' => 'Producto',
    'product_resource_plural_label' => 'Productos',

    'brand' => 'Marca',
    'price' => 'Precio',
    'is_active' => 'Activo',
    'category' => 'Categoría',
    'market' => 'Supermercado',
    'is_unique_market' => 'Producto único por supermercado',

      /*|--------------------------------------------------------------------------
    | Client Resource
    |--------------------------------------------------------------------------
    */
    'clients_nav_group' =>'Gestión de Clientes',

    'client_resource_label' => 'Cliente',
    'client_resource_plural_label' => 'Clientes',

        /*|--------------------------------------------------------------------------
    | Section Resource
    |--------------------------------------------------------------------------
    */
    'section_resource_label' => 'Sección',
    'section_resource_plural_label' => 'Secciones',


    /*|--------------------------------------------------------------------------
    | Order Resource
    |--------------------------------------------------------------------------
    */
    'order_resource_label' => 'Pedido',
    'order_resource_plural_label' => 'Pedidos',
    'notes' => 'Notas',
    'order_date' => 'Fecha del pedido',
    'total_price' => 'Precio total',
    'order_status' => 'Estado del pedido',
    'items_count' => 'Numero de productos',
    'order_statuses' => [
        'pending' => 'Pendiente',
        'processing' => 'Procesando',
        'completed' => 'Completado',
        'canceled' => 'Cancelado',
    ],

];
