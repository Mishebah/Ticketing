<?php
return [
    'ADMIN_CLIENT_ID' => 1,
    'ADMIN_USER_ID' => 1,
    'TODAY' => date('Y-m-d H:i:s'),    
    'NewUserPasswordURL' => '/index.php/users/newUserPassword?&',
    'ForgotPasswordURL' => 'http://localhost/client/index.php/users/resetUserPassword?&',
    'ResetPasswordURL' => '/index.php/users/resetUserPassword?&',
    'logDirectory' => '', //log directory
    'SYSTEM_LOG_LEVEL' => 10,
    'INFO_LOG_FILE_NAME' => 'INFO',
    'DEBUG_LOG_FILE_NAME' => 'DEBUG',
    'ERROR_LOG_FILE_NAME' => 'ERROR',
    'EXCEPTION_LOG_FILE_NAME' => 'EXCEPTION',
    'RESTRICT_IP' => FALSE,
    'DEFAULT_CACHE_EXPIRY' => 120, //in seconds
    'DEFAULT_LANGUAGE' => 'Eng', //Default language---used in templates
    'FETCH_DATA_LIMIT' => 100,
    'UPLOADED_PAYMENTS_FOLDER' => '/uploads/',
    'maximumInactivityTime' => 300, // 300/60=5 minutes
    'passwordAttempts' => 5, //maximum password attempts
    'passwordRequestTime' => 2, //2 hours...expiry of password tokens
    'AllowedPasswordChars' => '/[^A-Za-z0-9]|[!|%|$]/', //Allowed password characters
    'PasswordMinLength' => 8, //Minimum password length
    'PasswordExpiryDays' => 45, //Password expiry days
    'UnblockableUserGroups' => array('Super-Admin'), //User groups whose password does not expire...will be moved to UI
    //groupIDs that shouldn't be deleted via the UI
    'UNDELETEABLEGROUPS' =>[
        1, //Super Administrators Group
    ],
    //userIDs that shouldn't be deleted via the UI
    'UNDELETEABLEUSERS' => [
        1, // superAdmin
    ],
	  'adminEmail' => 'welcome@percap.co.ke',
    'supportEmail' => 'noreply@percap.co.ke',
    'user.passwordResetTokenExpire' => 3600,
	'sms_url' =>'http://localhost/bulkSMS/api/',
	'RABBIT_MQ'=>[	
	'HOST'=>'',
	'PORT'=>'',
	'USER_NAME'=>'',
	'PASSWORD'=>'',
	'DEFAULT_QUEUE'=>''
	],
	'DEFAULT_SETTINGS'=>[
	'USER_GROUP'=>21,
	'CLIENT_TYPE'=>2,
	'SHORTCODE'=>1234,
	'SOURCEADDR_ID'=>151,
	'FREE_UNITS'=>100,
	'SDP_SERVICE_ID'=>12345,
	'ACCESS_CODE'=>12344
	],
	
    ]
?>


