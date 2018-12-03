<?php
declare (strict_types = 1);

namespace Nusantara\Database\Configuration\Connection;

use Nusantara\Database\Configuration\Driver;
class Oracle extends Driver
{
    /**
     * @param array $settings
     *
     * @return array
     */
    public function resolve(array $settings = [])
    {
        return [
            'driver'                => 'oci8',
            'host'                  => self::get($settings, 'host'),
            'dbname'                => self::get($settings, 'database'),
            'servicename'           => self::get($settings, 'service_name'),
            'service'               => self::get($settings, 'service'),
            'user'                  => self::get($settings, 'username'),
            'password'              => self::get($settings, 'password'),
            'charset'               => self::get($settings, 'charset'),
            'port'                  => self::get($settings, 'port'),
            'prefix'                => self::get($settings, 'prefix'),
            'defaultTableOptions'   => self::get($settings, 'defaultTableOptions', []),
            'persistent'            => self::get($settings, 'persistent'),
        ];
    }
}
