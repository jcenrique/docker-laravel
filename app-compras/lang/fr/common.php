<?php

declare(strict_types=1);

return [
    'name' => 'Non',
    'email' => 'Email',
    'password' => 'Mot de passe',
    'email_verified_at' => 'Email vérifié',
    'created_at' => 'Date de création',
    'updated_at' => 'Date de mise à jour',
    'deleted_at' => 'Date de suppression',

    'market_management_nav_group' => 'Gestion du marché',

    /*|--------------------------------------------------------------------------
    | User Resource
    |--------------------------------------------------------------------------
    */

    'user_resource_label' => 'Utilisateur',
    'user_resource_plural_label' => 'Utilisateurs',




    'user_management_nav_group' => 'Gestion des utilisateurs',

    'panel_avalaible_titles' => [
        'title'=> 'Panneaux disponibles',
        'description' => 'électionnez le panneau auquel vous souhaitez passer',
        'admin' => 'Panneau d\'administration',
        'app' => 'Panneau d\'application',
    ],

    'latest_users' => 'Derniers utilisateurs',
    'latest_users_description' => 'Liste des derniers utilisateurs enregistrés dans le système',
    'latest_users_empty' => 'Aucun utilisateur enregistré.',


    /*|--------------------------------------------------------------------------
    | Category Resource
    |--------------------------------------------------------------------------
    */
    'category_resource_label' => 'Catégorie',
    'category_resource_plural_label' => 'Catégories',
    'image' => 'Image',
    'image_helper_text' => 'L\'image doit être au format PNG, JPG ou JPEG et ne doit pas dépasser 2 Mo.',
    'active' => 'Actif',
    'description' => 'Description',
    'slug' => 'Slug',

    /*|--------------------------------------------------------------------------
    | Market Resource
    |--------------------------------------------------------------------------
    */
    'market_resource_label' => 'Marché',
    'market_resource_plural_label' => 'Marchés',
    'logo' => 'Logo',

    /*|--------------------------------------------------------------------------
    | Product Resource
    |--------------------------------------------------------------------------
    */
    'product_resource_label' => 'Produit',
    'product_resource_plural_label' => 'Produits',
    'price' => 'Prix',
    'brand' => 'Marque',
    'is_active' => 'Est actif',
    'category' => 'Catégorie',
    'market' => 'Marché',
    'is_unique_market' => 'Produit unique par marché',

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
    'clients_nav_group' => 'Gestion des clients',

    'client_resource_label' => 'Client',
    'client_resource_plural_label' => 'Clients',


     /*|--------------------------------------------------------------------------
    | Order Resource
    |--------------------------------------------------------------------------
    */
    'order_resource_label' => 'Commande',
    'order_resource_plural_label' => 'Commandes',
    'notes' => 'Notes',
    'order_date' => 'Date de la commande',
    'total_price' => 'Prix total',
    'order_status' => 'État de la commande',
    'items_count' => 'Nombre d\'articles',
    'order_statuses' => [
        'pending' => 'En attente',
        'processing' => 'En cours de traitement',
        'completed' => 'Terminé',
        'canceled' => 'Annulé',
    ],
];
