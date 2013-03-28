<?php
$config = [
    'dev'   => [
        'db' => [
            'host'  => 'localhost',
            'user'  => 'root',
            'pass'  => 'root',
        ],

        'host'      => 'http://dev.filesail.com:1337/',
        'base_dir'  => '/Users/brendan.debeasi/git/filesail',
        'base_url'  => '/',
        'base_dir'  => getcwd(),
        'file_dir'    => getcwd() . '/files/',
    ],
    'stage' => [
        'db' => [
            'host'  => 'localhost',
            'user'  => 'root',
            'pass'  => 'GreatSuccess2012'
        ],

        'host'      => 'http://dev.filesail.com:1337/',
        'base_dir'  => getcwd(),
        'base_url'  => '/fs/',
        'file_dir'    => getcwd() . '/files/'

    ]
];

require('env.php');
$config = $config[$env];