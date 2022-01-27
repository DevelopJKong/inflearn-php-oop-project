<?php

require_once './vendor/autoload.php';

use php_oop_board\Session\DatabaseSessionHandler;
use php_oop_board\Database\Adaptor;

Adaptor::setup('mysql:dbname=phpblog','root','123456');

session_set_save_handler(new DatabaseSessionHandler());

session_start();

$_SESSION['message'] = 'Hello, world';
$_SESSION['foo'] = new stdClass();