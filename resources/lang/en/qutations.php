<?php

return [
    'singular' => 'Qutation',
    'plural' => 'Qutations',
    'empty' => 'There are no qutations yet.',
    'count' => 'Qutations Count.',
    'search' => 'Search',
    'select' => 'Select Qutation',
    'permission' => 'Manage qutations',
    'trashed' => 'qutations Trashed',
    'perPage' => 'Results Per Page',
    'filter' => 'Search for qutation',
    'actions' => [
        'list' => 'List All',
        'create' => 'Create a new qutation',
        'show' => 'Show qutation',
        'edit' => 'Edit qutation',
        'delete' => 'Delete qutation',
        'options' => 'Options',
        'save' => 'Save',
        'filter' => 'Filter',
    ],
    'messages' => [
        'created' => 'The qutation has been created successfully.',
        'updated' => 'The qutation has been updated successfully.',
        'deleted' => 'The qutation has been deleted successfully.',
        'restored' => 'The qutation has been restored successfully.',
    ],
    'attributes' => [
        'name' => 'Qutation name',
        'customer-name' => 'Customer name',
        'product_count' => 'count',
        'owner' => 'Owner',
        'created_at' => 'Created At',
        'deleted_at' => 'Deleted At',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the qutation?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
        'restore' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to restore the qutation?',
            'confirm' => 'Restore',
            'cancel' => 'Cancel',
        ],
        'forceDelete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to force delete the qutation?',
            'confirm' => 'Force',
            'cancel' => 'Cancel',
        ],
    ],
];
