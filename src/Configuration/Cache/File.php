<?php
declare (strict_types = 1);

namespace Nusantara\Database\Configuration\Cache;

use Doctrine\Common\Cache\FilesystemCache;

class File extends BaseCache
{

    /**
     * @param array $settings
     *
     * @return FilesystemCache
     */
    public function resolve(array $settings = [])
    {
        return new FilesystemCache(
            self::get($settings, 'path', __DIR__.'/../../../resources/cache')
        );
    }
}
