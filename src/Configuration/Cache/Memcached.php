<?php
declare (strict_types = 1);

namespace Nusantara\Database\Configuration\Cache;


class Memcached extends BaseCache
{
    /**
     * @var string
     */
    protected $store = 'memcached';
}
