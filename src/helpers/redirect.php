<?php

use SME\Core\Response\Objects\Redirect;

function redirect($url = null) {
	$redirect = new Redirect;
	if (is_string($url)) {
		die($redirect->url($url));
	}elseif (is_null($url))
		return $redirect;
}