<?php

require_once './vendor/autoload.php';

use php_oop_board\Http\Request;

//$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['PATH_INFO'] = '/posts/write';

var_dump(Request::getPath());