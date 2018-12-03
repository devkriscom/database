<?php
declare (strict_types = 1);

namespace Nusantara\Database\Configuration;

use Nusantara\Database\Configuration\Connection\Mysql;
use Nusantara\Database\Configuration\Connection\Oracle;
use Nusantara\Database\Configuration\Connection\Pqsql;
use Nusantara\Database\Configuration\Connection\Sqlite;

class Connection extends Manager
{
	public function __construct()
	{
		$this->add('mysql', new Mysql());
		$this->add('oracle', new Oracle());
		$this->add('sqlite', new Sqlite());
		$this->add('pqsql', new Pqsql());
	}
}
