<?php

return [
    'userManagement' => [
        'title'          => 'Benutzerverwaltung',
        'title_singular' => 'Benutzerverwaltung',
    ],
    'permission'     => [
        'title'          => 'Zugriffsrechte',
        'title_singular' => 'Berechtigung',
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
        'title'          => 'Rollen',
        'title_singular' => 'Rolle',
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
        'title'          => 'Benutzer',
        'title_singular' => 'Benutzer',
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
            'garage'                   => 'Garage',
            'garage_helper'            => ' ',
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
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'Name',
            'name_helper'         => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'image'               => 'Image',
            'image_helper'        => ' ',
            'country'             => 'Country',
            'country_helper'      => ' ',
            'logo'                => 'Logo',
            'logo_helper'         => ' ',
            'first_year'          => 'First Year',
            'first_year_helper'   => ' ',
            'last_year'           => 'Last Year',
            'last_year_helper'    => ' ',
            'creator'             => 'Creator',
            'creator_helper'      => ' ',
            'team'                => 'Team',
            'team_helper'         => ' ',
            'country_code'        => 'Country Code',
            'country_code_helper' => ' ',
            'owner'               => 'Owner',
            'owner_helper'        => ' ',
        ],
    ],
    'engine'         => [
        'title'          => 'Engines',
        'title_singular' => 'Engine',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'description'              => 'Description',
            'description_helper'       => 'Put something here',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'manufacturer'             => 'Manufacturer',
            'manufacturer_helper'      => ' ',
            'bore'                     => 'Bore',
            'bore_helper'              => 'Cylinder bore diameter in inches or millimeters',
            'stroke'                   => 'Stroke',
            'stroke_helper'            => 'Piston stroke in inches or millimeters',
            'files'                    => 'Files',
            'files_helper'             => ' ',
            'images'                   => 'Images',
            'images_helper'            => ' ',
            'creator'                  => 'Creator',
            'creator_helper'           => ' ',
            'team'                     => 'Team',
            'team_helper'              => ' ',
            'owner'                    => 'Owner',
            'owner_helper'             => ' ',
            'cylinder_number'          => 'Cylinder Number',
            'cylinder_number_helper'   => 'How many pistons does it have?',
            'block_config'             => 'Block Config',
            'block_config_helper'      => 'Is it a V or an inline or maybe a boxer',
            'power_units'              => 'Power Units',
            'power_units_helper'       => 'Select HP, PS or KW',
            'engine_power'             => 'Engine Power',
            'engine_power_helper'      => 'Amount of power in HP or PS or KW',
            'engine_size'              => 'Engine Size',
            'engine_size_helper'       => 'Size in cubic inches (CID) or centimeters (CC)',
            'engine_size_units'        => 'Engine Size Units',
            'engine_size_units_helper' => 'CID or CC',
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
            'image_helper'        => 'Image(s) of this model',
            'manufacturer'        => 'Manufacturer',
            'manufacturer_helper' => ' ',
            'engine'              => 'Engine',
            'engine_helper'       => 'Each car gets one engine so for multiple engine sizes just make more cars',
            'carmodel'            => 'Carmodel',
            'carmodel_helper'     => ' ',
            'creator'             => 'Creator',
            'creator_helper'      => ' ',
            'team'                => 'Team',
            'team_helper'         => ' ',
            'owner'               => 'Owner',
            'owner_helper'        => ' ',
            'file'                => 'Files',
            'file_helper'         => 'Any files related to this model',
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
