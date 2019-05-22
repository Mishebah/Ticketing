<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once __DIR__ . '/bootstrap.php';

/**
 * Description of pushSMSAPI
 *
 * 
 */
class PushSMSAPI
{

    //Declare variables
    private $sourceAddress;  //The short code of the external system using this API to send a response to the user.
    private $destAddress;   //The MSISDN of recipient.
    private $message;
    private $payload;
    private $networkID;
    private $specificstatus;
    private $clientSMSID;
    private $response = array('SUCCESS' => false,
        'STATCODE' => 0,
        'REASON' => '',
        'DATA' => array("ref_id" => null));
    private $clientID;
    private $clientUsername;
    private $clientPassword;
	private $linkID;
    /* Parameters expected from a single request with batch records to be processed */
    private $isBatchRequest;
    private $batchPayload;
	private $service;
	private $allowedServiceTypes = ['bulk'=>1,'onDemand'=>2];
	private $authPayload =null;
    /**
     * Param that indicates whether the incoming message is encrypted or false
     */
    private $encrypted;
    /**
     *
     * @var object of the DBUtils class
     */
    public $dbUtils;
    /**
     * Param to indicate if this request is of the retry-type, the kind 
     * of request to be retried -- e.g.VAS. 
     */
    private $retry;

    /**
     * Default constructor
     */
    public function __construct()
    {
       CoreUtils::flog4php(4, NULL, array('REQUEST ' => json_encode($_REQUEST)), __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);
                if (isset($_REQUEST['payload']))
        {
            $this->isBatchRequest = true;
            $this->batchPayload = $_REQUEST['payload'];
            $this->clientUsername = $_REQUEST['credentials']['username'];
            $this->clientPassword = $_REQUEST['credentials']['password'];
        }
        else
        {
/*$finalURL = "https://197.248.7.118:1112/sendsms.php?username=" . urlencode($username) . "&password=" . urlencode($password) . "&message=" . urlencode($message) . "&shortcode=$shortcode&mobile=$mobile";
*/          

		   $this->sourceAddress = isset($_REQUEST['shortcode']) ? $_REQUEST['shortcode'] : NULL;
            $this->destAddress = isset($_REQUEST['mobile']) ? $_REQUEST['mobile'] : NULL;
            $this->message = isset($_REQUEST['message']) ? $_REQUEST['message'] : NULL;
            $this->clientSMSID = isset($_REQUEST['clientSMSID']) ? $_REQUEST['clientSMSID'] : 0;
		    $this->service = isset($_REQUEST['service']) ? $_REQUEST['service'] : "bulk";
		    $this->linkID = isset($_REQUEST['linkID']) ? $_REQUEST['linkID'] : '';
            /*
             * Set encrypted if request needs message to be encrypted or not
             */
            $this->encrypted = isset($_REQUEST['encrypted']) ? $_REQUEST['encrypted'] : 0;
            /* -- Assign a value to our variable -- */
            $this->retry = isset($_REQUEST['retry']) ? $_REQUEST['retry'] : 0;

            /* Authentication params */
            $this->clientUsername = isset($_REQUEST['username']) ? $_REQUEST['username'] : NULL;
            $this->clientPassword = isset($_REQUEST['password']) ? $_REQUEST['password'] : NULL;

            //Remove the keys in first arg from the $_REQUEST array
            $payload = CoreUtils::unsetKeys(array('username', 'password', 'source', 'destination', 'message', 'clientSMSID', 'encrypted', 'retry'), $_REQUEST);
            $this->payload = json_encode($payload);
        }
		        $this->dbUtils = new DbUtils();
    }

