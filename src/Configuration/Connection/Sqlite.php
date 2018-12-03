<?php
declare (strict_types = 1);

namespace Nusantara\Database\Configuration\Connection;

use Nusantara\Database\Configuration\Driver;

class Sqlite extends Driver
{

    public function resolve(array $settings = [])
    {
        return [
            'driver'              => 'pdo_sqlite',
            'user'                => self::get($settings, 'username'),
            'password'            => self::get($settings, 'password'),
            'prefix'              => self::get($settings, 'prefix'),
            'memory'              => $this->isMemory($settings),
            'path'                => self::get($settings, 'database'),
            'defaultTableOptions' => self::get($settings, 'defaultTableOptions', []),
        ];
    }

    protected function isMemory(array $settings = [])
    {
        return ':memory';
    }
}
