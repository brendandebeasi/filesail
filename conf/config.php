<?php
$config = [
    'dev'   => [
        'db' => [
            'host'  => 'localhost',
            'name'  => 'filesail',
            'user'  => 'root',
            'pass'  => 'root',
        ],

        'host'      => 'http://dev.filesail.com:1337/',
        'base_url'  => '',
        'temp_dir'  => 'files/tmp',
        'base_dir'  => getcwd(),
        'file_host' => 'http://dev.filesail.com:1337/',
        'file_dir'  => 'files/',
        'full_file_dir'    => getcwd() . '/files/',
    ],
    'stage' => [
        'db' => [
            'host'  => 'localhost',
            'name'  => 'filesail',
            'user'  => 'root',
            'pass'  => 'GreatSuccess2012'
        ],

        'host'      => 'http://stage.filesail.com/',
        'base_dir'  => getcwd(),
        'base_url'  => '',
        'temp_dir'  => 'files/tmp',
        'file_host'      => 'http://stage.fsail.co/',
        'file_dir'    =>  'files/',
        'full_file_dir'   => getcwd() . '/files/'

    ],
    'prod' => [
        'db' => [
            'host'  => 'localhost',
            'name'  => 'filesail',
            'user'  => 'root',
            'pass'  => 'GreatSuccess2012'
        ],

        'host'      => 'http://filesail.com/',
        'base_dir'  => getcwd(),
        'base_url'  => '',
        'temp_dir'  => 'files/tmp',
        'file_host'      => 'http://fsail.co/',
        'file_dir'    =>  'files/',
        'full_file_dir'   => getcwd() . '/files/'

    ]
];

require_once('env.php');
set_include_path(getcwd());
$config = $config[$env];
$safeconfig = $config;
session_start();
//BE SURE TO REMOVE UNSAFE VARS HERE
$safeconfig['db'] = null;

if(!isset($in_head)) require_once('dal.php');
elseif($in_head == false)  require_once('../dal.php');
$fs_db = new DAL();
