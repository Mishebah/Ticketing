<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CoreUtils
 *
 * @author cellulant-pd pd@cellulant.com
 */
class CoreUtils {

   /**
     * Return an array as a string indicating all keys and values
     * @param Array $theArray Array to be rendered
     * @param Text $seperator (default '\n') character to use in seperating aray entries
     * @param Text $indent (default '\t') character to prepend every seperate entry
     * @param Bool $keys (default 'true') Show or not to show Key values
     * @param Bool $heading (default 'true') Show or not to show "ARRAY(" headings
     * @param Text $equator (default '=') character to seperate Key from value
     * @param Text $open (default '[') character to appear befor Key value
     * @param Text $close (default ']') character to appeart after key value
     * @param Text $doubleindent (default '\t') character to be appended to $indent when in nested array
     * @return Text Text representation of the array
     */
    public static function printArray($theArray, $seperator = "\n", $indent = " \t", $keys = true, $heading = true, $equator = ' => ', $open = '[', $close = ']', $doubleIndent = " \t") {
        $ss = 0;
        $myString = '';
        if (is_array($theArray)) {
            if ($heading)
                $myString = "Array($seperator" . "$indent";

            foreach ($theArray as $key => $value) {
                if ($ss++ != 0)
                    $myString .= $seperator . $indent;
                if (is_array($value)) {
                    if ($keys) {
                        $myString .= $open . $key . $close . $equator;
                    }

                    $myString .= self::printArray($value, $seperator, $indent . $doubleIndent, $keys, $heading, $equator, $open, $close, $doubleIndent);
                } else {
                    if ($keys) {
                        $myString .= $open . $key . $close . $equator;
                    }

                    $myString .= $value;
                }
            }
            if ($heading)
                $myString .= $seperator . $indent . ")";
        } else {
            $myString = (string) $theArray;
        }
        return $myString;
    }

    /**
     * Log Function using log4php library .
     * @param int $logLevel
     * @param string $uniqueID 
     * @param string $stringtolog
     * @param string $fileName
     * @param string $function
     * @param int $lineNo
     * @param string $logger 
     * 
     * @example $stringtolog = CoreUtils::processLogArray(array("networkid"=>"1","message"=>"New safaricom USSD request","msisdn"=>$MSISDN,"accessPoint"=>$DATA));
        CoreUtils::flog4php(4,$stringtolog , __FILE__, __FUNCTION__, __LINE__, "safussdinterfaceinfo", $logproperties);
     */
    public static function flog4php($logLevel, $uniqueID=NULL, $arrayparams = null, $fileName = NULL, $function = NULL, $lineNo = NULL, $logger = NULL, $propertiespath) {
        
        $stringtolog = self::processLogArray($arrayparams);
        
        Logger::configure($propertiespath);
        $log4phplogger = Logger::getLogger($logger);
        //[date time | log level | file | function | unique ID(e.g MSISDN) | log text ]

        $loggedstring = "$fileName|$function|$uniqueID| $stringtolog";
        switch ($logLevel) {
            case 1: //critical
                $log4phplogger->fatal($loggedstring);
                break;
            case 2://fatal
                $log4phplogger->fatal($loggedstring);

                break;
            case 3://error
                $log4phplogger->error($loggedstring);

                break;
            case 4://info
                $log4phplogger->info($loggedstring);

                break;
            case 5://sequel
                $log4phplogger->debug($loggedstring);

                break;
            case 6://trace
                $log4phplogger->trace($loggedstring);

                break;
            case 7://debug
                $log4phplogger->debug($loggedstring);

                break;
            case 8://custom
                $log4phplogger->info($loggedstring);

                break;
            case 9://undefined
                // $log4phplogger->fatal($loggedstring);

                break;
            case 10: //warn
                $log4phplogger->warn($loggedstring);
                break;

            default; //undefined
        }
    }

    /**
     * Formulates common hub channels payload to log within a given request.
     * String to be returned will be concatenated for final log as show below
     * [date time | log level | file | function | unique ID | <<STRING RETURNED>> ]
     * 
     * @example method call - processLogArray(array("channelRequestID"=>32323,"networkid"=>1,"msisdn"=>254721159049..etc));
     * @param type $arrayparams
     */
    public static function processLogArray($arrayparams) {
       
        $logstringtoreturn = "";
        $paramCount = count($arrayparams);
        
        if(is_array($arrayparams))
        {
            $counter = 0;
            foreach ($arrayparams as $key => $value) {
                $counter ++;
                
                $logstringtoreturn.= $key . ":" . $value . ($counter < $paramCount ? "," : "");
            }
        }
        else
        {
            return (string)$arrayparams;
        }
        
        return $logstringtoreturn;
    }


    public static function logSessionTAT($log, $string) {
        //This will later be inserted into DB        
        $date = date("Y-m-d H:i:s");
        if ($fo = fopen($log, 'ab')) {
            fwrite($fo, "$date - [INFO] " . $_SERVER['PHP_SELF'] . " | $string\n");
            fclose($fo);
        } else {
            trigger_error("flog Cannot log '$string' to file '$file' ", E_USER_WARNING);
        }
    }

