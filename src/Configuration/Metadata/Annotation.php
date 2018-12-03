<?php

declare (strict_types = 1);

namespace Nusantara\Database\Configuration\Metadata;

use Doctrine\ORM\Configuration;

class Annotation extends BaseMetadata
{
    /**
     * @param array $settings
     *
     * @return \Doctrine\Common\Persistence\Mapping\Driver\MappingDriver
     */
    public function resolve(array $settings = [])
    {
        return (new Configuration())->newDefaultAnnotationDriver(
            self::get($settings, 'schemas', []),
            self::get($settings, 'simple', false)
        );
    }
}
