<?php
declare (strict_types = 1);

namespace Nusantara\Database\Configuration\Connection;

use Nusantara\Database\Configuration\Driver;

class Mysql extends Driver
{

    public function resolve(array $settings = [])
    {
        return [
            'driver'                => 'pdo_mysql',
            'host'                  => self::get($settings, 'host'),
            'dbname'                => self::get($settings, 'database'),
            'user'                  => self::get($settings, 'username'),
            'password'              => self::get($settings, 'password'),
            'charset'               => self::get($settings, 'charset'),
            'port'                  => self::get($settings, 'port'),
            'unix_socket'           => self::get($settings, 'unix_socket'),
            'prefix'                => self::get($settings, 'prefix'),
            'defaultTableOptions'   => self::get($settings, 'defaultTableOptions', []),
            'driverOptions'         => self::get($settings, 'driverOptions', []),
            'serverVersion'         => self::get($settings, 'serverVersion'),
        ];
    }
}
