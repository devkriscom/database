<?php

declare (strict_types = 1);

namespace Nusantara\Database\Configuration\Metadata;

use Doctrine\ORM\Mapping\Driver\XmlDriver;

class Xml extends BaseMetadata
{
    public function resolve(array $settings = [])
    {
        return new XmlDriver(
            self::get($settings, 'schemes', []),
            self::get($settings, 'extension', XmlDriver::DEFAULT_FILE_EXTENSION)
        );
    }
}
