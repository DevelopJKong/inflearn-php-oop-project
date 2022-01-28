<?php

namespace php_oop_board;

use php_oop_board\Support\ServiceProvider;

class Application
{
    private $providers = [];

    public function __construct($providers = [])
    {
        $this->providers = $providers;
        array_walk($this->provider,fn($provider) => $provider::register());
    }

    public function boot()
    {
        array_walk($this->providers,fn($provider) => $provider::boot());
    }
}