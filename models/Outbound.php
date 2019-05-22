<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outbound".
 *
 * @property string $outboundID
 * @property string $transactionID
 * @property string $messageID
 * @property string $gatewayUUID
 * @property string $sourceAddress
 * @property string $MSISDN
 * @property string $lastSend
 * @property string $firstSend
 * @property string $priority
 * @property string $nextSend
 * @property string $expiryDate
 * @property int $numberOfSends
 * @property int $delivered
 * @property int $statusCode
 * @property string $deliveryTime
 * @property int $resend
 * @property int $resendFrequency
 * @property int $maxSends
 * @property string $dateCreated
 * @property string $updatedBy
 * @property string $dateModified
 *
 * @property OutMessages $message
 * @property Transactions $transaction
 */
class Outbound extends \yii\db\ActiveRecord
{
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outbound';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transactionID', 'messageID','resend', 'gatewayUUID', 'MSISDN', 'priority', 'numberOfSends', 'statusCode', 'resendFrequency', 'maxSends', 'updatedBy'], 'integer'],
            [['sourceAddress', 'MSISDN', 'accessCode','statusCode', 'dateCreated', 'updatedBy'], 'required'],
            [['lastSend', 'firstSend', 'nextSend', 'expiryDate', 'deliveryTime', 'dateCreated', 'dateModified'], 'safe'],
            [['sourceAddress'], 'string', 'max' => 13],
            [['messageID'], 'exist', 'skipOnError' => true, 'targetClass' => OutMessages::className(), 'targetAttribute' => ['messageID' => 'messageID']],
            [['transactionID'], 'exist', 'skipOnError' => true, 'targetClass' => Transactions::className(), 'targetAttribute' => ['transactionID' => 'transactionID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'outboundID' => 'Outbound ID',
            'transactionID' => 'Transaction ID',
            'messageID' => 'Message ID',
            'gatewayUUID' => 'Gateway Uuid',
            'sourceAddress' => 'Source Address',
            'MSISDN' => 'Msisdn',
            'lastSend' => 'Last Send',
            'firstSend' => 'First Send',
            'priority' => 'Priority',
            'nextSend' => 'Next Send',
            'expiryDate' => 'Expiry Date',
            'numberOfSends' => 'Number Of Sends',
            'delivered' => 'Delivered',
            'statusCode' => 'Status Code',
            'deliveryTime' => 'Delivery Time',
            'resend' => 'Resend',
            'resendFrequency' => 'Resend Frequency',
            'maxSends' => 'Max Sends',
            'dateCreated' => 'Date Created',
            'updatedBy' => 'Updated By',
            'dateModified' => 'Date Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(OutMessages::className(), ['messageID' => 'messageID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaction()
    {
        return $this->hasOne(Transactions::className(), ['transactionID' => 'transactionID']);
    }
}
