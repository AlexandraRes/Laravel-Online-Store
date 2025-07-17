<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Table Columns
    |--------------------------------------------------------------------------
    */

    'column.name' => 'Nume',
    'column.guard_name' => 'Contextul de acces',
    'column.team' => 'Echipă',
    'column.roles' => 'Roluri',
    'column.permissions' => 'Permisiuni',
    'column.updated_at' => 'Actualizat la',

    /*
    |--------------------------------------------------------------------------
    | Form Fields
    |--------------------------------------------------------------------------
    */

    'field.name' => 'Nume',
    'field.guard_name' => 'Contextul de acces',
    'field.permissions' => 'Permisiuni',
    'field.team' => 'Echipă',
    'field.team.placeholder' => 'Selectează o echipă ...',
    'field.select_all.name' => 'Selectează tot',
    'field.select_all.message' => 'Activează/dezactivează toate permisiunile pentru acest rol',

    /*
    |--------------------------------------------------------------------------
    | Navigation & Resource
    |--------------------------------------------------------------------------
    */

    'nav.group' => 'Drepturi de acces',
    'nav.role.label' => 'Roluri',
    'nav.role.icon' => 'heroicon-o-shield-check',
    'resource.label.role' => 'rol',
    'resource.label.roles' => 'Roluri',

    /*
    |--------------------------------------------------------------------------
    | Section & Tabs
    |--------------------------------------------------------------------------
    */

    'section' => 'Entități',
    'resources' => 'Resurse',
    'widgets' => 'Widgeturi',
    'pages' => 'Pagini',
    'custom' => 'Permisiuni personalizate',

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */

    'forbidden' => 'Nu ai permisiunea de a accesa',

    /*
    |--------------------------------------------------------------------------
    | Resource Permissions' Labels
    |--------------------------------------------------------------------------
    */

    'resource_permission_prefixes_labels' => [
        'view' => 'Vizualizează',
        'view_any' => 'Vizualizează toate',
        'create' => 'Creează',
        'update' => 'Actualizează',
        'update_self' => 'Actualizează propriul profil',
        'delete' => 'Șterge',
        'delete_any' => 'Șterge toate',
        'force_delete' => 'Ștergere permanentă',
        'force_delete_any' => 'Ștergere permanentă a tuturor',
        'restore' => 'Restaurează',
        'reorder' => 'Reordonează',
        'restore_any' => 'Restaurează toate',
        'replicate' => 'Copiază',
    ],
];
