<?php
//namespace App\lib
/**
 * This file contains core utilities.
 *
 * PHP VERSION 7.0
 *
 * @category  PAYMENT GATEWAY
 * @package   BenchMark
 * @copyright 2017 Gravity Limited Ltd
 * @license   Proprietory License
 * @link      http://gravity.co.ke
 */
class CoreUtils
{
    /**
     * Replaces the ? with the right parameter for logging purposes.
     *
     * @param string $query the parameterised SQL query
     * @param array $params the SQL query parameters
     *
     * @return string the complete query for logging purposes
     */
    public static function formatQueryForLogging($query, $params) {
        try {
            /*
             * Divide the string using the ? delimeter so we can replace
             * correctly.
             */
            $buffer = explode('?', $query);

            $c = count($params);
            for ($index = 1; $index < $c; $index++) {
                /*
                 * Starts from index 1 to ignore the first param. Append back
                 * the ? after it was removed by the explode method.
                 */
                $sub = $buffer[$index - 1] . '?';

                // In each sub string replace the ?
                $buffer[$index - 1] = str_replace('?', $params[$index], $sub);
            }

            // Recontruct the string
            return implode("", $buffer);
        } catch (Exception $ex) {
            // If any thing goes wrong return the original string
            return $query;
        }
    }

    /**
     * Receives the post from API and decodes the JSON string.
     *
     * @return array returns the decoded JSON string or an error message and
     *               appropriate status code if there is an error
     *
     * 
     */
    public static function receivePost() {
        $jsonPOST = file_get_contents("php://input");
        if ($jsonPOST == null) {
            // No post
            $authStatus['status'] = false;
            $authStatus['description'] = "Payload not posted successfully to "
                . "the handler.";
            return $authStatus;
        } else {
            $response = json_decode($jsonPOST, true);

            if ($response != null || $response != false) {
                // All good
                return $response;
            } else {
                // Cannot decode
                $authStatus['status'] =false;
                $authStatus['description'] = "Internal server error, "
                    . "payload cannot be decoded. Please Contact support.";
                return $authStatus;
            }
        }
    }

    /**
     * Function to format missing parameters in a request into a string to be
     * added to the response description.
     *
     * @param array $missingParams the missing parameters array
     *
     * @return string a string of the concatenated parameters
     *
     * 
     */
    public static function formatMissingParams($missingParams) {
        $desc = "";

        $length = count($missingParams);

        foreach ($missingParams as $param) {
            if ($length > 1) {
                $desc = $desc . $param . ", ";
            } else {
                $desc = $desc . $param . " ";
            }
            $length++;
        }

        return $desc;
    }
    /**
     * This function gets the validates the action and mapping to client ID 
     *
     * @param array Client ID and UserID  
     *  @param str action maps to the service code
     * @return string the status code descriptio
     *
     * 
     */
    public static function getServiceDetails($sCode,$auth,$log) {
        $dblink = new MySQL(
            Config::HOST, Config::USER, Config::PASSWORD, Config::DATABASE,
            Config::PORT
        );

        try {
            $sql = "SELECT s.serviceID,s.serviceCode,s.ownerClientID,c.payerClientID,s.minAmount,s.maxAmount FROM b_services s join b_serviceClientSettings c  WHERE "
                . "c.active =1 and s.active =1 and c.payerClientID = ? and s.ownerClientID != ? and s.serviceCode =?";

            $params = array("iis", $auth['clientID'],$auth['clientID'],$sCode);

            $result = DatabaseUtilities::executeQuery(
                    $dblink->mysqli, $sql, $params
            );
                        $log->sequelLog(Config::DEBUG, -1,"Query to serviceDetails : ". CoreUtils::formatQueryForLogging($sql, $params));
                        // Result from the executed query

					if (count($result) == 1) {
                            $log->debugLog($this->DEBUG, -1,
                                "Result from query: "
                                . $log->printArray($result));
								return $result[0];
					}
					else
					{
						return ['serviceID'=>1,'serviceCode'=>'Airtime','ownerClientID'=>1,'payerClientID'=>1,'minAmount'=>100,'maxAmount'=>400];
					return null;			
					}
					
        } catch (SQLException $e) {
            $resp = "Unable to get status code description. ";
        }
        return trim($resp);
    }
    /**
     * This function gets the description of a status code as stored in the
     * database.
     *
     * @param int $status the status code to get the description of
     *
     * @return string the status code descriptio
     *
     * 
     */
    public static function getStatusDescription($status) {
        $dblink = new MySQL(
            Config::HOST, Config::USER, Config::PASSWORD, Config::DATABASE,
            Config::PORT
        );

        try {
            $sql = "SELECT statusDescription FROM transactionStatus WHERE "
                . "statusCode = ?";

            $params = array("i", $status);

            $result = DatabaseUtilities::executeQuery(
                    $dblink->mysqli, $sql, $params
            );

            if (count($result) > 0) {
                $resp = $result[0]['statusDescription'];
            } else {
                $resp = "Unable to get status code description. ";
            }
        } catch (SQLException $e) {
            $resp = "Unable to get status code description. ";
        }
        return trim($resp);
    }

