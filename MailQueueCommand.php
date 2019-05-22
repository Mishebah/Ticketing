<?php

/**
 * Sends out emails based on the retrieved EmailQueue objects. 
 */
class MailQueueCommand extends CConsoleCommand
{
 
    public function run($args)
    {
        $criteria = new CDbCriteria(array(
                'condition' => 'processed=:processed AND numberOfSends < maxSends',
                'params' => array(
                    ':processed' => 0,
                ),
            ));
 
        $queueList = EmailQueue::model()->findAll($criteria);
 
        /* @var $queueItem EmailQueue */
        foreach ($queueList as $queueItem)
        {
            $message = new YiiMailMessage();
            $message->setTo($queueItem->emailTo);
            $message->setFrom(array($queueItem->fromEmail => $queueItem->fromName));
            $message->setSubject($queueItem->subject);
            $message->setBody($queueItem->message, 'text/html');
 
            if ($this->sendEmail($message))
            {
                $queueItem->numberOfSends = $queueItem->numberOfSends + 1;
                $queueItem->processed = 1;
                $queueItem->lastSend = new CDbExpression('NOW()');
 
                $queueItem->save();
            }
            else
            {
                $queueItem->numberOfSends = $queueItem->numberOfSends + 1;
                $queueItem->lastSend = new CDbExpression('NOW()');
 
                $queueItem->save();
            }
        }
    }
 
    /**
        * Sends an email to the user.
        * This methods expects a complete message that includes to, from, subject, and body
        *
        * @param YiiMailMessage $message the message to be sent to the user
        * @return boolean returns true if the message was sent processedfully or false if unprocessedful
        */
    private function sendEmail(YiiMailMessage $message)
    {
        $sendStatus = false;
 
        if (Yii::app()->mail->send($message) > 0)
            $sendStatus = true;
 
        return $sendStatus;
    }
 
}
?>
