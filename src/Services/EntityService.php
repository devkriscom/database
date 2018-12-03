<?php
declare (strict_types = 1);

namespace Nusantara\Database\Services;

class EntityService
{
    protected $entity;

    protected $manager;

    public function __construct(string $entityName, $manager)
    {
        $this->entity = new $entityName();
        $this->manager = $manager;
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array(array($this->entity, $method), $arguments);
    }


    public function persist()
    {
        $this->manager->persist($this->entity);
    }

    public function flush() {
        $this->manager->flush();
    }
}