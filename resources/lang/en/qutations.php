<?php

return [
    'singular' => 'Quatation',
    'plural' => 'Quatations',
    'empty' => 'There are no quatations yet.',
    'count' => 'Quatations Count.',
    'search' => 'Search',
    'select' => 'Select Quatation',
    'permission' => 'Manage quatations',
    'trashed' => 'quatations Trashed',
    'perPage' => 'Results Per Page',
    'filter' => 'Search for quatation',
    'actions' => [
        'list' => 'List All',
        'create' => 'Create a new quatation',
        'show' => 'Show quatation',
        'edit' => 'Edit quatation',
        'delete' => 'Delete quatation',
        'options' => 'Options',
        'save' => 'Save',
        'filter' => 'Filter',
    ],
    'messages' => [
        'created' => 'The quatation has been created successfully.',
        'updated' => 'The quatation has been updated successfully.',
        'deleted' => 'The quatation has been deleted successfully.',
        'restored' => 'The quatation has been restored successfully.',
    ],
    'attributes' => [
        'name' => 'Quatation name',
        'customer-name' => 'Customer name',
        'product_count' => 'count',
        'owner' => 'Owner',
        'discount' => 'Discount',
        'created_at' => 'Created At',
        'deleted_at' => 'Deleted At',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the quatation?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
        'restore' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to restore the quatation?',
            'confirm' => 'Restore',
            'cancel' => 'Cancel',
        ],
        'forceDelete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to force delete the quatation?',
            'confirm' => 'Force',
            'cancel' => 'Cancel',
        ],
    ],
];
