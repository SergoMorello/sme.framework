<?php
namespace SME\Core\Daten;

class Daten {
	public static function now($timestamp = null) {
		return new DatenObject(is_null($timestamp) ? time() : $timestamp);
	}
}