<?php
ini_set('display_errors', E_ALL);
set_time_limit(0);
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
ini_set('memory_limit', '1024M');

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/config/bootstrap.php';

$config = require __DIR__ . '/config/web.php';

(new yii\web\Application($config))->run();