    /**
     * This function checks whether the required request parameters were provided in the request
     * 
     * @return boolean True if all params were provided, false if otherwise
     */
    private function isValidRequest()
    {
        $valid = true;
        if (is_null($this->clientUsername) || empty($this->clientUsername)):
            $this->response['REASON'] .= "Please provide a 'username'. ";
            $valid = false;
        endif;
        if (is_null($this->clientPassword) || empty($this->clientPassword)):
            $this->response['REASON'] .= "Please provide a 'password'. ";
            $valid = false;
        endif;
        if (is_null($this->destAddress) || empty($this->destAddress)):
            $this->response['REASON'] .= "Please provide a 'destination'. ";
            $valid = false;
        endif;
        if (is_null($this->sourceAddress) || empty($this->sourceAddress)):
            $this->response['REASON'] .= "Please provide a 'source'. ";
            $valid = false;
        endif;
        if (is_null($this->message) || empty($this->message)):
            $this->response['REASON'] .= "Please provide a 'message'. ";
            $valid = false;
        endif;
        if (is_null($this->service) || empty($this->service)):
            $this->response['REASON'] .= "Please provide a 'service'.  either bulk or ondemand";
            $valid = false;
        endif;
        return $valid;
    }
    /**
     * This function checks whether the provided parameters are valid
     * 
     * @return boolean True if all params were valid, false if otherwise
     */
    private function validParams()
    {
        $valid = true;
        if (!array_key_exists($this->service,$this->allowedServiceTypes) )
		{
            $this->response['REASON'] .= "Please provide a valid service bulk or ondemand. ";
            $valid = false;
        }
		 if (array_key_exists($this->service,$this->allowedServiceTypes) and $this->allowedServiceTypes[$this->service] ==SERVICE_ONDEMAND and (is_null($this->linkID) || empty($this->linkID) || strlen($this->linkID) < 5))
		 {
		   $this->response['REASON'] .= "Invalid link ID for ondemand service. ";
            $valid = false;
		 }
        return $valid;
    }
       /**
     * This function checks whether all parameters provided are valid
     * 
     * @return boolean True if all params are valid, false if otherwise
     */
    private function validateParams()
    {
 $starttime = microtime(true);
        if ($this->isValidRequest()) 
        {
            if (($this->destAddres = CoreUtils::isValidMobileNo($this->destAddress)) > 0  && CoreUtils::isValidAccessPoint($this->sourceAddress) && $this->validParams()) :
                $this->response['SUCCESS'] = true;
            else :
                $this->response['SUCCESS'] = false;
                $this->response['STATCODE'] = INVALID_PARAM_TYPE;

                if (!CoreUtils::isValidMobileNo($this->destAddress)) :
                    $this->response['REASON'] .= " Invalid mobile phone number provided. ";
                endif;
                if (!CoreUtils::isValidAccessPoint($this->sourceAddress)) :
                    $this->response['REASON'] .= " Invalid short code provided. ";
                endif;
            endif;
        }
        else 
       {
            $this->response['SUCCESS'] = false;
            $this->response['STATCODE'] = MISSING_USER_DATA;
            $this->response['REASON'] = "Invalid request missing user data. " . $this->response['REASON'];
        }
$tat = sprintf("%.2f", microtime(true) - $starttime);
        CoreUtils::flog4php(4, "DESTADDRESS: " . $this->destAddress, array('DATA' => "SOURCEADDRESS=>".$this->sourceAddress."|TAT => $tat"), __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);
    }

    /**
     * Entry point to the script, authenticates the request and if authentication is successful, executes the request.
     */
    public function init()
    {
        $starttime = microtime(true);
        if ($this->isBatchRequest) /* -- If this is a batch request, execute as batch -- */
        {
            $this->executeBatchRequest();
        }
        else /* -- if this is not a batch request, execute as a single request -- */
        {
            $this->executeRequest();
        }
$tat = sprintf("%.2f", microtime(true) - $starttime);
       CoreUtils::flog4php(4, "clientID: " . $this->clientID, array('DATA' => "REQUEST=>".json_encode($_REQUEST)."|TAT => $tat"), __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);
    }

