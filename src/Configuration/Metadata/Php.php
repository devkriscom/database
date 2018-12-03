<?php

declare (strict_types = 1);

namespace Nusantara\Database\Configuration\Metadata;

use Doctrine\Common\Persistence\Mapping\Driver\PHPDriver;

class Php extends BaseMetadata
{
    /**
     * @param array $settings
     *
     * @return \Doctrine\Common\Persistence\Mapping\Driver\MappingDriver
     */
    public function resolve(array $settings = [])
    {
        return new PHPDriver(
            self::get($settings, 'schemas', [])
        );
    }
}