    /**
     * POST the request to Beep Core processor using JSON.
     *
     * @param string $url the Beep Core url
     * @param string $jsonString the post data string
     *
     * @return mixed the response data on success or false on failure
     *
     */
    public static function httpJsonPost($url, $jsonString) {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, Config::CONNECTION_TIMEOUT);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $curl, CURLOPT_HTTPHEADER, array("Content-type: application/json")
        );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonString);

        $jsonResponse = curl_exec($curl);

        // Close connection
        curl_close($curl);

        return $jsonResponse;
    }

    /**
     * Function to update the status history, concatinates the previous data
     *      with new activity history
     *
     * @param string $historyFieldName  Name of the field which is being updated
     * @param int $status   New status to be updated to
     * @param int $userID   User ID in the functio
     *
     * @return string The string to concatinate with SQL statement for insert
     */
    public static function getHistorySQL($historyFieldName, $status, $userID) {
        $activityHistory = $status . "|" . $userID;

        $returnString = "IF($historyFieldName IS NULL, CONCAT(\""
            . $activityHistory . "\",\"|\",NOW()), CONCAT($historyFieldName, \", \" , "
            . "CONCAT(\"$activityHistory\",\"|\",NOW()))) ";

        return $returnString;
    }

    /**
     * Check if date provided is valid.
     *
     * @param string $datePaymentReceived the date to validate
     *
     * @return boolean true if valid, false otherwise
     */
    public static function isValidateDatePaymentReceived($datePaymentReceived) {
        $dates = preg_split("/[-]/", $datePaymentReceived);

        if (count($dates) < 3) {
            return false;
        }

        $paymentDate = strtotime($datePaymentReceived);
        $minDate = strtotime("-1 year", strtotime(date("Y-m-d")));
        if ($paymentDate > $minDate) {
            $year = (int) $dates[0];
            $month = (int) $dates[1];
            $day = (int) $dates[2];
        } else {
            return false;
        }

        if (trim($dates[0]) == "" || trim($dates[1]) == "" || trim($dates[2]) == "") {
            return false;
        }

        if (!checkdate($month, $day, $year)) {
            return false;
        }
        // The date provided is a valid date
        return true;
    }

 

    /**
     * checks if string contains date only
     *
     * @param string $date The date string to be checked
     *
     * @return bool A true for valid due date and false for date only
     */
    public static function is_date($date) {
        if (!preg_match('@^(\d\d\d\d)-(\d\d)-(\d\d)$@', $date, $matches)) {
            return false;
        }
        if (!checkdate($matches[2], $matches[3], $matches[1])) {
            return false;
        }
        return true;
    }

    /**
     * Validates the content on a narration.
     *
     * @param String $narration the narration to validate
     *
     * @return true if valid content, false otherwise
     */
    public static function validateNarration($narration) {
        if (preg_match("/^[a-zA-Z0-9\.\s!@$&():;\'\",-]{4,300}$/", $narration)) {
            return true;
        } else {
            return false;
        }
    }

    public static function arraySort(&$array, $key) {
        $sorter = array();
        $ret = array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va[$key];
        }
        //SORT_ASC does not mean it will sort in the values of the key in an
        //ascending manner rather it will sort the Keys of the $sorter variable
        //in ascending manner
        asort($sorter, SORT_DESC);
        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }
        return $ret;
    }

    /**
     * Check whether mobile number is valid.
     *
     * @param string $msisdn the mobile number
     *
     * @return boolean true if valid, false otherwise
     *
     * 
     */
    public static function isValidMSISDN($msisdn) {
        global $status;
        $status = false;

        try {
            $dblink = new MySQL(
                Config::HOST, Config::USER, Config::PASSWORD, Config::DATABASE,
                Config::PORT
            );

            $sql = "SELECT numberRuleRegex FROM networks WHERE "
                . "numberRuleRegex <> ''";
            $result = DatabaseUtilities::executeQuery(
                    $dblink->mysqli, $sql
            );

            $total = count($result);

            for ($i = 0; $i < $total; $i++) {
                $rule = $result[$i]['numberRuleRegex'];
                if (preg_match("/$rule/", $msisdn)) {
                    $status = true;
                    break;
                }
            }
        } catch (SQLException $e) {
            $status = false;
            return $status;
        }

        return $status;
    }

   

    /**
     * Get the start time for a function
     *
     * @return float start time as float
     */
    public static function getTime() {
        return microtime(true);
    }
        function sendMessage($nums,$message)
        {
if(!is_array($nums))
return "array expected";

                $responseMessage =[];
                try{
                        foreach($nums as $phone)
                        {
                                $curl = curl_init();
                                // Set some options - we are passing in a useragent too here
                                curl_setopt_array($curl, array(
                                                        CURLOPT_RETURNTRANSFER => 1,
                                                        CURLOPT_URL => "https://41.209.16.75:8089/bulkSMS/api/PushSMSAPI.php?mobile=".$phone."&shortcode=fanakalotto&message=".rawurlencode($message)."&username=hellolotto&password=h12345",
                                                        CURLOPT_USERAGENT => 'Clarity',
                                                        CURLOPT_SSL_VERIFYPEER => 0
                                                        ));
                                // Send the request & save response to $resp
                                $resp = curl_exec($curl);
                                // Close request to clear up some resources
                                if(curl_error($curl))
                                        $responseMessage[] = "Error: Send Message to  {$phone} => {".curl_error($curl)."}";

                                $responseMessage[] = " Success: Send Message to {$phone}=> {".$resp."}";

                                curl_close($curl);
                        }

                } catch (Exception $ex) {
                        // If any thing goes wrong return the original string
                        $responseMessage[] =  "Error. ".$ex->getMessage();
                }
        return json_encode($responseMessage);

        }

    /**
     * Get time taken to run a process from the start time
     *
     * @param type $startTime start time as float
     * @return type
     */
    public static function getFunctionRunTime($startTime) {

        $timeTaken = (microtime(true) - floatval($startTime)) / 1000.0;

        return "FUNCTION RUN TIME: " . $timeTaken;
    }

    /**
     * perform a simple curl post
     * @param type $url
     * @param type $fields
     * @return
     */
    public static function post($url, $fields) {
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}
