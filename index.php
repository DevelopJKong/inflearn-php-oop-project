<?php

require_once './vendor/autoload.php';

// 데이터베이스 연결
// 세션을 켜는 일
// 에러 핸들러 등록하기
// 환경 설정하기 ...
// 이런 부분들을 ServiceProvider에 모두 담을 예정이다

use php_oop_board\Support\ServiceProvider;
use php_oop_board\Application;

class SessionServiceProvider extends ServiceProvider
{
    public function register()
    {
        //session_set_save_handler
    }

    public function boot()
    {
        //session_start();
    }
}

$app = new Applicattion ([
    SessionServiceProvider::class
]);
$app->boot();