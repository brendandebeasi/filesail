<?php
$config = [
    'dev'   => [
        'db' => [
            'host'  => 'localhost',
            'user'  => 'root',
            'pass'  => 'root',
        ],

        'host'      => 'http://dev.filesail.com:1337/',
        'base_url'  => '',
        'base_dir'  => getcwd(),
        'file_dir'  => 'files/',
        'temp_dir'  => 'files/tmp',
        'full_file_dir'    => getcwd() . '/files/',
    ],
    'stage' => [
        'db' => [
            'host'  => 'localhost',
            'user'  => 'root',
            'pass'  => 'GreatSuccess2012'
        ],

        'host'      => 'http://debea.si/',
        'base_dir'  => getcwd(),
        'base_url'  => 'fs/',
        'file_dir'    =>  'files/',
        'temp_dir'  => 'files/tmp',
        'full_file_dir'   => getcwd() . '/files/'

    ]
];

require('env.php');
$config = $config[$env];
ini_set('upload_tmp_dir',$config['temp_dir']);
ini_set('upload_max_filesize','4G');
ini_set('post_max_size','4G');
ini_set('max_execution_time','3600');
ini_set('max_input_time','3600');
$safeconfig = $config;
//BE SURE TO REMOVE UNSAFE VARS HERE
$safeconfig['db'] = null;