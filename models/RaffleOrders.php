<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "raffleorders".
 *
 * @property integer $orderID
 * @property integer $clientID
 * @property string $orderNo
 * @property integer $campaignID
 * @property string $payerName
 * @property double $amountPaid
 * @property integer $MSISDN
 * @property integer $paymentID
 * @property string $attendeeName
 * @property string $attendeeEmail
 * @property integer $attendeeMobileNumber
 * @property integer $orderQuantity
 * @property double $orderAmount
 * @property integer $status
 * @property string $dateCreated
 * @property string $dateModified
 * @property integer $insertedBy
 * @property integer $updatedBy
 *
 * @property Campaign $campaign
 * @property Clients $client
 */
class Raffleorders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raffleorders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientID','campaignID', 'MSISDN', 'paymentID', 'attendeeMobileNumber', 'orderQuantity', 'status', 'insertedBy', 'updatedBy'], 'integer'],
            [['orderNo', 'campaignID', 'amountPaid', 'MSISDN', 'attendeeName', 'attendeeEmail', 'attendeeMobileNumber', 'orderQuantity', 'orderAmount', 'dateCreated'], 'required'],
            [['amountPaid', 'orderAmount'], 'number'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['orderNo', 'payerName', 'attendeeName', 'attendeeEmail'], 'string', 'max' => 100],
            [['orderNo'], 'unique'],
            [['campaignID'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::className(), 'targetAttribute' => ['campaignID' => 'campaignID']],
            [['clientID'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['clientID' => 'clientID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderID' => 'Order ID',
            'clientID' => 'Client ID',
            'orderNo' => 'Order No',
            'campaignID' => 'Campaign ID',
            'payerName' => 'Payer Name',
            'amountPaid' => 'Amount Paid',
            'MSISDN' => 'Phone Number',
            'paymentID' => 'Payment ID',
            'attendeeName' => 'Attendee Name',
            'attendeeEmail' => 'Attendee Email',
            'attendeeMobileNumber' => 'Attendee Mobile Number',
            'orderQuantity' => 'Order Quantity',
            'orderAmount' => 'Order Amount',
            'status' => 'Status',
            'dateCreated' => 'Date Created',
            'dateModified' => 'Date Modified',
            'insertedBy' => 'Inserted By',
            'updatedBy' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaign()
    {
        return $this->hasOne(Campaign::className(), ['campaignID' => 'campaignID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['clientID' => 'clientID']);
    }

    public function getRaffleorderTickets()
    {
        return $this->hasMany(RaffleorderTickets::className(), ['orderID' => 'orderID']);
    }
    
}
