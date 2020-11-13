<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'     => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'team'                     => 'Team',
            'team_helper'              => ' ',
        ],
    ],
    'carManagement'  => [
        'title'          => 'Car Management',
        'title_singular' => 'Car Management',
    ],
    'manufacturer'   => [
        'title'          => 'Manufacturers',
        'title_singular' => 'Manufacturer',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'image'              => 'Image',
            'image_helper'       => ' ',
            'country'            => 'Country',
            'country_helper'     => ' ',
            'logo'               => 'Logo',
            'logo_helper'        => ' ',
            'first_year'         => 'First Year',
            'first_year_helper'  => ' ',
            'last_year'          => 'Last Year',
            'last_year_helper'   => ' ',
            'creator'            => 'Creator',
            'creator_helper'     => ' ',
            'team'               => 'Team',
            'team_helper'        => ' ',
        ],
    ],
    'engine'         => [
        'title'          => 'Engines',
        'title_singular' => 'Engine',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'Name',
            'name_helper'         => ' ',
            'description'         => 'Description',
            'description_helper'  => 'Put something here',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'manufacturer'        => 'Manufacturer',
            'manufacturer_helper' => ' ',
            'bore'                => 'Bore',
            'bore_helper'         => ' ',
            'stroke'              => 'Stroke',
            'stroke_helper'       => ' ',
            'files'               => 'Files',
            'files_helper'        => ' ',
            'images'              => 'Images',
            'images_helper'       => ' ',
            'creator'             => 'Creator',
            'creator_helper'      => ' ',
            'team'                => 'Team',
            'team_helper'         => ' ',
        ],
    ],
    'car'            => [
        'title'          => 'Cars',
        'title_singular' => 'Car',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'Name',
            'name_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'image'               => 'Image',
            'image_helper'        => ' ',
            'manufacturer'        => 'Manufacturer',
            'manufacturer_helper' => ' ',
            'engine'              => 'Engine',
            'engine_helper'       => ' ',
            'carmodel'            => 'Carmodel',
            'carmodel_helper'     => ' ',
            'creator'             => 'Creator',
            'creator_helper'      => ' ',
            'team'                => 'Team',
            'team_helper'         => ' ',
        ],
    ],
    'team'           => [
        'title'          => 'Teams',
        'title_singular' => 'Team',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'owner'             => 'Owner',
            'owner_helper'      => ' ',
        ],
    ],
    'userAlert'      => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'carUser'        => [
        'title'          => 'My Garage',
        'title_singular' => 'My Garage',
    ],
    'garage'         => [
        'title'          => 'My Cars',
        'title_singular' => 'My Car',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'files'             => 'Files',
            'files_helper'      => ' ',
            'images'            => 'Images',
            'images_helper'     => ' ',
            'car'               => 'Car',
            'car_helper'        => ' ',
            'team'              => 'Team',
            'team_helper'       => ' ',
        ],
    ],
    'carmodel'       => [
        'title'          => 'Carmodels',
        'title_singular' => 'Carmodel',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'manufacturer'        => 'Manufacturer',
            'manufacturer_helper' => ' ',
            'car'                 => 'Car',
            'car_helper'          => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'name'                => 'Name',
            'name_helper'         => ' ',
            'first_year'          => 'First Year',
            'first_year_helper'   => ' ',
            'last_year'           => 'Last Year',
            'last_year_helper'    => ' ',
            'team'                => 'Team',
            'team_helper'         => ' ',
        ],
    ],
];
