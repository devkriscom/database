<?php
declare (strict_types = 1);

namespace Nusantara\Database\Configuration\Cache;


class Apc extends BaseCache
{
    /**
     * @var string
     */
    protected $store = 'apc';
}
