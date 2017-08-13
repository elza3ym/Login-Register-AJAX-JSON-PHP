<?php
session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => 'root1234',
        'db' => 'login-register'
    )
);

spl_autoload_register(function ($class) {
    require_once __DIR__.'/../classes/'.$class.'.php';
});
