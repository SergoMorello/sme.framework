<?php
namespace SME\Core\Request\Objects;

class Cookie {
	private $__cookie;

	public function __construct($cookie) {
		$this->__cookie = (object)$cookie;
	}

	public function get($name) {
		return $this->__cookie->$name ?? null;
	}

	public function getAll() {
		return $this->__cookie;
	}

	private function delete($cookie) {
		if (isset($this->__cookie->{$cookie})) {
			unset($_COOKIE[$cookie]); 
    		setcookie($cookie, null, -1, '/');
			return true;
		}
		return false;
	}

	public function forget($cookies) {
		if (is_string($cookies)) 
			return $this->delete($cookies);
		if (is_array($cookies)) {
			foreach($cookies as $cookie)
				$this->delete($cookie);
			return true;
		}
	}
}