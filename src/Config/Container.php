<?php

namespace App\Config;


use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private $bindings = [];

    public function set($id, callable $resolver)
    {
        $this->bindings[$id] = $resolver;
    }

    public function get($id)
    {
        if (!$this->has($id)) {
            throw new \Exception("Dependency with ID '$id' not found.");
        }

        $resolver = $this->bindings[$id];
        return $resolver($this);
    }

    public function has($id)
    {
        return isset($this->bindings[$id]);
    }
}