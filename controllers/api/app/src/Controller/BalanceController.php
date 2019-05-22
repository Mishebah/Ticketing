<?php
namespace App\src\Controller;
use \Interop\Container\ContainerInterface as ContainerInterface;
use PsrHttpMessageServerRequestInterface as Request;
use PsrHttpMessageResponseInterface as Response;
use \Respect\Validation\Validator as v;

/*handle all Balance Enquery
 */
class BalanceController
{
	protected $container;
	protected $databaseSettings;
	protected $logSettings;
	protected $minAmount;
	protected $maxAmount;
	protected $faibaSettings;
	protected $mpesaSettings;
	protected $smsSettings;
	protected $messageTemplates;
	/**
	 * Log class instance.
	 *
	 * @var object
	 */
	private $log;
	/**
	 * TAT turn around time for functions or loops.
	 * Used for benchmarking
	 * @var object
	 */
	private $tat;

	// constructor receives container instance
	public function __construct($container) {
		$this->container = $container;
		$this->log = new \AppLogger();
		$this->databaseSettings =$container->get('settings')['database'];
		$this->logSettings =$container->get('settings')['logs'];
		$this->adminSettings =  $container->get('settings')['admin'];
		$this->faibaSettings =$container->get('settings')['faiba'];
		$this->mpesaSettings =  $container->get('settings')['mpesa'];
		$this->smsSettings =$container->get('settings')['sms'];
		$this->messageTemplates =  $container->get('settings')['templates'];
		$this->minAmount =$container->get('settings')['minAmount'];
		$this->maxAmount =  $container->get('settings')['maxAmount'];
		
		$this->tat = new \BenchMark(session_id(),$this->logSettings);
	}
	public function __get($property)
	{
		if ($this->container->{$property}) {
			return $this->container->{$property};
		}
	}

	
	public function checkBalance($request, $response, $args)
	{
	//	echo "afda"
		$this->tat->start(\BenchMark::FUNCTION_LEVEL, __METHOD__);
		$this->log->infoLog(
				$this->logSettings['INFO'], -1, "** Balance Enquiry **", '','' );
		$requestData = $request->getParsedBody();
		$json = $request->getBody();
		$this->log->debugLog(
				$this->logSettings['DEBUG'], -1,
				"**Get Balance request ==>"
				.$json."***",' ','' );
		/*
		   if(v::Alnum('-_')->noWhitespace()->NotEmpty()->validate($headers['x-api-key']) ==false)
		   return ['status'=>false,'message'=>"Invalid characters"];
		 */
		if(!is_array($requestData) or $requestData ==null)
		{
			$this->log->errorLog(
					$this->logSettings['ERROR'], -1
					,"Invalid request no json data specified", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);

			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Invalid Request"]);
			exit;
		}
		try 
		{
			$dblink = new \MySQL(
					$this->databaseSettings['host'], $this->databaseSettings['user'], $this->databaseSettings['password'], $this->databaseSettings['database'],$this->databaseSettings['port']     );
			$this->log->infoLog($this->logSettings['INFO'], -1, "**Connect to database**", '','' );
			\DatabaseUtilities::setAutoCommit($dblink->mysqli, false);

		}
		catch(Exception $e)
		{
			//$response->setStatus(404);
			$this->log->errorLog(
					$this->logSettings['ERROR'], -1
					,"Unable to get database Connection".$e->getMessage(), '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			//write to file as well on the failed transactions. 

			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Cancelled"]);
		}

		if(!isset($requestData['msisdn']))
		{
			$this->log->errorLog(
					$this->logSettings['ERROR'], -1
					,"Invalid request missing msisdn parameter", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Invalid Request - msisdn "]);
			exit;	
		}
//v::Alnum('-')->noWhitespace()->NotEmpty()->validate($requestData['msisdn']) ==false) 25474726742902
		if ((v::finite()->noWhitespace()->NotEmpty()->between(254747000000,254747999999)->validate($requestData['msisdn']) ==false )) 
		{
			$this->log->errorLog(
			$this->logSettings['ERROR'], -1,"Invalid request: msisdn not  valid JTL Line", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Invalid Request - msisdn not a valid JTL number "]);
			exit;	                 
        }
try{	
	$token = \FaibaServiceUtils::getFaibaAccessToken($this->faibaSettings,$this->log, $this->logSettings);
	 
if(empty($token) or !array_key_exists("access_token",$token) or is_null($token) )
{
				$this->log->errorLog(
			$this->logSettings['ERROR'], -1,"** Token not generated respond back with a failed message  **", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Invalid Request - try again "]);
			exit;
			
		//WE ROLE BACK THE TRANSACTION
              //  DatabaseUtilities::rollback($dblink->mysqli);
}
else
{
  $timestamp = date("YmdHis");
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $this->faibaSettings['CHECKBAL_URL']);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$token['access_token'])); //setting custom header
$curl_post_data =[
  //Fill in the request parameters with valid values
  'msisdn' => $requestData['msisdn'],
  //create deposit request here 
];

$data_string = json_encode($curl_post_data);
 		$this->log->infoLog($this->logSettings['INFO'], -1, "** Balance Enquiry payload $data_string **", '','' );
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
           curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
$curl_response = curl_exec($curl);
		$this->log->debugLog($this->logSettings['DEBUG'], -1, "** payload {$data_string} |RESPONSE  {".$curl_response."} **", '','' );
$results = json_decode($curl_response,true);

            if (curl_errno($curl) != 0) :
	$this->log->errorLog($this->logSettings['ERROR'], -1,"**getFaibaAccessToken|  Error | unable to get token *".curl_error($curl), '', '');
curl_close($curl);
 return $response->withStatus(404)->withJson([ 'status' => false,"code"=>"900901","message"=>"Failed Request. Error on request try again"]);
	exit;	
             else:
		curl_close($curl);	 
			
			
//now we send to mpesa the transaction 
/*
{
    "fault": {
        "code": 900901,
        "message": "Invalid Credentials",
        "description": "Access failure for API: /faiba/mobile/v3, version: v3 status: (900901) - Invalid Credentials. Make sure you have given the correct access token"
    }
}
*/
	if(isset($results['fault']))
{
 return $response->withStatus(404)->withJson([ 'status' => false,"code"=>"900901","message"=>"Failed Request. Invalid Credentials - try again"]);
	exit;	


}
elseif(isset($results['status']))
{
	switch($results['status'])
	{
		case "-1" :
		$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);	
 return $response->withStatus(404)->withJson([ 'status' => false,"code"=>"900902","message"=>"Failed Request. Invalid Mobile Number"]);		
		break;
		case "1":
		$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
		 return $response->withStatus(200)->withJson([ 'status' => true,"code"=>"200","message"=>"valid Mobile Number","BalDtoList"=>$results['result']['BalDtoList']]);	
		break;
	default:
				$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
 return $response->withStatus(404)->withJson([ 'status' => false,"code"=>"900902","message"=>"Failed Request. Invalid request"]);	
break; 
		
	}

}
else
{
				$this->log->errorLog(
					$this->logSettings['ERROR'], -1
					,"Invalid request -no response", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			
      return $response->withStatus(404)->withJson([ 'status' => false,"code"=>"900902","message"=>"Failed Request. Invalid Request"]);	
                   
 }
			
endif;
			
}
            } catch (Exception $e) {
			$this->log->errorLog(
					$this->logSettings['ERROR'], -1
					,"Exception caught. Error message: ". $e->getMessage(), '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
	 return $response->withStatus(404)->withJson([ 'status' => false,"code"=>"900902","message"=>"Failed Request. Generic Error"]);	
            }
			

	}

    private function insertRequestLog($mysqli, $msisdn) {
        $this->tat->start(BenchMark::FUNCTION_LEVEL, __METHOD__);
          try {
        // Insert into s_requestLogs
        $insRLQuery = "INSERT INTO requestLogs (msisdn, overallStatus,resultsdata,dateCreated, "
            . "appID, insertedBy,updatedBy) "
            . "VALUES (?,?, ?, NOW(),1 , ?, ?)";

        $rparams = array(
            "siissiii",
			$msisdn,
            $this->userID,
            $this->userID
        );

        $this->log->debugLog(
            Config::DEBUG, $transactionID,
            "Insert b_requestLogs query is ==> "
            . CoreUtils::formatQueryForLogging($insRLQuery, $rparams),
            $this->fromCode, $this->toCode
        );

        DatabaseUtilities::executeQuery($mysqli, $insRLQuery, $rparams);
        $reqLogID = DatabaseUtilities::getInsertId($mysqli);

        $this->log->debugLog(
            Config::DEBUG, $transactionID,
            "Inserted b_requestLogs:: ID is $reqLogID", $this->fromCode,
            $this->toCode
        );
        $this->tat->logTAT(BenchMark::FUNCTION_LEVEL, __METHOD__);

        return $reqLogID;
		 } catch (SQLException $sql) {
            DatabaseUtilities::rollback($mysqli);
		$reqLogID =-1;
            $this->log->errorLog(
                Config::ERROR, $transactionID,
                "b_requestLogs DBError: " . $sql->getMessage(), $this->fromCode, $this->toCode
            );
        }
		  return $reqLogID;
    }
	

}
