<?php

return [
    'singular' => 'القسم',
    'plural' => 'الاقسام',
    'empty' => 'لا يوجد اقسام حتى الان',
    'count' => 'عدد الاقسام',
    'search' => 'بحث',
    'select' => 'اختر القسم',
    'permission' => 'ادارة الاقسام',
    'trashed' => 'الاقسام المحذوفين',
    'perPage' => 'عدد النتائج بالصفحة',
    'filter' => 'ابحث عن قسم',
    'actions' => [
        'list' => 'عرض الكل',
        'create' => 'اضافة قسم',
        'show' => 'عرض القسم',
        'edit' => 'تعديل القسم',
        'delete' => 'حذف القسم',
        'options' => 'خيارات',
        'save' => 'حفظ',
        'filter' => 'بحث',
    ],
    'messages' => [
        'created' => 'تم اضافة القسم بنجاح.',
        'updated' => 'تم تعديل القسم بنجاح.',
        'deleted' => 'تم حذف القسم بنجاح.',
        'restored' => 'تم استعادة القسم بنجاح.',
    ],
    'attributes' => [
        'name' => 'اسم القسم',
        'currency' => 'العمله',
        '%name%' => 'اسم القسم',
        'created_at' => 'اضافة في',
        'deleted_at' => 'حذف في',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'تحذير !',
            'info' => 'هل انت متأكد انك تريد حذف القسم',
            'confirm' => 'حذف',
            'cancel' => 'الغاء',
        ],
        'restore' => [
            'title' => 'تحذير !',
            'info' => 'هل انت متأكد انك تريد استعادة هذا القسم',
            'confirm' => 'استعادة',
            'cancel' => 'الغاء',
        ],
        'forceDelete' => [
            'title' => 'تحذير !',
            'info' => 'هل أنت متأكد انك تريد حذف هذا القسم نهائياً?',
            'confirm' => 'حذف نهائي',
            'cancel' => 'الغاء',
        ],
    ],
];
