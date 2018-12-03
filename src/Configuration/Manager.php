<?php

declare (strict_types = 1);

namespace Nusantara\Database\Configuration;

abstract class Manager
{
    protected $drivers = [];

    public function add(string $name, $instance)
    {
        $this->drivers[$name] = $instance;
    }

    public function load(string $name)
    {
        if(array_key_exists($name, $this->drivers))
        {
            return $this->drivers[$name];
        }
        throw new \Exception(sprintf("%s connection configuration doesn't exist"));
    }

}
