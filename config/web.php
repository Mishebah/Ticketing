<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$settings = require __DIR__ . '/settings.php';
$config = [
    'id' => 'brandrive',
	'name'=>'brandrive',
    'basePath' => dirname(__DIR__),
   // 'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
	'modules' => [
   'gridview' =>  [
        'class' => '\kartik\grid\Module',
	'bsVersion' => '4.x',
//       'downloadAction' => 'gridview/export/download',
    ]
],
   
       // 'controllerNamespace' => 'controllers',
    'components' => [
             'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'gBtcPI-IWjwssdfadfabQO6ulci3%3ssqfeafdwww-j7y',
                         'csrfParam' => '_brandrive-frontend',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
                         'identityCookie' => ['name' => 'brandrive_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanta-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning','info','trace','profile'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'db' => $db,
		
		'assetManager' => [
               'bundles' => [
            'yii\web\JqueryAsset' => [
             //  'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],
		                  /*    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                  'js' => [
                        'theme/vendor/jquery/jquery.js',
                    ]*/
            ],
			 'yii\bootstrap\BootstrapAsset' => [
            'css' => [],
        ],
		 'yii\bootstrap\BootstrapPluginAsset' => [
            'js'=>[]
        ],
			/*'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1',
                    'css' => [
                        'css/bootstrap.min.css'
                    ],
                ],*/

			],
				],  
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
			            '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            '<controller:\w+>/<id:\d+>' => '<controller>/view',
			'terms'=>'site/terms',
			'contact'=>'site/contact',
			'login'=>'site/login',
			'signup'=>'site/signup',
			'custom'=>'custom-uploads/create',
			'credits'=>'dashboard/credits',
            ],
        ],


                 'view' => [
                 'class' => 'yii\web\View',
        ],
               'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'percap.noreply@gmail.com',
                'password' => '!23qweASD',
                'port' => '587',
                'encryption' => 'tls',
				             'streamOptions' => [
                    'ssl' => ['allow_self_signed' => true, 'verify_peer' => false],
                ],
            ],
        ],
    ],
        'as beforeRequest' =>
            [
                'class' => 'yii\filters\AccessControl',
                'rules' =>  [
                                [
                                     'actions' => ['login','captcha','contact','terms', 'signup','error','passwordreset','index','activate','reset-password','setpassword','set-password'],
                                     'allow' => true,
                                ],
                                [
                                    'allow' => true,
                                    'roles' => ['@'],
                                ],
                            ],
            ],
    'params' => $settings,
	//'settings' => $settings,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1','41.72.216.142','154.123.156.11','41.80.217.81'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1','41.72.216.142','154.123.156.11','66.249.81.245'],

    ];
}

return $config;
