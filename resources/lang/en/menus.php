<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'Access Management',

            'roles' => [
                'all'        => 'All Roles',
                'create'     => 'Create Role',
                'edit'       => 'Edit Role',
                'management' => 'Role Management',
                'main'       => 'Roles',
            ],

            'users' => [
                'all'             => 'All Users',
                'change-password' => 'Change Password',
                'create'          => 'Create User',
                'deactivated'     => 'Deactivated Users',
                'deleted'         => 'Deleted Users',
                'edit'            => 'Edit User',
                'main'            => 'Users',
                'view'            => 'View User',
            ],
        ],

        'log-viewer' => [
            'main'      => 'Log Viewer',
            'dashboard' => 'Dashboard',
            'logs'      => 'Logs',
        ],

        'article' => [
            'main'      => 'Article Management',
            'all'       => 'All Articles',
            'add'      => 'Add New Article',
        ],

        'page' => [
            'main'      => 'Page Management',
            'all'       => 'All Pages',
            'add'      => 'Add New Page',
        ],

        'product' => [
            'main'      => 'Product Management',
            'product'       => 'All Products',
            'add'         => 'Add New Product',
            'category'      => 'Product Category',
            'add_product'      => 'Add New Product',
        ],
        'option' => [
            'main'      => 'Options',
            'exchange'      => 'Exchange Rate',
            'buyers'      => 'Buyers',
            'orders'      => 'Orders',
        ],

        'banner' => [
            'main'      => 'Banner Management',
            'banner'       => 'All Banners',
            'add'         => 'Add New Banner',
            'category'      => 'Banner Category',
        ],

        'brocade' => [
            'main'      => 'Brocade Management',
            'brocade'       => 'All Brocades',
            'add'         => 'Add New Brocade',
            'category'      => 'Brocade Category',
        ],

        'handle' => [
            'main'      => 'Handle Management',
            'handle'       => 'All Handles',
            'add'         => 'Add New Handle',
            'category'      => 'Handle Category',
        ],

        'post' => [
            'main'      => 'Post Management',
            'post'       => 'All Posts',
            'add'         => 'Add New Post',
            'category'      => 'Post Category',
        ],

        'news' => [
            'main'      => 'News & Events Management',
            'post'       => 'All News & Events',
            'add'         => 'Add New News & Events',
            'category'      => 'Post Category',
        ],

        'sidebar' => [
            'dashboard' => 'Dashboard',
            'general'   => 'General',
            'system'    => 'System',
        ],
    ],

    'language-picker' => [
        'language' => 'Language',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar'    => 'Arabic',
            'zh'    => 'Chinese Simplified',
            'zh-TW' => 'Chinese Traditional',
            'da'    => 'Danish',
            'de'    => 'German',
            'el'    => 'Greek',
            'en'    => 'English',
            'es'    => 'Spanish',
            'fr'    => 'French',
            'id'    => 'Indonesian',
            'it'    => 'Italian',
            'ja'    => 'Japanese',
            'nl'    => 'Dutch',
            'pt_BR' => 'Brazilian Portuguese',
            'ru'    => 'Russian',
            'sv'    => 'Swedish',
            'th'    => 'Thai',
            'tr'    => 'Turkish',
        ],
    ],
];
