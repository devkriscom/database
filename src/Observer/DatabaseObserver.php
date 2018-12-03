<?php
declare (strict_types = 1);

namespace Nusantara\Database\Observer;

use Nusantara\AbstractObserverExtension;

class DatabaseObserver extends AbstractObserverExtension
{
	public static function name()
	{
		return 'database';
	}

	public function supports(array $parameters = [], array $options = []) {
		return true;
	}

	public function resolve(array $parameters = [], array $options = [])
	{
		$parameters =  array_replace_recursive([
			'schema' => [],
			'repository' => []
		], $parameters);

		$container = $this->getContainer();
		if($container->has(\Nusantara\Standard\Database::class))
		{
			$database = $container->resolve(\Nusantara\Standard\Database::class);
			
			foreach ($parameters['schema'] as $format => $path) {
				if(array_key_exists($format, 
					array_flip(['xml', 'yml', 'php', 'annotation'])
				) && is_string($path)) {
					$database->addSchema($format, $path);
				}
			}

			foreach ($parameters['repository'] as $entity => $repository) {
				if(class_exists($entity) && class_exists($repository)) {
					$database->addRepository($entity, $repository);
				}
			}
		}

	}
}