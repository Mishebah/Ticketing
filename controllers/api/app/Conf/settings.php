<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'mpesac2bapi',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '../../../log/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
		'database'=>[
			'host'=>'localhost',
			'user'=>'root',
			'password'=>'',
			'database'=>'kasico',
			'port'=>'3306',
    ],

//settings for users    
	'logs' => [
	'INFO'=>'info.log',
	'ERROR'=> 'error.log',
	'FATAL'=> 'fatal.log',   
	'DEBUG'=> 'debug.log',   
        'TAT_INFO'=> 'tat_info.log',
        'TAT_ERROR'=> 'tat_error.log',
	],
	 'MIN_AMOUNT'=>10,
	 'MAX_AMOUNT'=>7000,
	 'mpesa'=>[
	'MPESA_STK_URL' =>"https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest",
	'MPESA_CREDENTIALS_URL' =>"https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials",
    'PASS_KEY'  =>"c533f2225f36dfcb303f1a5f6c86d6b94e7d0ce35f7a18817d4e57adefb8b022",
    'CONSUMER_KEY' =>"oa1dxa19g88FqcFkCkcgGfN5dmgXdlgy",
     'CONSUMER_SECRET' =>"p5Gy9UjQSruaBLlo",
    'MPESA_PAYBILL' => "299558",
     'MPESA_CALLBACK_URL' => "https://41.209.12.156:8087/mpesaapi/api/safaricom/mpesac2b/stkresults",
	],
	'faiba'=>[
	'CHECKBAL_URL'=>"https://197.232.56.49:8243/faiba/mobile/v3/DFaibaBalance",
	'ACCESSTOKEN_URL'=>'https://197.232.56.49:8243/token?grant_type=client_credentials',
	'RECHARGE_URL'=>'https://192.168.47.7:8243/faiba/mobile/v3/DFaibaRecharge',
	'CLIENT_ID' =>"E4gzn28fTdPv54fZBk5O757TdgIa",
    'CLIENT_SECRET' =>"_o3wcZhc3NfLLp8iZA3egBFdbJ0a",
	'API_FUNCTION'=>'',
	
	],
	'templates'=>[
	'SUCCESS_MESSAGE'=>'',
	'FAILED_MESSAGE'=>'',
	 'PENDING_MESSAGE'=>'',
	],
	'sms'=>[
	'SHORTCODE'=>''
	],
	],
];
