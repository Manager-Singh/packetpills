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
        'all' => 'All',
        'yes' => 'Yes',
        'no' => 'No',
        'copyright' => 'Copyright',
        'custom' => 'Custom',
        'actions' => 'Actions',
        'active' => 'Active',
        'notconnected' => 'Not Connected',
        'connected' => 'Connected',
        'buttons' => [
            'save' => 'Save',
            'update' => 'Update',
        ],
        'hide' => 'Hide',
        'inactive' => 'Inactive',
        'none' => 'None',
        'show' => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
        'create_new' => 'Create New',
        'toolbar_btn_groups' => 'Toolbar with button groups',
        'more' => 'More',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',
                'label' => 'Roles',
                'all' => 'Roles',

                'table' => [
                    'number_of_users' => 'Number of Patients',
                    'permissions' => 'Permissions',
                    'role' => 'Role',
                    'sort' => 'Sort',
                    'total' => 'role total|roles total',
                ],
            ],
            'transfer-requests'=>[
                'management' => 'Transfer Request Management',
            ],

            'permissions' => [
                'all' => 'All Permissions',
                'active' => 'Permission List',
                'create' => 'Create Permission',
                'deactivated' => 'Deactivated Permission',
                'deleted' => 'Deleted Permission',
                'edit' => 'Edit Permission',
                'management' => 'Permission Management',
                'label' => 'Permissions',
                'list' => 'Permission List',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'permission' => 'Permission',
                    'display_name' => 'Display Name',
                    'sort' => 'Sort',
                    'status' => 'Status',
                    'createdby' => 'Created By',
                    'createdat' => 'Created At',
                    'total' => 'permissions total|permissions total',
                ],
            ],
            'members' => [
                'create' => 'Create Member',
                'management' => 'Member management',
            ],
            'users' => [
                'active' => 'Active Patients',
                'all_permissions' => 'All Permissions',
                'change_password' => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create' => 'Create Patient',
                'deactivated' => 'Deactivated Patients',
                'deleted' => 'Deleted Patients',
                'edit' => 'Edit Patient',
                'management' => 'Patient management',
                'no_permissions' => 'No Permissions',
                'no_roles' => 'No Roles to set.',
                'permissions' => 'Permissions',
                'user_actions' => 'Patients Actions',
                'create' => 'Create Member',

                'table' => [
                    'confirmed' => 'Confirmed',
                    'created' => 'Created',
                    'email' => 'E-mail',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'name' => 'Name',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'no_deactivated' => 'No Deactivated Patients',
                    'no_deleted' => 'No Deleted Patients',
                    'other_permissions' => 'Other Permissions',
                    'permissions' => 'Permissions',
                    'abilities' => 'Abilities',
                    'roles' => 'Roles',
                    'social' => 'Social',
                    'total' => 'patient total|Patient total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history' => 'History',
                        'address' => 'Address',
                        'healthcard' => 'Health Card',
                        'insurance' => 'Insurance',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar' => 'Avatar',
                            'confirmed' => 'Confirmed',
                            'created_at' => 'Created At',
                            'deleted_at' => 'Deleted At',
                            'email' => 'E-mail',
                            'last_login_at' => 'Last Login At',
                            'last_login_ip' => 'Last Login IP',
                            'last_updated' => 'Last Updated',
                            'name' => 'Name',
                            'first_name' => 'First Name',
                            'last_name' => 'Last Name',
                            'status' => 'Status',
                            'timezone' => 'Timezone',
                        ],
                    ],
                ],

                'view' => 'View Patient',
            ],

            'blogs' => [
                'all' => 'All Blogs',
                'active' => 'Blog List',
                'create' => 'Create Blog',
                'deactivated' => 'Deactivated Blogs',
                'deleted' => 'Deleted Blog',
                'edit' => 'Edit Blog',
                'management' => 'Blog Management',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'title' => 'Blog Title',
                    'category' => 'Blog Categories',
                    'published' => 'Publish Date & Time',
                    'featured_image' => 'Featured Image',
                    'content' => 'Content',
                    'tags' => 'Tags',
                    'meta_title' => 'Meta Title',
                    'slug' => 'Slug',
                    'cannonical_link' => 'Cannonical Link',
                    'meta_keywords' => 'Meta Keywords',
                    'meta_description' => 'Meta Description',
                    'status' => 'Status',
                    'createdby' => 'Created By',
                    'createdat' => 'Created At',
                    'total' => 'blog total|blogs total',
                ],
            ],
            'drugs' => [
                'all' => 'All Drugs',
                'active' => 'Drug List',
                'create' => 'Create Drug',
                'deactivated' => 'Deactivated Drugs',
                'deleted' => 'Deleted Drug',
                'edit' => 'Edit Drug',
                'management' => 'Drug Management',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'brand_name' => 'Brand Name',
                    'main_therapeutic_use' => 'Main Therapeutic Use',
                    'generic_name' => 'Generic Name',
                    'strength' => 'Strength',
                    'side_effect' => 'Side Effect',
                    'strength_unit' => 'Strength Unit',
                    'format' => 'Format',
                    'manufacturer' => 'Manufacturer',
                    'pack_size' => 'Pack Size',
                    'pack_unit' => 'Pack Unit',
                    'din' => 'DIN',
                    'presciption_required' => 'Presciption Required',
                    'upc' => 'UPC',
                    'pharmacy_purchase_price' => 'Pharmacy Purchase Price',
                    'percent_markup' => 'Percent Markup',
                    'drug_cost' => 'Drug Cost',
                    'dispensing_fee' => 'Dispensing Fee',
                    'insurance_coverage_in_percent' => 'Insurance Coverage In %',
                    'insurance_coverage_calculation_in_percent' => 'Insurance Coverage calculation In %',
                    'delivery_cost' => 'Delivery Cost',
                    'patient_pays' => 'Patient Pays',
                    'drug_indication' => 'Drug Indication',
                    'standard_dosage' => 'Standard Dosage',
                    'contraindications' => 'Contraindications',
                    'precautions' => 'Precautions',
                    'warnings' => 'Warnings',
                    'status' => 'Status',
                    'createdat' => 'Created At',
                    'total' => 'drug total|drugs total',
                ],
            ],
            'preciption-types' => [
                'all' => 'All Preciption Types',
                'active' => 'Preciption Types List',
                'create' => 'Create Preciption Types',
                'deactivated' => 'Deactivated Preciption Types',
                'deleted' => 'Deleted Preciption Types',
                'edit' => 'Edit Preciption Types',
                'management' => 'Preciption Types Management',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                   'preciption_type'=>'Preciption Type',
                    'status' => 'Status',
                    'createdat' => 'Created At',
                ],
            ],
            'auto-messages' => [
                'all' => 'All Admin Messages',
                'active' => 'Admin Messages List',
                'create' => 'Create Admin Message',
                'deactivated' => 'Deactivated Admin Messages',
                'deleted' => 'Deleted Admin Messages',
                'edit' => 'Edit Admin Message',
                'management' => 'Admin Message Management',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                   'message'=>'Message',
                    'status' => 'Status',
                    'createdat' => 'Created At',
                ],
            ],
            'mail-messages' => [
                'all' => 'All Mail & Messages',
                'active' => 'Mail & Messages List',
                'create' => 'Create Mail & Message',
                'deactivated' => 'Deactivated Mail & Messages',
                'deleted' => 'Deleted Mail & Messages',
                'edit' => 'Edit Mail & Message',
                'management' => 'Mail & Message Management',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                   'message'=>'Message',
                   'message_for'=>'Message For',
                    'status' => 'Status',
                    'createdat' => 'Created At',
                ],
            ],
            'provinces' => [
                'all' => 'All Provinces',
                'active' => 'Province List',
                'create' => 'Create Province',
                'deactivated' => 'Deactivated Province',
                'deleted' => 'Deleted Province',
                'edit' => 'Edit Province',
                'management' => 'Provinces Management',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                   'name'=>'Name',
                    'status' => 'Status',
                    'createdat' => 'Created At',
                ],
            ],

            'blog-category' => [
                'all' => 'All Blog Categories',
                'active' => 'Blog Category List',
                'create' => 'Create Blog Category',
                'deactivated' => 'Deactivated Blog Category',
                'deleted' => 'Deleted Blog Category',
                'edit' => 'Edit Blog Category',
                'management' => 'Blog Categories',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'name' => 'Category Name',
                    'category' => 'Blog Categories',
                    'status' => 'Status',
                    'createdby' => 'Created By',
                    'createdat' => 'Created At',
                    'total' => 'blog cateories total|blog categories total',
                ],
            ],

            'blog-tag' => [
                'all' => 'All Blog Tags',
                'active' => 'Blog Tag List',
                'create' => 'Create Blog Tag',
                'deactivated' => 'Deactivated Blog Tag',
                'deleted' => 'Deleted Blog Tag',
                'edit' => 'Edit Blog Tag',
                'management' => 'Blog Tags',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'name' => 'Tag Name',
                    'tag' => 'Blog Tag',
                    'status' => 'Status',
                    'createdby' => 'Created By',
                    'createdat' => 'Created At',
                    'total' => 'blog tags total|blog tags total',
                ],
            ],

            'pages' => [
                'all' => 'All Pages',
                'active' => 'Page List',
                'create' => 'Create Page',
                'deactivated' => 'Deactivated Page',
                'deleted' => 'Deleted Page',
                'edit' => 'Edit Page',
                'management' => 'Pages Management',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'page_slug' => 'Page Slug',
                    'name' => 'Page Name',
                    'description' => 'Description',
                    'cannonical_link' => 'Cannonical Link',
                    'seo_title' => 'SEO Title',
                    'seo_keyword' => 'SEO Keyword',
                    'seo_description' => 'SEO Description',
                    'status' => 'Status',
                    'createdby' => 'Created By',
                    'createdat' => 'Created At',
                    'total' => 'pages total|pages total',
                ],
            ],

            'faqs' => [
                'all' => 'All Faqs',
                'active' => 'Faq List',
                'create' => 'Create Faq',
                'deactivated' => 'Deactivated Faq',
                'deleted' => 'Deleted Faq',
                'edit' => 'Edit Faq',
                'management' => 'Faq Management',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'question' => 'Question',
                    'answer' => 'Answer',
                    'status' => 'Status',
                    'createdat' => 'Created At',
                    'total' => 'faqs total|faqs total',
                ],
            ],

            'email-templates' => [
                'all' => 'All Email Templates',
                'active' => 'Email Templates List',
                'create' => 'Create Email Template',
                'deactivated' => 'Deactivated Email Template',
                'deleted' => 'Deleted Email Template',
                'edit' => 'Edit Email Template',
                'management' => 'Email Template Management',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'slug' => 'Slug',
                    'title' => 'Email Template Title',
                    'content' => 'Content',
                    'status' => 'Status',
                    'createdat' => 'Created At',
                    'createdby' => 'Created By',
                    'total' => 'email templates total|email templates total',
                ],
            ],

            'prescriptions' => [
                'all' => 'All Prescriptions',
                'active' => 'Prescriptions List',
                'create' => 'Prescription Create',
                'deactivated' => 'Deactivated Prescription',
                'deleted' => 'Deleted Prescription',
                'edit' => 'Edit Prescription',
                'show' => 'Prescription Details',
                'management' => 'Prescription Management',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'slug' => 'Slug',
                    'name' => 'Name',
                    'medications' => 'Medications',
                    'type' => 'Type',
                    'createdat' => 'Created At',
                    'createdby' => 'Created By',
                    'prescription_id' => 'Prescriptions ID',
                ],
                'tabs' => [
                    'titles' => [
                        'page' => 'Page',
                    ],

                    'content' => [
                        'page' => [
                            'avatar' => 'Avatar',
                        ],
                    ],
                ],
            ],
            'enterpriseconnects' => [
                'all' => 'All Enterprise Connects',
                'active' => 'Enterprise Connects List',
                'create' => 'Enterprise Connects Create',
                'deactivated' => 'Deactivated Enterprise Connects',
                'deleted' => 'Deleted Enterprise Connects',
                'edit' => 'Edit Enterprise Connects',
                'show' => 'Enterprise Connects Details',
                'management' => 'Enterprise Connects Management',

                'table' => [
                    'created' => 'Created',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'company' => 'Company',
                    'fullname' => 'Full Name',
                    'job_title' => 'Lob Title',
                    'status' => 'Status',
                    'createdat' => 'Created At',
                    'createdby' => 'Created By',
                    'email' => 'Email',
                    'phone_no' => 'Phone No',
                ],
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'login_box_title' => 'Login',
            'login_button' => 'Login',
            'login_with' => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button' => 'Register',
            'remember_me' => 'Remember Me',
            "get_started" => 'Get started',
            "otp_verfied" => 'Verify OTP',
            "next" => 'Next',
        ],

        'contact' => [
            'box_title' => 'Contact Us',
            'button' => 'Send Information',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Your password has expired.',
            'forgot_password' => 'Forgot Your Password?',
            'reset_password_box_title' => 'Reset Password',
            'reset_password_button' => 'Reset Password',
            'update_password_button' => 'Update Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'avatar' => 'Avatar',
                'created_at' => 'Created At',
                'edit_information' => 'Edit Information',
                'email' => 'E-mail',
                'last_updated' => 'Last Updated',
                'name' => 'Name',
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'update_information' => 'Update Information',
            ],
        ],
    ],
];
