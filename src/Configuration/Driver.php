<?php
declare (strict_types = 1);

namespace Nusantara\Database\Configuration;

abstract class Driver
{
    abstract public function resolve(array $settings = []);

    public static function get($arrays, $key, $default = null)
	{
		if(array_key_exists($key, $arrays))
		{
			return $arrays[$key];
		}

		return $default;
	}

}
