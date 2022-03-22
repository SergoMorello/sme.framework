<?php
namespace SME\Core\Response\Objects;

use SME\Core\Request\Request;
use SME\Core\Response\Response;

class Redirect {

	private $response;

	public function __construct() {
		$this->response = new Response;
	}

	public function __toString() {
		return (string)$this->response;
	}

	public function url($url) {
		$this->response = $this->response->header('Location', $url);
		return $this;
	}

	public function route($name, $props = []) {
		$this->response = $this->response->header('Location', route($name,$props));
		return $this;
	}

	public function back() {
		self::setOldInputs();
		$this->response = $this->response->header('Location', Request::server('HTTP_REFERER'));
		return $this;
	}

	public function withCookie(...$args) {
		$this->response = $this->response->cookie(...$args);
		return $this;
	}

	public function withErrors($data) {
		if (!is_array($data))
			return;
		session(['__withErrors' => $data]);
	}

	private function setOldInputs() {
		session(['__oldInputs' => Request::all()]);
	}
}
