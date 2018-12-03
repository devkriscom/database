<?php
declare (strict_types = 1);

namespace Nusantara\Database;

use Nusantara\Standard\Kernel\Container;
use Nusantara\AbstractPackageExtension;

final class Package extends AbstractPackageExtension
{
	public static function name()
	{
		return 'database';
	}

	public static function configPath() : string
	{
		return __DIR__.'/../config/config.yml';
	}

	public function setup()
	{
		$this->observer(\Nusantara\Database\Observer\DatabaseObserver::class);
	}

	public function register(array $configs = [], Container $container)
	{
		$container->register(\Nusantara\Database\Database::class, \Nusantara\Standard\Database::class)
		->addArgument(\Nusantara\Standard\Kernel\Container::class)
		->addArgument($configs);
	}

	public function compile(array $configs = [], Container $container)
	{
		$database = $container->resolve(\Nusantara\Standard\Database::class);

		$database->makeManager();
	}

}