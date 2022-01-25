<?php

namespace php_oop_board\Routing;

class RequestContext
{
    public $method;
    public $path;
    public $handler;
    public $middlewares;

    public function __construct($method, $path, $handler, $middlewares = [])
    {
        $this->method = $method;
        $this->path = $path;
        $this->handler = $handler;
        $this->middlewares = $middlewares;
    }
    //match 같은 경우에는 핵심로직이라고는 부르기 어렵다
    public function match($url)
    {
        //$this->path => /posts, $url => /posts
        //$this->path => /posts/{id}, $url => /posts/1

        $urlParts = explode('/', $url);
        $urlPatternParts = explode('/', $this->path);
        if (count($urlParts) === count($urlPatternParts)) {
            $urlParams = [];
            foreach ($urlPatternParts as $key => $part) {
                if (preg_match('/^\{.*\}$/', $part)) { //php 정규표현식도 공부를 제대로 해야겠다
                    $urlParams[$key] = $part; // <= 이쪽에 있는 $key가 핵심이다
                } else {
                    if ($urlParts[$key] !== $part) {
                        return null;
                    }
                }
            }
            return count($urlParams) < 1 ? [] : array_map(fn($k) => $urlParts[$k], array_keys($urlParams));
        }

    }

    public function runMiddlewares()
    {
        foreach ($this->middlewares as $middleware) {
            if (! $middleware::process()) {
                return false;
            }
        }
        return true;
    }
}