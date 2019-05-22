<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

define('test ',"1006");
define('LOG_DIRECTORY', '/var/log/applications/messaging/apis/clientAPI/');
define('SYSTEM_LOG_LEVEL', 10);
define('NL', "\n");
define('TB', "");
define('SMS_LOG_PROPERTIES', dirname(__FILE__) . '/sms_logs.properties');
define('SMS_CERT_PATH', '');
define('SSL_ENGINE', true);

// Various HTTP Error response messages for the Controller class

define('TIMEOUT_DURATION', 5); //response timeout duration in sec
define('CONNECT_TIMEOUT', 0); //connect duration timeout.


//Various friendly error messages for different situations. used within the USSDRouter Class
define('ERROR_MESSAGE_HTTP_404', "USSDRouter:404 err-Dear Customer, we are experiencing technical difficulties. Please try again later");
define('ERROR_MESSAGE_HTTP_RESPONSE_TIMEOUT', "USSDRouter:Timeout err- Dear Customer, we are experiencing technical difficulties. Please try again later");
define('ERROR_LOG_TO_USSD_ACTIVITIES', "USSDRouter:Insert hops err-Dear Customer, we are experiencing technical difficulties. Please try again later");
define('ERROR_FETCH_MENU_SYSTEM_URL', "USSDRouter:Fetch route URL err-Dear Customer, we are experiencing technical difficulties. Please try again later");
define('ERROR_UNKNOWN_HTTP_ERROR', "USSDRouter:Unknown HTTP err -Dear Customer, we are experiencing technical difficulties. Please try again later");
define('ERROR_MESSAGE_HTTP_500', "USSDRouter:Internal server error -Dear Customer, we are experiencing technical difficulties. Please try again later");
  
    
// The time in minutes to which a session should last.
define('SESSION_EXPIRY_DURATION', 5);

define('PHP_POST_PROTOCOL_ID', 1);
define('XML_RPC_PROTOCOL_ID', 3);

// Various status codes used by ussd
define('SUCCESS_UPDATE_STATUS', 1);
define('TIME_OUT_ERROR_STATUS', 11);
define('ROUTE_NOT_FOUND_STATUS', 6);
define('INTERNAL_SERVER_ERROR_STATUS', 7);
define('UNKNOWN_ERROR_STATUS', 0);
define('MISSING_USER_DATA',"1002");
define('INVALID_PARAM_TYPE',"1001");
define('SERVICE_ONDEMAND',2);
define('SERVICE_BULK',1);
define('FAILED_AUTHENTICATION',1006);
define('INSUFFICIENT_CREDIT',1004);


?>
