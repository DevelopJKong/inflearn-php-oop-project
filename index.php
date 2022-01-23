<?php

require_once './vendor/autoload.php';

use php_oop_board\Database\Adaptor;

Adaptor::setup('mysql:dbname=phpblog','root','123456');

class Post
{

}

$posts= Adaptor::getAll('SELECT* FROM posts LIMIT 3',[],Post::class);
var_dump($posts);
