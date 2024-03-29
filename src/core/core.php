<?php
namespace SME\Core;

abstract class Core {
	
	protected static function request() {
		if (App::isConsole()) {
			
			$argvConsole = $_SERVER['argv'];
			if (!isset($argvConsole[1]))
				throw new \SME\Exceptions\Console('', [
					'message' => 'Comand list:',
					'routes' => \Route::__list('command')
				]);

			unset($argvConsole[0]);
			$get = implode(' ', $argvConsole);
			unset($argvConsole[1]);
			return (object)['get'=>Core::guardData($get),'props'=>$argvConsole];
			
		}else{
			
			$splitUrl = explode('?',$_SERVER['REQUEST_URI']);
			$splitProps = function($props) {
				$ret = [];
				$split = explode('&',$props);
				foreach($split as $sp) {
					$splitVar = explode('=',$sp);
					$ret[$splitVar[0]] = Core::guardData($splitVar[1] ?? null);
				}
				return $ret;
			};
			return (object)['get'=>Core::guardData($splitUrl[0]).'/','props'=>(isset($splitUrl[1]) ? $splitProps($splitUrl[1]) : [])];
		}
	}
	
	public static function startTime() {
		return microtime(true) - SME_START;
	}

	public static function call($callback, $props=[]) {
		$callback = explode("@",$callback);
		$callback = is_callable($callback[0]) ? $callback[0] : [new $callback[0],$callback[1]];
		return call_user_func_array($callback, $props);
	}
	
	protected static function guardData($data) {
		$isObj = false;
		if (is_array($data) || $isObj=is_object($data)) {
			$ret = [];
			foreach($data as $key=>$val)
				$ret[$key] = self::guardData($val);
			return $isObj ? (object)$ret : $ret;
		}
		return htmlspecialchars(addslashes($data));
	}
	
	protected static function checkMethod($method) {
		if (App::isConsole())
			return strtolower($method)=='command' ? true : false;
		else
			return strtolower($method)==strtolower($_SERVER['REQUEST_METHOD']) ? true : false;
			
	}
}