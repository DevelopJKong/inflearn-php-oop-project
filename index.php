<?php

require_once './vendor/autoload.php';
//route 같은 경우에는 url 매핑 같은것이라고 생각하면 된다

use php_oop_board\Routing\Route;
use php_oop_board\Routing\Middleware;
use php_oop_board\Database\Adaptor;

Adaptor::setup('mysql:dbname=phpblog','root','123456');

class HelloMiddlewares extends Middleware
{
    public static function process()
    {
        return false;
    }
}



Route::add('get','/',function () {
    echo 'Hello, world';
},[HelloMiddlewares::class]);

Route::add('get','/posts/{id}',function ($id) {
    if($post = Adaptor::getAll('SELECT * FROM posts WHERE `id` =?',[$id])){
        return var_dump($post);
    }
    http_response_code(404);
});

Route::run();



