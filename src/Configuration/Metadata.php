<?php
declare (strict_types = 1);

namespace Nusantara\Database\Configuration;

use Nusantara\Database\Configuration\Metadata\Annotation;
use Nusantara\Database\Configuration\Metadata\Php;
use Nusantara\Database\Configuration\Metadata\Xml;

class Metadata extends Manager
{
	public function __construct()
	{
		$this->add('annotation', new Annotation());
		$this->add('php', new Php());
		$this->add('xml', new Xml());
	}
}
