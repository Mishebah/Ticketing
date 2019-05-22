<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This is the PushSMS API. It is invoked by external clients who wish to 
 * channel a response through our system.
 *
 * @author amosl
 */

class PushSMS
{

//Declare variables
    private $channelResponseID;
    private $specificstatus;
    private $dbUtils;
    private $clientSMSID;
    protected $response = array('SUCCESS' => FALSE,
        'STATCODE' => 0,
        'REASON' => 'An error occured while processing the request.',
        'DATA' => array());
    private $priority = 0;  /* -- This cannot be null at the time of persisting it in the DB -- */
    private $clientSystemID = 0;   /* -- This cannot be null at the time of persisting it in the DB -- */
    private $authPayload;
    private $sourceAddress;
    private $destAddress;
    private $message;
    private $payload;
	private $noOfSMS  =1;
    /**
     * Param that indicates whether the incoming message is encrypted or false
     */
    private $encrypted;

    /**
     * Param to indicate if this request is of the retry-type, the kind 
     * of request to be retried -- e.g.VAS. 
     */
    private $retry;

    public function __construct($authPayload, $sourceAddress, $destAddress, $message, $payload,  $clientSMSID, $encrypted, $retry, $dbUtils = null)
    {
		
        $this->authPayload = $authPayload;
        $this->clientSMSID = $clientSMSID;
        $this->encrypted = $encrypted;
        $this->retry = $retry;
		$this->dbUtils = $dbUtils;
		$this->message = $message;
		$this->sourceAddress = $sourceAddress;
		$this->destAddress = $destAddress;
    }

    /**
     * This function is the entry point to this application. It checks whether 
     * the mandatory parameters are provided then invokes the function which handles 
     * the log->route->update process.
     * 
     * @return array  $response     An array of success state of the operation and a message
     */
    public function processRequest()
    {
 $starttime = microtime(true);
  
    		/* -- SET processed to 0 so daemon can pick and process it. -- */
    		/* -- Log the response -- */
    		$this->response = $this->logMessage();
    		

    	
$tat = sprintf("%.2f", microtime(true) - $starttime);
   CoreUtils::flog4php(4,  $this->clientSMSID, array('RESPONSE' => json_encode($this->response),"TAT" =>$tat), __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);

        return $this->response;
    }

   
    /**
     * This function simply inserts a record into channelResponses table.
     * 
     * @return array    An array of success state of the operation and a message.
     */
    private function logMessage()
    {
		/*use transaction mode to save in different areas 
		Log message to outMessages
		Log Message to transactionlog message to outbox table
		*/
		 $starttime = microtime(true);
		        try
        {
            $this->dbUtils->pdo->beginTransaction();
			$this->createTransaction();
		
			$this->createMessage();
			$this->createOutbound();
			$this->consumeCredit();
			
			if($this->response['SUCCESS'] ==false):
			$this->dbUtils->pdo->rollBack();
			else:
			            $this->dbUtils->pdo->commit();

			endif;
        }
        catch (PDOException $pdoe)
        {
            CoreUtils::flog4php(3, NULL, array('PDOEXCEPTION: ' => json_encode($pdoe->getMessage())), __FILE__, __FUNCTION__, __LINE__, "smsfatal", SMS_LOG_PROPERTIES);        
          if(isset($pdoe->errorInfo) && $pdoe->errorInfo[1] == 1062) : //Duplicate entry failing unique/composite key rule
                $this->response['SUCCESS'] = true;
                $this->response['STATCODE'] = 10;
                $this->response['REASON'] = 'Duplicate request already processed.';
            else :
                $this->response['REASON'] = 'An error occured while processing the request.';
				 $this->response['SUCCESS'] = false;
                $this->response['REASON'] = $pdoe->getMessage();
            endif;

          $this->dbUtils->pdo->rollBack();
        }
        catch (Exception $e)
        {
            CoreUtils::flog4php(3, NULL, array('EXCEPTION: ' => $e->getMessage()), __FILE__, __FUNCTION__, __LINE__, "smsfatal", SMS_LOG_PROPERTIES);
			 $this->dbUtils->pdo->rollBack();
        }
		
$tat = sprintf("%.2f", microtime(true) - $starttime);
       CoreUtils::flog4php(4, $this->sourceAddress."|".$this->destAddress , array('RESPONSE' => json_encode($this->response),"TAT" =>$tat), __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);

        return $this->response;
    }
	
