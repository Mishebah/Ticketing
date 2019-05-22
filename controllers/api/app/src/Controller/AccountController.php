<?php
namespace App\src\Controller;
use \Interop\Container\ContainerInterface as ContainerInterface;
use PsrHttpMessageServerRequestInterface as Request;
use PsrHttpMessageResponseInterface as Response;
use \Respect\Validation\Validator as v;

/*handle all Balance Enquery
 */
class AccountController
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
		$this->minAmount =$container->get('settings')['MIN_AMOUNT'];
		$this->maxAmount =  $container->get('settings')['MAX_AMOUNT'];
		
		$this->tat = new \BenchMark(session_id(),$this->logSettings);
	}
	public function __get($property)
	{
		if ($this->container->{$property}) {
			return $this->container->{$property};
		}
	}

		public function purchaseAirtime($request, $response, $args)
	{

		$this->tat->start(\BenchMark::FUNCTION_LEVEL, __METHOD__);
		$this->log->infoLog(
				$this->logSettings['INFO'], -1, "** Purchase Airtime **", '','' );
		$paymentPayload = $request->getParsedBody();
		$json = $request->getBody();
		$this->log->debugLog(
				$this->logSettings['DEBUG'], -1,
				"**Get Airtime request ==>"
				.$json."***",' ','' );

		if(!is_array($paymentPayload) or $paymentPayload ==null)
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
			
if ($dblink->mysqli->connect_errno) {
	$this->log->errorLog($this->logSettings['ERROR'], -1,"Unable to get database Connection".$dblink->mysqli->connect_errno, '', '');
				return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Cancelled"]);

 }
 

		}
		catch(Exception $e)
		{
			//$response->setStatus(404);
			$this->log->errorLog($this->logSettings['ERROR'], -1,"Unable to get database Connection".$e->getMessage(), '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			//write to file as well on the failed transactions. 
			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Cancelled"]);
		}
		if(!isset($paymentPayload['msisdn']))
		{
			$this->log->errorLog(
					$this->logSettings['ERROR'], -1
					,"Invalid request missing msisdn parameter", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Invalid Request - missing msisdn "]);
			exit;	
		}
//v::Alnum('-')->noWhitespace()->NotEmpty()->validate($paymentPayload['msisdn']) ==false) 25474726742902
		if ((v::finite()->noWhitespace()->NotEmpty()->between(254747000000,254747999999)->validate($paymentPayload['msisdn']) ==false )) 
		{
			$this->log->errorLog(
			$this->logSettings['ERROR'], -1,"Invalid request: msisdn not  valid JTL Line", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Invalid Request - msisdn not a valid JTL number "]);
			exit;	                 
        }
				if(!isset($paymentPayload['payerNumber']))
		{
			$this->log->errorLog(
					$this->logSettings['ERROR'], -1
					,"Invalid request missing payerNumber parameter", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Invalid Request - payerNumber "]);
			exit;	
		}
//v::Alnum('-')->noWhitespace()->NotEmpty()->validate($paymentPayload['msisdn']) ==false) 25474726742902
		if ((v::finite()->noWhitespace()->NotEmpty()->between(254700000000,254799999999)->validate($paymentPayload['payerNumber']) ==false )) 
		{
			$this->log->errorLog(
			$this->logSettings['ERROR'], -1,"Invalid request: payerNumber not  valid Faiba Line", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Invalid Request - payerNumber not a valid Faiba number "]);
			exit;	                 
        }
		
						if(!isset($paymentPayload['amount']))
		{
			$this->log->errorLog(
					$this->logSettings['ERROR'], -1
					,"Invalid request missing amount parameter", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Invalid Request - amount "]);
			exit;	
		}
	
//v::Alnum('-')->noWhitespace()->NotEmpty()->validate($paymentPayload['msisdn']) ==false) 25474726742902
		if ((v::finite()->noWhitespace()->NotEmpty()->between($this->minAmount,$this->maxAmount)->validate($paymentPayload['amount']) ==false )) 
		{
			$this->log->errorLog(
			$this->logSettings['ERROR'], -1,"Invalid request: payerNumber not  valid Faiba Line", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
	return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Invalid Request - amount not a valid. Amount Limit {$this->minAmount}  - {$this->maxAmount} "]);
			exit;	                 
        }
       
		
try{	

    $requestID =  $this->insertRequestLog($dblink->mysqli,$paymentPayload);
		if($requestID == null or $requestID ==-1)
		{
			return $response->withStatus(404)->withJson([ 'status' => false,"code"=>"900902","message"=>"Failed Request. Generic Error. Try again"]);	
			 exit;
		}
	//do an mPesa Push here

	$token = \MpesaPushUtility::getMpesaAccessToken($this->mpesaSettings,$this->log, $this->logSettings);
	 
if(empty($token) or !array_key_exists("access_token",$token) or is_null($token) ):

				$this->log->errorLog(
			$this->logSettings['ERROR'], -1,"** Token not generated respond back with a failed message  **", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			$updateReqSql = "UPDATE checkOutRequests set overallStatus = ?, paymentPushtransactionID ='' , narration = 'Invalid Credentials ',paymentDate = now() WHERE requestID = ?";
		$updateReqParams = array(
				"ii",
				\StatusCodes::CLIENT_AUTHENTICATION_FAILED,
				$requestID
				);
		$this->log->debugLog($this->logSettings['DEBUG'],$requestID,"UPDATE TRANSACTION QUERY =>  ". \CoreUtils::formatQueryForLogging($updateReqSql, $updateReqParams), '', '');
		//Update the overallStatus.	
		$update = \DatabaseUtilities::update($dblink->mysqli, $updateReqSql, $updateReqParams); 				   
		$this->log->infoLog($this->logSettings['INFO'], $requestID ," Update Status  ".$update, '', '');
		\DatabaseUtilities::commit($dblink->mysqli);
			return $response->withStatus(404)->withJson([ 'status' => false,"checkoutRequestID"=>$requestID,"message"=>"Invalid Request - try again "]);
			exit;
			
		//WE ROLE BACK THE TRANSACTION
              //  DatabaseUtilities::rollback($dblink->mysqli);

else:

  $timestamp = date("YmdHis");
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $this->mpesaSettings['MPESA_STK_URL']);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$token['access_token'])); //setting custom header
$curl_post_data =[
  //Fill in the request parameters with valid values
  'BusinessShortCode' => $this->mpesaSettings['MPESA_PAYBILL'],
  'Password' =>base64_encode($this->mpesaSettings['PASS_KEY'].$timestamp),
  'Timestamp' =>$timestamp,
  'TransactionType' => 'CustomerPayBillOnline',
  'Amount' => $paymentPayload['amount'],
  'PartyA' => $paymentPayload['payerNumber'],
  'PartyB' =>  $this->mpesaSettings['MPESA_PAYBILL'],
  'PhoneNumber' => $paymentPayload['payerNumber'],
  'CallBackURL' => $this->mpesaSettings['MPESA_CALLBACK_URL'],
  'AccountReference' => "Airtime-".$paymentPayload['msisdn'],
  'TransactionDesc' => $this->mpesaSettings['MPESA_PAYBILL']."_".$requestID
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
		$this->log->debugLog($this->logSettings['DEBUG'], -1, "** mPesaCheckout payload {$data_string} |RESPONSE  {".$curl_response."} **", '','' );
$results = json_decode($curl_response,true);

 if (curl_errno($curl) != 0) :
	$this->log->errorLog($this->logSettings['ERROR'], -1,"**mPesaCheckout|  Error | *".curl_error($curl), '', '');
curl_close($curl);
 return $response->withStatus(404)->withJson([ 'status' => false,"code"=>"900901","checkoutRequestID"=>$requestID,"message"=>"Failed Request. Error on request try again"]);
	exit;	
             else:
		curl_close($curl);	 

	if(isset($results['fault']))
{
 return $response->withStatus(404)->withJson([ 'status' => false,"code"=>"900901","checkoutRequestID"=>$requestID,"message"=>"Failed Request. Invalid Credentials - try again"]);
	exit;	
}
	if(isset($results['errorCode'])):

	$this->log->infoLog($this->logSettings['INFO'], -1,"**mPesaCheckout|  Error | Request *".json_encode($results), '', '');		
	$updateReqSql = "UPDATE checkOutRequests set overallStatus = ?, paymentPushtransactionID =? , narration = ?,paymentDate = now() WHERE requestID = ?";
		$updateReqParams = array(
				"issi",
				\StatusCodes::PAYMENT_REJECTED,
				$results['requestId'],
				$results['errorMessage'],
				$requestID
				);
		$this->log->debugLog($this->logSettings['DEBUG'],$requestID,"UPDATE TRANSACTION QUERY =>  ". \CoreUtils::formatQueryForLogging($updateReqSql, $updateReqParams), '', '');
		//Update the overallStatus.	
		$update = \DatabaseUtilities::update($dblink->mysqli, $updateReqSql, $updateReqParams); 				   
		$this->log->infoLog($this->logSettings['INFO'], $requestID ," Update Status  ".$update, '', '');
		\DatabaseUtilities::commit($dblink->mysqli);
 return $response->withStatus(404)->withJson([ 'status' => false,"code"=>"900901","checkoutRequestID"=>$requestID,"message"=>"Failed Request. Timeout - try again"]);
	exit;	
	
elseif(isset($results['ResponseCode'])):
	
		$this->log->infoLog($this->logSettings['INFO'], -1,"**mPesaCheckout|  success | Request *".json_encode($results), '', '');		
	$updateReqSql = "UPDATE checkOutRequests set overallStatus = ?, paymentPushtransactionID =? , narration = ?,paymentDate = now() WHERE requestID = ?";
		$updateReqParams = array(
				"issi",
				\StatusCodes::PAYMENT_PUSHED_STATUS,
				$results['MerchantRequestID'],
				$results['ResponseDescription'],
				$requestID
				);
		$this->log->debugLog($this->logSettings['DEBUG'],$requestID,"UPDATE TRANSACTION QUERY =>  ". \CoreUtils::formatQueryForLogging($updateReqSql, $updateReqParams), '', '');
		//Update the overallStatus.	
		$update = \DatabaseUtilities::update($dblink->mysqli, $updateReqSql, $updateReqParams); 				   
		$this->log->infoLog($this->logSettings['INFO'], $requestID ," Update Status  ".$update, '', '');
		\DatabaseUtilities::commit($dblink->mysqli);
				return $response->withStatus(200)->withJson([ 'status' => true,"code"=>"200","message"=>"Accepted Successfully. Awaiting Client ACK","checkoutRequestID"=>$requestID]);	
	exit;
else:
		$this->log->infoLog($this->logSettings['INFO'], -1,"**mPesaCheckout|  Error | Request *".json_encode($results), '', '');		
	$updateReqSql = "UPDATE checkOutRequests set overallStatus = ?, paymentPushtransactionID ='' , narration = '',paymentDate = now() WHERE requestID = ?";
		$updateReqParams = array(
				"ii",
				\StatusCodes::STATUS_UNKNOWN,
				$requestID
				);
		$this->log->debugLog($this->logSettings['DEBUG'],$requestID,"UPDATE TRANSACTION QUERY =>  ". \CoreUtils::formatQueryForLogging($updateReqSql, $updateReqParams), '', '');
		//Update the overallStatus.	
		$update = \DatabaseUtilities::update($dblink->mysqli, $updateReqSql, $updateReqParams); 				   
		$this->log->infoLog($this->logSettings['INFO'], $requestID ," Update Status  ".$update, '', '');
		\DatabaseUtilities::commit($dblink->mysqli);
				return $response->withStatus(410)->withJson([ 'status' => false,"code"=>"900902","message"=>"Failed Request. Invalid Request","checkoutRequestID"=>$requestID]);	
	
endif;
	endif;		
endif;		



} catch (Exception $e)
 {
			$this->log->errorLog(
					$this->logSettings['ERROR'], -1
					,"Exception caught. Error message: ". $e->getMessage(), '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
	 return $response->withStatus(404)->withJson([ 'status' => false,"code"=>"900902","message"=>"Failed Request. Generic Error"]);	
            }
			

	}

    private function insertRequestLog($mysqli,$paymentPayload)
	{
        $this->tat->start(\BenchMark::FUNCTION_LEVEL, __METHOD__);
		$this->log->infoLog($this->logSettings['INFO'], -1 ," New Purchase Airtime Request => ".$this->log->printArray($paymentPayload), '', '');
				
          try {
        // Insert into s_requestLogs
      $insRLQuery = "INSERT INTO  checkOutRequests (paymentID,paymentPushtransactionID,payerNumber,MSISDN, amount,overallStatus,dateCreated, insertedBy, updatedBy) "
					. "VALUES (0, '',?, ?, ?, 178 , NOW(),1, 1)";

        $rparams = array(
            "sii",
			$paymentPayload['payerNumber'],
            $paymentPayload['msisdn'],
            $paymentPayload['amount']
        );
		$this->log->debugLog($this->logSettings['DEBUG'],-1,"TRANSACTION QUERY =>  ". \CoreUtils::formatQueryForLogging($insRLQuery, $rparams), '', '');

		\DatabaseUtilities::executeQuery($mysqli, $insRLQuery, $rparams);
	$reqLogID = \DatabaseUtilities::getInsertId($mysqli);
	\DatabaseUtilities::commit($mysqli);
	
        $this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);

        return $reqLogID;
		 } catch (SQLException $e) {
            DatabaseUtilities::rollback($mysqli);
		$reqLogID =-1;
		$this->log->errorLog($this->logSettings['ERROR'], -1," Error Saving transaction ".$e->getMessage(), '', '');
		$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
		
        }catch (SQLException $e) {
            DatabaseUtilities::rollback($mysqli);
		$reqLogID =-1;
		$this->log->errorLog($this->logSettings['ERROR'], -1," Error Saving transaction ".$e->getMessage(), '', '');
		$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
        }
		  return $reqLogID;
    }
	





}
