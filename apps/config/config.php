<?php
/* setup different path */
define('_CONFIG', realpath(__DIR__));
define('_LIB', realpath(_APPS.'/library/'));
define('_CONTROLLERS', realpath(_APPS.'/controllers/'));
define('_MODELS', realpath(_APPS.'/models/'));
define('_VIEWS', realpath(_APPS.'/models/'));

$url_array = explode('/', $_SERVER['REQUEST_URI']); // Get the url

/* Get the different libs */
require _LIB.'/Debug.class.php';
require _LIB.'/Encryption.class.php';
require _MODELS.'/RequestsModel.php';
require _LIB.'/Common.class.php';

/* Init libs */
$debugLib = new DebugManager();
$sqlQuery = new RequestsModel('localhost', 'heroesnet', 'root', '');
$encrypt = new Encryption();
$common = new CommonUtils();

/* Change the default config */
$configFilePath = _CONFIG.'/configuration.ini';
$common->setConfigFile($configFilePath);
$env = $common->getSections(); // ['ALL', 'TEST']
$ini = $common->getEnv($env[1]); // Object who contain the configuration, the index of env is for the test env

//var_dump($ini);

include _CONTROLLERS.'/router.php';