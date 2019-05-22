<?php
namespace App\src\Controller;
use \Interop\Container\ContainerInterface as ContainerInterface;
use PsrHttpMessageServerRequestInterface as Request;
use PsrHttpMessageResponseInterface as Response;
use \Respect\Validation\Validator as v;

/*handle all Balance Enquery
 */
class QueryStatusController
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
		$this->faibaSettings =$container->get('settings')['faiba'];
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

	
	public function QueryPaymentStatus($request, $response, $args)
	{
	//	echo "afda"
		$this->tat->start(\BenchMark::FUNCTION_LEVEL, __METHOD__);
		$this->log->infoLog(
				$this->logSettings['INFO'], -1, "** Query Status **", '','' );
		$requestData = $request->getParsedBody();
		$json = $request->getBody();
		$this->log->debugLog(
				$this->logSettings['DEBUG'], -1,
				"**request ==>"
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

		if(!isset($requestData['checkoutRequestID']))
		{
			$this->log->errorLog(
					$this->logSettings['ERROR'], -1
					,"Invalid request missing msisdn parameter", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Invalid Request "]);
			exit;	
		}
//v::Alnum('-')->noWhitespace()->NotEmpty()->validate($requestData['msisdn']) ==false) 25474726742902
		if ((v::finite()->noWhitespace()->NotEmpty()->validate($requestData['checkoutRequestID']) ==false )) 
		{
			$this->log->errorLog(
			$this->logSettings['ERROR'], -1,"Invalid request: checkoutRequestID not  valid ", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Invalid Request "]);
			exit;	                 
        }
try{	
	$query ="SELECT overallStatus,amount from checkOutRequests where requestID = ?  ";
			$params = array("i",$requestData['checkoutRequestID']);		
			$this->log->debugLog($this->logSettings['DEBUG'], -1,"FETCH TRANSACTION QUERY =>  ". \CoreUtils::formatQueryForLogging($query, $params), '', '');

			$result = \DatabaseUtilities::executeQuery($dblink->mysqli,$query, $params);

			$this->log->infoLog($this->logSettings['INFO'],$requestData['checkoutRequestID'] ," Response => ".$this->log->printArray($result), '', '');
			
		if(!$result or $result == null or $result ==false ) {
			$this->log->errorLog($this->logSettings['ERROR'], $requestData['checkoutRequestID']
					,"| missing transaction ", '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"transaction does not exist"]);
		}
		
                    $checkOutResults = $result[0];
	
			if (($checkOutResults['overallStatus']) == \StatusCodes::CLIENT_AUTHENTICATION_FAILED || ($checkOutResults['overallStatus']) ==\StatusCodes::PAYMENT_REJECTED || \StatusCodes::STATUS_UNKNOWN ){
				$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			return $response->withStatus(404)->withJson([ 'status' => false,"message"=>"Transaction in failed state" ,"checkoutRequestID"=>$requestData['checkoutRequestID']]);
							}
							else
							{
						$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
			return $response->withStatus(200)->withJson([ 'status' => true,"message"=>"Transaction successful","checkoutRequestID"=>$requestData['checkoutRequestID']]);
							}
			

			
            } catch (Exception $e) {
			$this->log->errorLog(
					$this->logSettings['ERROR'], -1
					,"Exception caught. Error message: ". $e->getMessage(), '', '');
			$this->tat->logTAT(\BenchMark::FUNCTION_LEVEL, __METHOD__);
	 return $response->withStatus(404)->withJson([ 'status' => false,"code"=>"900902","message"=>"Failed Request. Generic Error"]);	
            }
			

	}


	

}
