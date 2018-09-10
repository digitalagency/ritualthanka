<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'     => 'All',
        'yes'     => 'Yes',
        'no'      => 'No',
        'custom'  => 'Custom',
        'actions' => 'Actions',
        'active'  => 'Active',
        'buttons' => [
            'save'   => 'Save',
            'update' => 'Update',
        ],
        'hide'              => 'Hide',
        'inactive'          => 'Inactive',
        'none'              => 'None',
        'show'              => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create'     => 'Create Role',
                'edit'       => 'Edit Role',
                'management' => 'Role Management',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions'     => 'Permissions',
                    'role'            => 'Role',
                    'sort'            => 'Sort',
                    'total'           => 'role total|roles total',
                ],
            ],

            'users' => [
                'active'              => 'Active Users',
                'all_permissions'     => 'All Permissions',
                'change_password'     => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create'              => 'Create User',
                'deactivated'         => 'Deactivated Users',
                'deleted'             => 'Deleted Users',
                'edit'                => 'Edit User',
                'management'          => 'User Management',
                'no_permissions'      => 'No Permissions',
                'no_roles'            => 'No Roles to set.',
                'permissions'         => 'Permissions',

                'table' => [
                    'confirmed'      => 'Confirmed',
                    'created'        => 'Created',
                    'email'          => 'E-mail',
                    'id'             => 'ID',
                    'last_updated'   => 'Last Updated',
                    'name'           => 'Name',
                    'first_name'     => 'First Name',
                    'last_name'      => 'Last Name',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted'     => 'No Deleted Users',
                    'roles'          => 'Roles',
                    'social' => 'Social',
                    'total'          => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history'  => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmed',
                            'created_at'   => 'Created At',
                            'deleted_at'   => 'Deleted At',
                            'email'        => 'E-mail',
                            'last_updated' => 'Last Updated',
                            'name'         => 'Name',
                            'first_name'   => 'First Name',
                            'last_name'    => 'Last Name',
                            'status'       => 'Status',
                        ],
                    ],
                ],

                'view' => 'View User',
            ],
        ],

        'article' => [

            'management'          => 'Article Management',
            'all_article'         => 'All Articles',
            'add'                 => 'Add New Article',
            'view'                => 'View Article',
            'show'                => 'View Article',
            'edit'                => 'Edit Article',
            'table' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'title'           => 'Article Title',
                'slug'        => 'Article slug',
                'total'          => 'article total|articles total',
                'status'          => 'Article Status',
            ],
            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history'  => 'History',
                ],

                'content' => [
                    'overview' => [
                        'confirmed'    => 'Confirmed',
                        'created_at'   => 'Created At',
                        'deleted_at'   => 'Deleted At',
                        'email'        => 'E-mail',
                        'last_updated' => 'Last Updated',
                        'name'         => 'Article Name',
                        'slug'         => 'Article Slug',
                        'description'   => 'Article Description',
                        'image'   => 'Article Image',
                        'status'       => 'Article Status',
                    ],
                ],
            ],

        ],


        'page' => [

            'management'          => 'Page Management',
            'all_page'         => 'All Pages',
            'add'                 => 'Add New Page',
            'view'                => 'View Page',
            'show'                => 'View Page',
            'edit'                => 'Edit Page',
            'table' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'title'           => 'Page Title',
                'slug'        => 'Page slug',
                'total'          => 'page total|Pages total',
                'status'          => 'Page Status',
            ],
            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history'  => 'History',
                ],

                'content' => [
                    'overview' => [
                        'confirmed'    => 'Confirmed',
                        'created_at'   => 'Created At',
                        'deleted_at'   => 'Deleted At',
                        'email'        => 'E-mail',
                        'last_updated' => 'Last Updated',
                        'name'         => 'Page Name',
                        'slug'         => 'Page Slug',
                        'description'   => 'Page Description',
                        'image'   => 'Page Image',
                        'status'       => 'Page Status',
                    ],
                ],
            ],

        ],
        'product' => [
            'management'          => 'Product Management',
            'category'            => 'Product Categroy',
            'add_category'        => 'Add New Category',
            'edit_category'       => 'Update Category',
            'cattable' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'name'           => 'Name',
                'slug'           => 'slug',
                'total'          => 'page total|Pages total',
                'status'         => 'Page Status',
            ],
            'all_product'       =>  'All Products',
            'add_product'       =>  'Add New Products',
            'table' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'title'          => 'Product Title',
                'slug'           => 'Product slug',
                'total'          => 'product total|products total',
                'status'          => 'Product Status',
            ],
            'exchange' => [
                'management'          => 'Exchange Rate',
                'created'        => 'Created',
                'name'          => 'Country Name',
                'code'          => 'Country Code',
                'rate'          => 'Exchange Rate',
                'status'          => 'Product Status',
                'exchange_rate' => 'Exchange Rate for'
            ],


        ],

        'post' => [
            'management'          => 'Post Management',
            'category'            => 'Post Categroy',
            'add_category'        => 'Add New Category',
            'edit_category'       => 'Edit Category',
            'cattable' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'name'           => 'Name',
                'slug'           => 'slug',
                'total'          => 'page total|Pages total',
                'status'         => 'Page Status',
            ],
            'all_post'       =>  'All Posts',
            'add_post'       =>  'Add New Posts',
            'table' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'title'          => 'Post Title',
                'slug'           => 'Post slug',
                'total'          => 'Post total|Posts total',
                'status'          => 'Post Status',
            ],
        ],

        'news' => [
            'management'          => 'News & Events Management',
            'category'            => 'News & Events Categroy',
            'add_category'        => 'Add New Category',
            'edit_category'       => 'Edit Category',
            'cattable' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'name'           => 'Name',
                'slug'           => 'slug',
                'total'          => 'page total|Pages total',
                'status'         => 'Page Status',
            ],
            'all_post'       =>  'All News & Events',
            'add_post'       =>  'Add New News & Events',
            'table' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'title'          => 'News & Events Title',
                'slug'           => 'News & Events slug',
                'total'          => 'News & Events total|News & Events total',
                'status'          => 'News & Events Status',
            ],
        ],

        'banner' => [
            'management'          => 'Banner Management',
            'category'            => 'Banner Categroy',
            'add_category'        => 'Add New Category',
            'edit_category'       => 'Edit Category',
            'cattable' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'name'           => 'Name',
                'slug'           => 'slug',
                'total'          => 'page total|Pages total',
                'status'         => 'Page Status',
            ],
            'all_banner'       =>  'All Banners',
            'add_banner'       =>  'Add New Banners',
            'table' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'title'          => 'Banner Title',
                'slug'           => 'Banner slug',
                'total'          => 'banner total|banners total',
                'status'          => 'Banner Status',
            ],

        ],

        'brocade' => [
            'management'          => 'Brocade Management',
            'category'            => 'Brocade Categroy',
            'add_category'        => 'Add New Brocade',
            'edit_category'       => 'Edit Category',
            'cattable' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'name'           => 'Name',
                'slug'           => 'slug',
                'total'          => 'brocade total|brocades total',
                'status'         => 'Page Status',
            ],
            'all_brocade'       =>  'All Brocades',
            'add_brocade'       =>  'Add New Brocades',
            'table' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'title'          => 'Brocade Title',
                'slug'           => 'Brocade slug',
                'total'          => 'brocade total|brocades total',
                'status'          => 'Brocade Status',
            ],
        ],

        'handle' => [
            'management'          => 'Handle Management',
            'category'            => 'Handle Categroy',
            'add_category'        => 'Add New Handle',
            'edit_category'       => 'Edit Category',
            'cattable' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'name'           => 'Name',
                'slug'           => 'slug',
                'total'          => 'handle total|handles total',
                'status'         => 'Page Status',
            ],
            'all_handle'       =>  'All Handles',
            'add_handle'       =>  'Add New Handle',
            'table' => [
                'created'        => 'Created',
                'email'          => 'E-mail',
                'id'             => 'ID',
                'last_updated'   => 'Last Updated',
                'title'          => 'Handle Title',
                'slug'           => 'Handle slug',
                'total'          => 'handle total|handles total',
                'status'          => 'Handle Status',
            ],
        ],

        'option' => [
            'exchange' => [
                'management'          => 'Exchange Rate',
                'created'        => 'Created',
                'name'          => 'Country Name',
                'code'          => 'Country Code',
                'rate'          => 'Exchange Rate',
                'status'          => 'Product Status',
                'exchange_rate' => 'Exchange Rate for'
            ],

            'buyers' => [
                'management'          => 'Buyers',
                'created'        => 'Created',
                'name'          => 'Full Name',
                'email'          => 'Email Address',
                'allocation'          => 'Allocated Discount(in %)',
                'allocated_disc' => 'Allocated Discount for '
            ],


            'orders' => [
                'management'          => 'Order List',
                'created'        => 'Created',

                'table' => [
                    'buyer'          => 'Customer',
                    'product'        => 'Product Detail',
                    'id'             => 'Payment ID',
                    'address'        => 'Customer Address',
                    'buyer_name'     => 'Buyer Name',
                    'created_at'     => 'Ordered Date',
                    'status'         => 'Status',
                ],
            ],
        ],

    ],

    'frontend' => [

        'auth' => [
            'admin_login_box_title'    => 'Admin Login',
            'login_box_title'    => 'Login',
            'login_button'       => 'Login',
            'login_with'         => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button'    => 'Register',
            'remember_me'        => 'Remember Me',
        ],

        'contact' => [
            'box_title' => 'Contact Us',
            'button' => 'Send Information',
        ],

        'passwords' => [
            'forgot_password'                 => 'Forgot Your Password?',
            'reset_password_box_title'        => 'Reset Password',
            'reset_password_button'           => 'Reset Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'macros' => [
            'country' => [
                'alpha'   => 'Country Alpha Codes',
                'alpha2'  => 'Country Alpha 2 Codes',
                'alpha3'  => 'Country Alpha 3 Codes',
                'numeric' => 'Country Numeric Codes',
            ],

            'macro_examples' => 'Macro Examples',

            'state' => [
                'mexico' => 'Mexico State List',
                'us'     => [
                    'us'       => 'US States',
                    'outlying' => 'US Outlying Territories',
                    'armed'    => 'US Armed Forces',
                ],
            ],

            'territories' => [
                'canada' => 'Canada Province & Territories List',
            ],

            'timezone' => 'Timezone',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Created At',
                'edit_information'   => 'Edit Information',
                'email'              => 'E-mail',
                'last_updated'       => 'Last Updated',
                'name'               => 'Name',
                'first_name'         => 'First Name',
                'last_name'          => 'Last Name',
                'update_information' => 'Update Information',
            ],
        ],

    ],
];