    public static function getMicrotime() {
          list ($msec, $sec) = explode(" ", microtime());
          return ((float) $msec + (float) $sec);
    }

public function unsetKeys($keyArr, $request)
{
	foreach($keyArr as $key) {
   unset($request[$key]);
}
}
    public  function isValidAccessPoint($accessPoint)
   {
if($accessPoint = '')
	return false;
if(strlen($accessPoint) >12)
	return false;

return true;

 }
 	    public function checkCredit($authPayload,$message,$dbUtils) {
        $query = "select cAllocated-cConsumed as creditsAvailable from (select if(sum(creditsAllocated)>0,sum(creditsAllocated),0) as cAllocated from creditAllocation ca inner join clients p on p.clientid = ca.clientID   where p.clientID=?) as allocated,(select if(sum(cc.creditsConsumed)>0,sum(cc.creditsConsumed),0) as cConsumed from creditConsumption cc inner join users u on cc.consumedBy=u.userID inner join clients p  on p.clientid = cc.clientID   where p.clientID=?) as consumed";
        $response = $dbUtils->query($query, [$authPayload['clientID'],$authPayload['clientID']]);
		
         CoreUtils::flog4php(4, $authPayload['clientID'], ['Check Credit Results =>'=>json_encode($response)], __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);
        if ($response['DATA']['RESULTS'] && $response['SUCCESS'] && $response['SUCCESS'] ==true) {
            $smsToGo = str_split($message, 160);
            if (($response['DATA']['RESULTS'][0]['creditsAvailable'] - count($smsToGo)) > 0) {
CoreUtils::flog4php(4, $authPayload['clientID'], ['Credit Balance' => $response['DATA']['RESULTS'][0]['creditsAvailable'] - count($smsToGo) ], __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);
	
                    return true;
                } else {
                    return false;
                }
        } 
		else 
			return false;
        
    }

	
	public function authenticateApiRequest($clientUsername, $clientPassword, $sourceAddress,$serviceType,$dbUtils)
	{
	//we now authenticate this check  
	$query ="select apiUserID, api_secret,c.clientID, s.serviceID,s.serviceName,serviceTypeID, accessCode,sourceAddress, sdpServiceID from apiUsers a join clients c on a.clientID = c.clientID join services s on c.clientID = s.clientID join sourceAddresses sa on s.sourceAddressID = sa.sourceAddressID where sa.sourceAddress =? and api_key =?  and a.active =1 and c.active =1 and s.active =1 and sa.active =1 and serviceTypeID =? ";

        $response = $dbUtils->query($query, [$sourceAddress, $clientUsername,$serviceType]);
        CoreUtils::flog4php(4, $sourceAddress, ['message'=> "variables for fetching service mapping: AccessPoint: {$sourceAddress}  Api_Key {$clientUsername} ServiceTypeID {$serviceType}","Results"=>json_encode( $response)], __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);

        if ($response['DATA']['RESULTS'] && $response['SUCCESS'] ) {
			    $hasher = new PasswordHash(8, false);
				                          //Fetch the stored api_secret from the DB
                            $storedPass = $response['DATA']['RESULTS'][0]['api_secret'];
							   $check = $hasher->CheckPassword($clientPassword,
                                $storedPass);
							//$check = true;
                            if ($check) {			
							
			//we respond with the first row only 
		//print_r($response['DATA']['RESULTS'][0]);
		unset($response['DATA']['RESULTS'][0]['api_secret']);
            $returndata['SUCCESS'] = true;
            $returndata['DATA'] = $response['DATA']['RESULTS'][0];
            $returndata['MESSAGE'] = 'fetched data ';
			    return $returndata;
							}
							else
							{
                    CoreUtils::flog4php(4,$sourceAddress, ['message'=> "authenticateApiRequest Failed "], __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);
			return false;
        }	
        } else {
                    CoreUtils::flog4php(4,$sourceAddress, ['message'=> "User Does Not Exist or Service is not mapped"], __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);
			return false;
        }
    
		
	}
	
	    public  function isValidMobileNo($msisdn)
   {

       //get the country dial code
       $dialCode = '254';//Yii::app()->params['DEFAULT_COUNTRY_DIAL_CODE'];
       $msisdnLength = 12; //Yii::app()->params['DEFAULT_COUNTRY_MSISDN_LENGTH'];
       //if the first number is 0
       if (substr($msisdn, 0, 1) == '+' and  strlen($msisdn)==13) {
           $msisdn = substr($msisdn, 1);
       }

       //if the first number is 0, add default dial code
       if (substr($msisdn, 0, 1) == 0 and  strlen($msisdn)==10) {
           $msisdn = $dialCode . substr($msisdn, 1);
       }
       if (substr($msisdn, 0, 1) == 7 and strlen($msisdn)==9 ) {
           $msisdn = $dialCode.$msisdn;
       }

       //if the dialcode matches the default one & its the expected length
       if (substr($msisdn, 0, strlen($dialCode)) == $dialCode &&
           strlen($msisdn) == $msisdnLength) {
           return $msisdn;
       }
       return 0;
   }

}

?>
