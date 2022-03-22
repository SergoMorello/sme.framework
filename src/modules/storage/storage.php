<?php
namespace SME\Modules;

use SME\Modules\Storage\StorageObject;

class Storage {
	private $obj;

	public function __construct() {
		$this->obj = new StorageObject;
	}

	public static function __callStatic($name, $arg) {

		return (new self)->callMethod($name, $arg);
	}

	public function __call($name, $arg) {
		return $this->callMethod($name, $arg);
	}

	private function callMethod($name, $arg) {
		if (!method_exists($this->obj, $name))
			throw new \Exception('Method "'.$name.'" not fount in Storage class', 1);
		return $this->obj->$name(...$arg);
	}
}
