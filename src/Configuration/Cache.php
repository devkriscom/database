<?php
declare (strict_types = 1);

namespace Nusantara\Database\Configuration;

use Nusantara\Database\Configuration\Cache\Apc;
use Nusantara\Database\Configuration\Cache\File;
use Nusantara\Database\Configuration\Cache\Memcached;
use Nusantara\Database\Configuration\Cache\Redis;

class Cache extends Manager
{
	public function __construct()
	{
		$this->add('apc', new Apc());
		$this->add('file', new File());
		$this->add('memcached', new Memcached());
		$this->add('redis', new Redis());
	}
}
