<?php
declare (strict_types = 1);

namespace Nusantara\Database\Configuration\Connection;

use Nusantara\Database\Configuration\Driver;
class Pqsql extends Driver
{
    /**
     * @param array $settings
     *
     * @return array
     */
    public function resolve(array $settings = [])
    {
        return [
            'driver'              => 'pdo_pgsql',
            'host'                => self::get($settings, 'host'),
            'dbname'              => self::get($settings, 'database'),
            'user'                => self::get($settings, 'username'),
            'password'            => self::get($settings, 'password'),
            'charset'             => self::get($settings, 'charset'),
            'port'                => self::get($settings, 'port'),
            'sslmode'             => self::get($settings, 'sslmode'),
            'prefix'              => self::get($settings, 'prefix'),
            'defaultTableOptions' => self::get($settings, 'defaultTableOptions', []),
            'serverVersion'       => self::get($settings, 'serverVersion'),
        ];
    }
}
