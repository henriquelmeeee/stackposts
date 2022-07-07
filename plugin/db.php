<?php

use Medoo\Medoo;

function db()
{
    return new Medoo([
        'type' => 'mysql',
        'host' => MYSQL_HOST,
        'database' => MYSQL_DATABASE,
        'username' => MYSQL_USERNAME,
        'password' => MYSQL_PASSWORD,
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_general_ci',
        'port' => MYSQL_PORT
    ]);
}
