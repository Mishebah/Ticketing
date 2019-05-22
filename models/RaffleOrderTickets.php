<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "raffleordertickets".
 *
 * @property integer $orderTicketID
 * @property integer $clientID
 * @property integer $campaignID
 * @property integer $orderID
 * @property integer $ticketTypeID
 * @property string $ticketNo
 * @property string $ticketName
 * @property string $ticketDescription
 * @property integer $ticketQuantity
 * @property integer $ticketPrice
 * @property string $ticketNumber
 * @property string $ticketAttendeeName
 * @property string $ticketAttendeeEmail
 * @property integer $ticketAttendeeMobileNumber
 * @property integer $status
 * @property string $dateCreated
 * @property string $dateModified
 * @property integer $insertedBy
 * @property integer $updatedBy
 *
 * @property Raffleorders $order
 */
class RaffleOrderTickets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raffleordertickets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientID', 'campaignID', 'orderID', 'ticketTypeID', 'ticketQuantity', 'ticketPrice', 'ticketAttendeeMobileNumber', 'status', 'insertedBy', 'updatedBy'], 'integer'],
            [['campaignID', 'orderID', 'ticketTypeID', 'ticketNo', 'ticketName', 'ticketDescription', 'ticketPrice', 'ticketAttendeeName', 'ticketAttendeeEmail', 'ticketAttendeeMobileNumber', 'dateCreated'], 'required'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['ticketNo', 'ticketName', 'ticketDescription', 'ticketNumber', 'ticketAttendeeName', 'ticketAttendeeEmail'], 'string', 'max' => 100],
            [['orderID'], 'exist', 'skipOnError' => true, 'targetClass' => Raffleorders::className(), 'targetAttribute' => ['orderID' => 'orderID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderTicketID' => 'Order Ticket ID',
            'clientID' => 'Client ID',
            'campaignID' => 'Campaign ID',
            'orderID' => 'Order ID',
            'ticketTypeID' => 'Ticket Type ID',
            'ticketNo' => 'Ticket No',
            'ticketName' => 'Ticket Name',
            'ticketDescription' => 'Ticket Description',
            'ticketQuantity' => 'Ticket Quantity',
            'ticketPrice' => 'Ticket Price',
            'ticketNumber' => 'Ticket Number',
            'ticketAttendeeName' => 'Ticket Attendee Name',
            'ticketAttendeeEmail' => 'Ticket Attendee Email',
            'ticketAttendeeMobileNumber' => 'Ticket Attendee Mobile Number',
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
    public function getOrder()
    {
        return $this->hasOne(Raffleorders::className(), ['orderID' => 'orderID']);
    }
}
