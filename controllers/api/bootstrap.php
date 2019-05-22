<?php

ini_set('date.timezone', "Africa/Nairobi");
ini_set('display_errors', true);

define('BASE_DIR', __DIR__);

if (!defined('WEB_ROOT'))
    define('WEB_ROOT', BASE_DIR . '/');

require_once(BASE_DIR . '/log4php/Logger.php');

if (!defined('CONFIGS_ROOT'))
    define('CONFIGS_ROOT', WEB_ROOT . 'configs');

if (!defined('UTILS_ROOT'))
    define('UTILS_ROOT', WEB_ROOT . 'utils');

if (!defined('SMS_CORE'))
    define('SMS_CORE', WEB_ROOT . 'Core');

require_once CONFIGS_ROOT . '/smsConfigs.php';
require_once CONFIGS_ROOT . '/dbConfigs.php';

require_once UTILS_ROOT . '/DBUtils.php';
require_once UTILS_ROOT . '/CoreUtils.php';
require_once UTILS_ROOT . '/DatabaseUtilities.php';
require_once UTILS_ROOT . '/MySQL.php';
require_once UTILS_ROOT . '/SQLException.php';
require_once UTILS_ROOT . '/PasswordHash.php';
require_once SMS_CORE  . '/PushSMS.php';

?>
