<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in Exceptions thrown throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'roles' => [
                'already_exists' => 'هذا الدور موجود مسبقا. برجاء إختيار إسم آخر.',
                'create_error' => 'حدثت مشكلة أثناء إنشاء الدور، برجاء المحاولة مرة أخرى.',
                'delete_error' => 'حدثت مشكلة أثناء مسح الدور، برجاء إعادة المحاولة مرى أخرى.',
                'update_error' => 'هناك مشكلة في تحديث هذا الدور، برجاء المحاولة مرة أخرى.',
                'cant_delete_admin' => 'لا يمكنك إزالة دور الإداري.',
                'has_users' => 'لا يمكنك مسح هذا الدور وهناك مستخدمين مرتبطين به.',
                'needs_permission' => 'يجب عليك على الأقل إختيار صلاحية واحدة لهذا الدور.',
            ],

            'users' => [
                'create_error' => 'حدثت مشكلة أثناء إنشاء المستخدم، برجاء المحاولة مرة أخرى.',
                'delete_error' => 'حدثت مشكلة أثناء مسح المستخدم، برجاء المحاولة مرى أخرى .',
                'update_error' => 'حدثت مشكلة أثناء تحديث المستخدم، برجاء المحاولة مرة أخرى.',
                'already_confirmed' => 'تم تأكيد هذا المستخدم بالفعل.',
                'cant_confirm' => 'حدثت مشكلة في تأكيد حساب المستخدم.',
                'cant_deactivate_self' => 'لا يمكنك فعل هذا بنفسك.',
                'cant_delete_admin' => 'لا يمكنك حذف المشرف المتميز.',
                'cant_delete_self' => 'لا يمكنك مسح نفسك.',
                'cant_delete_own_session' => 'لا يمكنك حذف جلستك الخاصة.',
                'cant_restore' => 'لا يتم حذف هذا المستخدم لذلك لا يمكن استعادته.',
                'cant_unconfirm_admin' => 'لا يمكنك إلغاء تأكيد المشرف المميز.',
                'cant_unconfirm_self' => 'لا يمكنك إلغاء تأكيد نفسك.',
                'delete_first' => 'يجب حذف هذا المستخدم أولاً قبل أن يتم إتلافه نهائيًا.',
                'email_error' => 'هذا البريد الإلكتروني ينتمي إلا مستخدم آخر.',
                'mark_error' => 'حدثت مشكلة أثناء تحديث هذا المستخدم، برجاء المحاولة مرى أخرى.',
                'not_confirmed' => 'لم يتم تأكيد هذا المستخدم.',
                'not_found' => 'هذا المستخدم غير موجود.',
                'restore_error' => 'حدثت مشكلة أثناء إستعادة المستخدم، برجاء المحاولة مرة أخرى',
                'role_needed_create' => 'يجب عليك اختيار دور واحد.',
                'role_needed' => 'يجب عليك إختيار دور واحد على الأقل.',
                'social_delete_error' => 'حدثت مشكلة في إزالة الحساب الاجتماعي من المستخدم.',
                'update_password_error' => 'حدثت مشكلة أثناء تغيير كلمة مرور المستخدم، برجاء المحاولة مرة أخرى.',
            ],
        ],

        'blogs' => [
            // 'already_exists' => 'تلك المدونة موجودة بالفعل. يرجى اختيار اسم مختلف.',
            'create_error' => 'حدثت مشكلة أثناء إنشاء هذه المدونة. حاول مرة اخرى.',
            'delete_error' => 'حدثت مشكلة في حذف هذه المدونة. حاول مرة اخرى.',
            'update_error' => 'حدثت مشكلة أثناء تحديث هذه المدونة. حاول مرة اخرى.',
        ],

        'blog-category' => [
            'already_exists' => 'فئة المدونة هذه موجودة بالفعل. يرجى اختيار اسم مختلف.',
            'create_error' => 'حدثت مشكلة أثناء إنشاء فئة المدونة هذه. حاول مرة اخرى.',
            'delete_error' => 'حدثت مشكلة في حذف فئة المدونة هذه. حاول مرة اخرى.',
            'update_error' => 'حدثت مشكلة أثناء تحديث فئة المدونة هذه. حاول مرة اخرى.',
        ],

        'blog-tag' => [
            'already_exists' => 'علامة المدونة هذه موجودة بالفعل. يرجى اختيار اسم مختلف.',
            'create_error' => 'حدثت مشكلة أثناء إنشاء علامة المدونة هذه. حاول مرة اخرى.',
            'delete_error' => 'حدثت مشكلة في حذف علامة المدونة هذه. حاول مرة اخرى.',
            'update_error' => 'حدثت مشكلة أثناء تحديث علامة المدونة هذه. حاول مرة اخرى.',
        ],

        'pages' => [
            'already_exists' => 'هذه الصفحة موجودة بالفعل. يرجى اختيار اسم مختلف.',
            'create_error' => 'حدثت مشكلة في إنشاء هذه الصفحة. حاول مرة اخرى.',
            'delete_error' => 'حدثت مشكلة في حذف هذه الصفحة. حاول مرة اخرى.',
            'update_error' => 'حدثت مشكلة في تحديث هذه الصفحة. حاول مرة اخرى.',
        ],

        'faqs' => [
            // 'already_exists' => 'هذا السؤال موجود بالفعل. يرجى اختيار اسم مختلف.',
            'create_error' => 'حدثت مشكلة أثناء إنشاء هذا السؤال. حاول مرة اخرى.',
            'delete_error' => 'حدثت مشكلة في حذف هذا السؤال. حاول مرة اخرى.',
            'update_error' => 'حدثت مشكلة أثناء تحديث هذا السؤال. حاول مرة اخرى.',
        ],
        'email-templates' => [
            'already_exists' => 'قالب البريد الإلكتروني هذا موجود بالفعل. يرجى اختيار عنوان مختلف.',
            'create_error' => 'حدثت مشكلة في إنشاء قالب البريد الإلكتروني هذا. حاول مرة اخرى.',
            'delete_error' => 'حدثت مشكلة في حذف قالب البريد الإلكتروني هذا. حاول مرة اخرى.',
            'update_error' => 'حدثت مشكلة في تحديث قالب البريد الإلكتروني هذا. حاول مرة اخرى.',
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'حسابك مفعل بالفعل.',
                'confirm' => 'برجاء القيام بتفعيل حسابك!',
                'created_confirm' => 'لقد تم إنشاء حسابك بنجاح. لقد تم إرسال بريد التفعيل إلى بريدك الإلكتروني.',
                'created_pending' => 'تم إنشاء حسابك بنجاح وهو في انتظار الموافقة. سيتم إرسال بريد إلكتروني عند الموافقة على حسابك.',
                'mismatch' => 'كود التفعيل هذا غير متطابق!',
                'not_found' => 'كود التفعيل هذا غير موجود!',
                'pending' => 'حسابك في انتظار الموافقة حاليًا.',
                'resend' => 'حسابك غير مفعل. برجاء الضغط على رابط التفعيل الذي تم إرساله إلى بريدك الإلكتروني, أو <a href=":url">إضغط هنا</a> لإعادة إرسال رابط التفعيل مجددا.',
                'success' => 'تم تفعيل حسابك بنجاح!',
                'resent' => 'تم إرسال رابط التفعيل مجددا إلى عنوان بريدك الإلكتروني الموجود في حسابك.',
            ],

            'deactivated' => 'لقد تم تعطيل حسابك.',
            'email_taken' => 'هذا البريد الإلكتروني موجود مسبقا.',

            'password' => [
                'change_mismatch' => 'هذه ليست كلمة مرورك القديمة.',
                'reset_problem' => 'حدثت مشكلة في إعادة تعيين كلمة المرور الخاصة بك. يرجى إعادة إرسال البريد الإلكتروني لإعادة تعيين كلمة المرور.',
                'wrong_password' => 'حدثت مشكلة في إعادة تعيين كلمة المرور الخاصة بك. يرجى إعادة إرسال.',
            ],

            'registration_disabled' => 'التسجيل مغلق حاليا.',
        ],
    ],
];
