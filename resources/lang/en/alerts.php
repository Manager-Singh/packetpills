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
        'access' => [
            'roles' => [
                'created' => 'The role was successfully created.',
                'updated' => 'The role was successfully updated.',
                'deleted' => 'The role was successfully deleted.',
            ],

            'permissions' => [
                'created' => 'The permission was successfully created.',
                'updated' => 'The permission was successfully updated.',
                'deleted' => 'The permission was successfully deleted.',
            ],

            'users' => [
                'created' => 'The Patient was successfully created.',
                'updated' => 'The Patient was successfully updated.',
                'deleted' => 'The Patient was successfully deleted.',
                'deleted_permanently' => 'The Patient was deleted permanently.',
                'restored' => 'The Patient was successfully restored.',
                'cant_resend_confirmation' => 'The application is currently set to manually approve Patients.',
                'confirmation_email' => 'A new confirmation e-mail has been sent to the address on file.',
                'confirmed' => 'The Patient was successfully confirmed.',
                'session_cleared' => "The Patient's session was successfully cleared.",
                'social_deleted' => 'Social Account Successfully Removed',
                'unconfirmed' => 'The Patient was successfully un-confirmed',
                'updated_password' => "The Patient's password was successfully updated.",
            ],
        ],

        'blogs' => [
            'created' => 'The blog was successfully created.',
            'updated' => 'The blog was successfully updated.',
            'deleted' => 'The blog was successfully deleted.',
        ],

        'drugs' => [
            'created' => 'The drug was successfully created.',
            'updated' => 'The drug was successfully updated.',
            'deleted' => 'The drug was successfully deleted.',
        ],

        'blog-category' => [
            'created' => 'The blog category was successfully created.',
            'updated' => 'The blog category was successfully updated.',
            'deleted' => 'The blog category was successfully deleted.',
        ],

        'blog-tags' => [
            'created' => 'The blog tag was successfully created.',
            'updated' => 'The blog tag was successfully updated.',
            'deleted' => 'The blog tag was successfully deleted.',
        ],

        'pages' => [
            'created' => 'The page was successfully created.',
            'updated' => 'The page was successfully updated.',
            'deleted' => 'The page was successfully deleted.',
        ],

        'faqs' => [
            'created' => 'The faq was successfully created.',
            'updated' => 'The faq was successfully updated.',
            'deleted' => 'The faq was successfully deleted.',
        ],

        'email-templates' => [
            'created' => 'The email template was successfully created.',
            'updated' => 'The email template was successfully updated.',
            'deleted' => 'The email template was successfully deleted.',
        ],
        'enterpriseconnects'=> [
            'created' => 'The enterprise connect was successfully created.',
            'updated' => 'The enterprise connect was successfully updated.',
            'deleted' => 'The enterprise connect was successfully deleted.',
        ],
        'preciption-types'=> [
            'created' => 'The preciption types was successfully created.',
            'updated' => 'The preciption types was successfully updated.',
            'deleted' => 'The preciption types was successfully deleted.',
        ],
        'auto-messages'=> [
            'created' => 'The Admin Message was successfully created.',
            'updated' => 'The Admin Message was successfully updated.',
            'deleted' => 'The Admin Message was successfully deleted.',
        ],
        'mail-messages'=> [
            'created' => 'The Mail & Message was successfully created.',
            'updated' => 'The Mail & Message was successfully updated.',
            'deleted' => 'The Mail & Message was successfully deleted.',
        ],
        'provinces'=> [
            'created' => 'The province was successfully created.',
            'updated' => 'The province was successfully updated.',
            'deleted' => 'The province was successfully deleted.',
        ],
        
    ],

    'frontend' => [
        'contact' => [
            'sent' => 'Your information was successfully sent. We will respond back to the e-mail provided as soon as we can.',
        ],
    ],
];