    /**
     * Execute a request. Validation is done before calling processor functions.
     */
    private function executeRequest($dbUtils = null)
    {
		
		     	$this->validateParams();
			if ($this->response['SUCCESS']) :
			
            $this->authPayload = CoreUtils::authenticateApiRequest($this->clientUsername, $this->clientPassword, $this->sourceAddress,$this->allowedServiceTypes[$this->service], $this->dbUtils);
		
           CoreUtils::flog4php(4, NULL, array('DATA' => "AUTH Paylod".json_encode( $this->authPayload)."REQUEST".json_encode($_REQUEST)), __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);
        /* -- Set the overal status if the authentication failed -- */
        if (!empty($this->authPayload) and $this->authPayload !=null ):
		      	
	if(CoreUtils::checkCredit($this->authPayload['DATA'], $this->message, $this->dbUtils)):
        $starttime = microtime(true);
		
            	$pushSMS = new PushSMS($this->authPayload['DATA'],  $this->sourceAddress, $this->destAddress, $this->message, $this->payload,  $this->clientSMSID, $this->encrypted, $this->retry, $this->dbUtils);
            	$this->response = $pushSMS->processRequest();
$tat = sprintf("%.2f", microtime(true) - $starttime);
          CoreUtils::flog4php(4, "TAT".$tat, array($this->sourceAddress => json_encode($this->response)), __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);         	
               	if ($this->response['SUCCESS']) :
            		$this->response['DATA']['CLIENT_SMS_ID'] = $this->clientSMSID;
					endif;
					
				else :
				$this->response['SUCCESS'] = false;
                $this->response['STATCODE'] = INSUFFICIENT_CREDIT;
				$this->response['REASON'] = "Insufficient Credit to Send Message";
				endif;
            
        else :
       
            $this->response['SUCCESS'] = false;
            $this->response['STATCODE'] = FAILED_AUTHENTICATION;
			 $this->response['REASON'] = "Invalid Credentials";
        		endif ;
				endif ;
	/* -- Formulate and provide response -- */ 
    if($this->response['SUCCESS'] ==true):
	echo $this->response['DATA']['REFERENCEID'].";Success";
	else :
	echo $this->response['STATCODE'].";".$this->response['REASON'];
	endif ;
		
//echo json_encode($this->response);
	}
    /**
     * Process a single request with batch records to be processed.
     */
    private function executeBatchRequest()
    {
        /* Create 1 db connection to be used by the many requests in batch */
        $dbUtils = new DbUtils();
        /* Loop thru batch payload processing each request individually */
        for ($n = 0; $n < count($this->batchPayload); $n++)
        {
            $request = $this->batchPayload[$n];

            $this->hubID = isset($request['hubID']) ? $request['hubID'] : 0;
            $this->sourceAddress = isset($request['source']) ? $request['source'] : NULL;
            $this->destAddress = isset($request['destination']) ? $request['destination'] : NULL;
            $this->message = isset($request['message']) ? $request['message'] : NULL;
            $this->connectorRule = isset($request['connectorRule']) ? $request['connectorRule'] : 0;
            $this->networkID = isset($request['networkID']) ? $request['networkID'] : NULL;
            $this->specificstatus = isset($request['specificstatus']) ? $request['specificstatus'] : NULL;
            $this->blob = isset($request['blob']) ? $request['blob'] : NULL;
            $this->clientSMSID = isset($request['clientSMSID']) ? $request['clientSMSID'] : NULL;
            /*
             * Set encrypted if request needs message to be encrypted or not
             */
            $this->encrypted = isset($request['encrypted']) ? $request['encrypted'] : 0;
            /* -- Assign a value to our variable -- */
            $this->retry = isset($request['retry']) ? $request['retry'] : 0;

            //Remove the keys in first arg from the $request array
            $payload = CoreUtils::unsetKeys(array('source', 'destination', 'message', 'connector',
                        'connectorRule', 'networkID', 'clientSMSID', 'encrypted', 'retry'), $request);
            $this->payload = json_encode($payload);

            $this->executeRequest($dbUtils);
        }
    }

}

// override default script expiry time
set_time_limit(200);

//=============================Call the function ====================================

$pushSMSAPI = new PushSMSAPI();
$pushSMSAPI->init();

//============================End of processRequest===================================
?>
