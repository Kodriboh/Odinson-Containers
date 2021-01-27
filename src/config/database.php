<?php 

// TODO: add defaults loading from dotenv

return [

   /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Specify the default database driver to use. 
    |
    | All database function through Bjornstad is conducted via PDO. Be sure
    | to have the correct driver installed before beginning development. 
    */

    'default' => 'mysql',

   /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Feel free to configure your own if it is not listed.
    |
    | Since this is designed to be used with the Bjornstad Docker containers
    | all default connections are set up using our default container names. 
    */
    'connections' => [
        
        'mysql' => [
            'driver' => 'mysql',
            'host' => 'mysql',
            'port' => '3306',
            'username' => 'root',
            'password' => 'root'
        ],

        'postgres' => [
            'driver' => 'pgsql',
            'host' => 'postgres',
            'port' => '5432',
            'username' => 'root',
            'password' => 'root'
        ]
    ]
];