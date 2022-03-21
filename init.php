<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

define('SME_START', microtime(true));
define('FRAMEWORK', __DIR__);
define('ROOT', realpath(__DIR__ .'/../../..').'/');
define('ROUTES',ROOT.'/routes/');
define('APP',ROOT.'/app/');
define('CONFIG',ROOT.'/config/');
define('CONTROLLER',ROOT.'/app/Controllers/');
define('MODEL',ROOT.'/app/Models/');
define('VIEW',ROOT.'/app/View/');
define('EXCEPTIONS',ROOT.'/app/Exceptions/');
define('MIDDLEWARE',ROOT.'/app/Middleware/');
define('PROVIDERS',ROOT.'/app/Providers/');
define('STORAGE',ROOT.'/storage/');
define('LOGS',ROOT.'/storage/.logs/');
define('ENGINE',FRAMEWORK.'/src/');
define('CORE',FRAMEWORK.'/src/core/');
define('SVIEW',FRAMEWORK.'/src/view/');
define('ENGINE_EXCEPTIONS',FRAMEWORK.'/src/exceptions/');
define('MODULES',FRAMEWORK.'/src/modules/');
define('HELPERS',FRAMEWORK.'/src/helpers/');
define('INC',FRAMEWORK.'/src/inc/');
define('TEMP',ROOT.'/storage/.tmp/');

(function(){
	foreach(require_once(INC.'init.php') as $inc)
		foreach(require_once(INC.$inc.'.php') as $path => $files)
			foreach($files as $file)
				require_once(constant($path).$file.'.php');
})();
