<?php
declare (strict_types = 1);

namespace Nusantara\Database\Configuration\Cache;


class Redis extends BaseCache
{
    /**
     * @var string
     */
    protected $store = 'redis';
}
