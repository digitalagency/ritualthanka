<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'roles' => [
            'created' => 'The role was successfully created.',
            'deleted' => 'The role was successfully deleted.',
            'updated' => 'The role was successfully updated.',
        ],

        'users' => [
            'cant_resend_confirmation' => 'The application is currently set to manually approve users.',
            'confirmation_email'  => 'A new confirmation e-mail has been sent to the address on file.',
            'confirmed'              => 'The user was successfully confirmed.',
            'created'             => 'The user was successfully created.',
            'deleted'             => 'The user was successfully deleted.',
            'deleted_permanently' => 'The user was deleted permanently.',
            'restored'            => 'The user was successfully restored.',
            'session_cleared'      => "The user's session was successfully cleared.",
            'social_deleted' => 'Social Account Successfully Removed',
            'unconfirmed' => 'The user was successfully un-confirmed',
            'updated'             => 'The user was successfully updated.',
            'updated_password'    => "The user's password was successfully updated.",
        ],

        'article'   =>[
            'created'             => 'The Article was successfully created.',
            'updated'             => 'The Article was successfully updated.',
            'deleted'             => 'The Article was successfully deleted.',
            'existed'             => 'The Article with title already exist.',
        ],

        'page'   =>[
            'created'             => 'The Page was successfully created.',
            'updated'             => 'The Pages was successfully updated.',
            'deleted'             => 'The Page was successfully deleted.',
            'existed'             => 'The Page with title already exist.',
        ],

        'category'   =>[
            'created'             => 'The Category was successfully created.',
            'updated'             => 'The Category was successfully updated.',
            'deleted'             => 'The Category was successfully deleted.',
            'existed'             => 'The Category with title already exist.',
        ],
        'product'   =>[
            'created'             => 'The Product was successfully created.',
            'updated'             => 'The Product was successfully updated.',
            'deleted'             => 'The Product was successfully deleted.',
            'existed'             => 'The Product with title already exist.',
        ],

        'post'   =>[
            'created'             => 'The Post was successfully created.',
            'updated'             => 'The Post was successfully updated.',
            'deleted'             => 'The Post was successfully deleted.',
            'existed'             => 'The Post with title already exist.',
        ],

        'banner'   =>[
            'created'             => 'The Banner was successfully created.',
            'updated'             => 'The Banner was successfully updated.',
            'deleted'             => 'The Banner was successfully deleted.',
            'existed'             => 'The Banner with title already exist.',
        ],
        'brocade'   =>[
            'created'             => 'The Brocade was successfully created.',
            'updated'             => 'The Brocade was successfully updated.',
            'deleted'             => 'The Brocade was successfully deleted.',
            'existed'             => 'The Brocade with title already exist.',
        ],
        'handle'   =>[
            'created'             => 'The Handle was successfully created.',
            'updated'             => 'The Handle was successfully updated.',
            'deleted'             => 'The Handle was successfully deleted.',
            'existed'             => 'The Handle with title already exist.',
        ],
        'news'   =>[
            'created'             => 'The News & Events was successfully created.',
            'updated'             => 'The News & Events was successfully updated.',
            'deleted'             => 'The News & Events was successfully deleted.',
            'existed'             => 'The News & Events with title already exist.',
        ],
        'buyers_allo'=>[
          'updated'              => 'The Discount Allocation for buyer was successfully updated.',
        ],

        'order'=>[
            'updated'              => 'The Order was successfully updated.',
        ],

    ],

    'frontend' => [
        'contact' => [
            'sent' => 'Your information was successfully sent. We will respond back to the e-mail provided as soon as we can.',
        ],
    ],
];