	private function createTransaction()
	{
			//	try
			{
				$insertTransaction = "insert into transactions(source,destination,inboundSMSID,serviceID,dateCreated,transactionTypeID,insertedBy)values(?,?,?,?,now(),?,?)";
                $stmt = $this->dbUtils->pdo->prepare($insertTransaction);
               $result = $stmt->execute([$this->sourceAddress, $this->destAddress,  $this->clientSMSID, $this->authPayload['serviceID'], $this->authPayload['serviceTypeID'],$this->authPayload['apiUserID']]);
			   print_r($result );
                $this->response['DATA']['ROW_COUNT'] = $stmt->rowCount();
                CoreUtils::flog4php(4, $this->clientSMSID, array('Params'=>json_encode([$this->sourceAddress, $this->destAddress,  $this->clientSMSID, $this->authPayload['serviceID'], $this->authPayload['serviceTypeID'],$this->authPayload['apiUserID']]),'Results' => json_encode($result)), __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);	
				 if ($result) :
				 $this->response['SUCCESS'] = true;
                $this->response['STATCODE'] = 1;
                $this->response['REASON'] = 'Request processed successfully.';
            if ($this->dbUtils->pdo->lastInsertId()) :
                $this->response['DATA']['TRANSACTION_ID'] = $this->dbUtils->pdo->lastInsertId();
          			endif ;
					
				 else :
                $this->response['SUCCESS'] = false;
                $this->response['QUERY'] = preg_replace_callback('/:([0-9a-z_]+)/i', array($this, '_debugReplace'), $stmt->queryString);
                $this->response['REASON'] = json_encode($this->pdo->errorInfo());
		$this->dbUtils->pdo->rollBack();

			endif;

		$stmt->closeCursor();
       $dbh = null;
       $stmt = null;
	    }
		/*
        catch (PDOException $pdoe)
        {

            CoreUtils::flog4php(3, NULL, array('PDOEXCEPTION: ' => $pdoe->getMessage()), __FILE__, __FUNCTION__, __LINE__, "smsfatal", SMS_LOG_PROPERTIES);        
          if(isset($pdoe->errorInfo) && $pdoe->errorInfo[1] == 1062) : //Duplicate entry failing unique/composite key rule
                $this->response['SUCCESS'] = true;
                $this->response['STATCODE'] = 10;
                $this->response['REASON'] = 'Duplicate request already processed.';
            else :
                $this->response['REASON'] = 'An error occured while processing the request.';
				 $this->response['SUCCESS'] = false;
                $this->response['REASON'] = $pdoe->getMessage();
            endif;

           $this->dbUtils->pdo->rollBack();
        }
        catch (Exception $e)
        {
            CoreUtils::flog4php(3, NULL, array('EXCEPTION: ' => $e->getMessage()), __FILE__, __FUNCTION__, __LINE__, "smsfatal", SMS_LOG_PROPERTIES);
			 $this->dbUtils->pdo->rollBack();
        }
		*/
				 
	}
	private function createMessage()
	{
		if($this->response['SUCCESS'] ==true):
		$insertMessage = "insert into outMessages(messageContent,msgLength,msgPages,dateCreated)value(?,?,?,now())";
	     $this->message = stripslashes($this->message);
            $messageLength = strlen($this->message);
            //no of sms
            $smsToGo = str_split($this->message, 160);
            $this->noOfSMS = count($smsToGo);
			/*We now save on outmessage now */
			  $stmt = $this->dbUtils->pdo->prepare($insertMessage);
               $result = $stmt->execute([$this->message, $messageLength,  $this->noOfSMS]);
                $this->response['DATA']['ROW_COUNT'] = $stmt->rowCount();
                CoreUtils::flog4php(4, $this->clientSMSID, array('Params'=>json_encode([$this->message, $messageLength,  $this->noOfSMS]),'Results' => json_encode($result)), __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);	
				 if ($result) :
				 $this->response['SUCCESS'] = true;
                $this->response['STATCODE'] = 1;
                $this->response['REASON'] = 'Request processed successfully.';
            if ($this->dbUtils->pdo->lastInsertId()) :
                           $this->response['DATA']['MESSAGE_ID'] = $this->dbUtils->pdo->lastInsertId();
           endif ;
			
				 else :
                $this->response['SUCCESS'] = false;
                $this->response['REASON'] = json_encode($this->dbUtils->pdo->errorInfo());
		$this->dbUtils->pdo->rollBack();
			endif;

		$stmt->closeCursor();
       $dbh = null;
       $stmt = null;
	   endif;
				 
	}
	private function consumeCredit()
	{
		if($this->response['SUCCESS'] ==true):
	$consumeCredit = "insert into creditConsumption(clientID,consumedBy,transactionID,creditsConsumed,creditStatusID,dateConsumed,updatedBy)values(?,?,?,?,1,now(),1)";

                $stmt = $this->dbUtils->pdo->prepare($consumeCredit);
               $result = $stmt->execute([$this->authPayload['clientID'],$this->authPayload['apiUserID'], $this->response['DATA']['TRANSACTION_ID'],$this->noOfSMS]);
                $this->response['DATA']['ROW_COUNT'] = $stmt->rowCount();
                CoreUtils::flog4php(4, $this->clientSMSID, array('Params'=>json_encode([$this->authPayload['apiUserID'], $this->response['DATA']['TRANSACTION_ID'],$this->noOfSMS]),'Results' => json_encode($result)), __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);	

				 if ($result) :
				 $this->response['SUCCESS'] = true;
                $this->response['STATCODE'] = 1;
                $this->response['REASON'] = 'Request processed successfully.';
				 else :
                $this->response['SUCCESS'] = false;
                $this->response['QUERY'] = preg_replace_callback('/:([0-9a-z_]+)/i', array($this, '_debugReplace'), $stmt->queryString);
                $this->response['REASON'] = json_encode($this->dbUtils->pdo->errorInfo());

		$this->dbUtils->pdo->rollBack();
			endif;
		$stmt->closeCursor();
       $dbh = null;
       $stmt = null;
		endif;		 
	}
	private function createOutbound()
	{
		if($this->response['SUCCESS'] ==true):
	$insertOutbound = "insert into outbound(transactionID,messageID,firstSend,lastSend,nextSend,sourceAddress,msisdn,resend,statusCode,gatewayUUID,dateCreated,updatedBy,accessCode,serviceID,priority) values(?,?,null,null,now(),?,?,?,0,0,now(),?,?,?,1)";
                $stmt = $this->dbUtils->pdo->prepare($insertOutbound);
				
               $result = $stmt->execute([$this->response['DATA']['TRANSACTION_ID'],$this->response['DATA']['MESSAGE_ID'],$this->sourceAddress,$this->destAddress,$this->retry,$this->authPayload['apiUserID'],$this->authPayload['accessCode'],$this->authPayload['sdpServiceID']]);
                $this->response['DATA']['ROW_COUNT'] = $stmt->rowCount();
	                CoreUtils::flog4php(4, $this->clientSMSID, array('Params'=>json_encode([$this->response['DATA']['TRANSACTION_ID'],$this->response['DATA']['MESSAGE_ID'],$this->sourceAddress,$this->destAddress,$this->retry,$this->authPayload['apiUserID']]),'Results' => json_encode($result)), __FILE__, __FUNCTION__, __LINE__, "smsinfo", SMS_LOG_PROPERTIES);	


				 if ($result) :
				 $this->response['SUCCESS'] = true;
                $this->response['STATCODE'] = 1;
                $this->response['REASON'] = 'Request processed successfully.';
                $this->response['DATA']['REFERENCEID'] = $this->dbUtils->pdo->lastInsertId();
								 else :
                $this->response['SUCCESS'] = false;
                $this->response['REASON'] = json_encode($this->dbUtils->pdo->errorInfo());
		$this->dbUtils->pdo->rollBack();
			endif;
		$stmt->closeCursor();
       $dbh = null;
       $stmt = null;
		endif;	
		
	}
  

}

?>
