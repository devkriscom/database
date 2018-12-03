<?php
declare (strict_types = 1);

namespace Nusantara\Database;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Setup;
use Nusantara\Standard\Kernel\Container;
use Nusantara\Database\Configuration\Connection;
use Nusantara\Database\Configuration\Metadata;
use Nusantara\Database\Configuration\Cache;
use Nusantara\Database\Services\EntityService;
use Nusantara\Standard\Database as DatabaseInterface;
use Nusantara\Traits\ContainerAwareTrait;

class Database implements DatabaseInterface {

	use ContainerAwareTrait;
	
	protected $isDebug = false;
	
	protected $metadata;

	protected $metadatas = [];

	protected $connection;

	protected $repository;

	protected $cache;

	protected $caches = array();

	protected $connections = array();

	protected $schemes = array();

	protected $repositories = array();

	protected $manager;

	protected $container;

	public function __construct(Container $container,  array $configs = [])
	{
		$this->container = $container;
		$this->makeConfig($configs);
	}

	public function makeConfig(array $configs = [])
	{
		$configs = array_replace_recursive([
		
		], $configs);

		if(isset($configs['connection']))
		{
			$this->setConnection($configs['connection']);
		}

		if(isset($configs['connections']))
		{
			foreach ($configs['connections'] as $name => $connection) {
				$this->addConnection($name, $connection);
			}
		}

		if(isset($configs['metadata']))
		{
			$this->setMetadata($configs['metadata']);
		}

		if(isset($configs['metadatas']))
		{
			foreach ($configs['metadatas'] as $name => $metadata) {
				$this->addMetadata($name, $metadata);
			}
		}
		
		if(isset($configs['cache']))
		{
			$this->setCache($configs['cache']);
		}

		if(isset($configs['caches']))
		{
			foreach ($configs['caches'] as $name => $cache) {
				$this->addCache($name, $cache);
			}
		}

		if(isset($configs['debug']))
		{
			$this->setDebug($configs['debug']);
		}

	}

	public function setDebug($debug = false)
	{
		$this->isDebug = $debug;
		return $this;
	}

	public function setConnection(string $connection)
	{
		$this->connection = $connection;
		return $this;
	}

	public function addConnection(string $name, $configs)
	{
		$this->connections[$name] = $configs;
		return $this;
	}

	public function setMetadata(string $metadata)
	{
		$this->metadata = $metadata;
		return $this;
	}

	public function addMetadata(string $name, $metadata)
	{
		$this->metadatas[$name] = $metadata;
		return $this;
	}

	public function setCache(string $cache)
	{
		$this->cache = $cache;
		return $this;
	}

	public function addCache(string $name, $cache)
	{
		$this->caches[$name] = $cache;
		return $this;
	}


	public function addSchema(string $metadata, $schema)
	{
		$key = array_search($metadata, array_keys($this->metadatas));

		if(is_int($key) && isset($this->metadatas[$key]['schemes']))
		{
			$this->metadatas[$key]['schemes'][] = $schema;
		}

		return $this;
	}

	public function metadataParamter()
	{
		if(array_key_exists($this->metadata, $this->metadatas))
		{
			return (new Metadata())->load($this->metadata)->resolve($this->metadatas[$this->metadata]);
		}	
	}

	public function connectionParamter()
	{
		if(array_key_exists($this->connection, $this->connections))
		{
			return (new Connection())->load($this->connection)->resolve($this->connections[$this->connection]);
		}	
	}

	public function cacheParameter()
	{
		if(array_key_exists($this->cache, $this->caches))
		{
			return (new Cache())->load($this->cache)->resolve($this->caches[$this->cache]);
		}	

	}

	public function addRepository(string $entityClass, $repository)
	{
		$this->repositories[$entityClass] = $repository;
		$this->registerInstance($repository);
		return $this;
	}

	public function getRepository(string $entityClass)
	{
		if(array_key_exists($entityClass, $this->repositories))
		{
			return $this->getInstance($this->repositories[$entityClass]);
		}
		return $this->getManager()->getRepository($entityClass);
	}

	public function makeManager() 
	{
		$config = Setup::createXMLMetadataConfiguration(
			[], $this->isDebug
		);

		$config->setMetadataDriverImpl($this->metadataParamter());

		$config->setMetadataCacheImpl($this->cacheParameter());

		$manager = EntityManager::create($this->connectionParamter(), $config);

		$this->manager = $manager;


	}

	public function getManager()
	{
		return $this->manager;
	}

	public function makeEntity(string $entityClass) : EntityService
	{
		return new EntityService($entityClass, $this->manager);
	}

	public function __debugInfo() {
		return [
			'connection' => $this->connection,
			'metadata' => $this->metadata,
			'cache' => $this->cache,
			'repository' => $this->repository,
			'connections' => $this->connections,
			'metadatas' => $this->metadatas,
			'repositories' => $this->repositories,
			'manager' => $this->manager
		];
	}
	
}