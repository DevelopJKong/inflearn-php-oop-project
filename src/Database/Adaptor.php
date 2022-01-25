<?php

namespace php_oop_board\Database;

class Adaptor
{
    private static $pdo;

    private static $sth;

    public static function setup($dsn,$username,$password)
    {
        self::$pdo = new \PDO($dsn,$username,$password); //일단 여기서 \ 를 정확하게 모르겠다
    }

    public static function exec($query, $params = [])
    {
        if(self::$sth = self::$pdo->prepare($query)) {
            return self::$sth->execute($params);
        }
    }

    public static function getAll($query, $params = [], $classname = 'stdClass')
    {
        if(self::exec($query,$params)) {
            return self::$sth->fetchAll(\PDO::FETCH_CLASS,$classname);
        }
    }
}