<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campaign".
 *
 * @property integer $campaignID
 * @property string $campaignName
 * @property string $description
 * @property string $uuid
 * @property integer $campaignType
 * @property integer $clientID
 * @property string $startDate
 * @property string $endDate
 * @property integer $status
 * @property integer $entries
 * @property integer $creditsUsed
 * @property integer $insertedBy
 * @property string $dateCreated
 * @property integer $updatedBy
 * @property string $dateModified
 *
 * @property Clients $client
 * @property Users $insertedBy0
 * @property Ccodes[] $ccodes
 * @property Cdraws[] $cdraws
 * @property Centries[] $centries
 * @property Csettings[] $csettings
 * @property Raffleorders[] $raffleorders
 */
class  Campaign extends MainModel
{
   public $cImage;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campaign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campaignName', 'cImage','endDate',  'startDate'], 'required'],
            [['description', 'campaignImage'], 'string'],
            [['cImage'],'file','checkExtensionByMimeType' => false, 'extensions' => 'png, jpg'],
            [['campaignType','clientID', 'entries', 'creditsUsed', 'insertedBy', 'updatedBy'], 'integer'],
            [['startDate', 'endDate', 'dateCreated', 'dateModified'], 'safe'],
            [['campaignName'], 'string', 'max' => 100],
            [['uuid'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 3],
            [['clientID'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['clientID' => 'clientID']],
            [['insertedBy'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['insertedBy' => 'userID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'campaignID' => 'Campaign ID',
            'campaignName' => 'Campaign Name',
            'description' => 'Description',
            'uuid' => 'Uuid',
            'cImage' => 'Descriptive Image',
            'campaignType' => 'Campaign Type',
            'clientID' => 'Client ID',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
            'status' => 'Status',
            'entries' => 'Entries',
            'creditsUsed' => 'Credits Used',
            'insertedBy' => 'Inserted By',
            'dateCreated' => 'Date Created',
            'updatedBy' => 'Updated By',
            'dateModified' => 'Date Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['clientID' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsertedBy0()
    {
        return $this->hasOne(Users::className(), ['userID' => 'insertedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCCodes()
    {
        return $this->hasMany(CCodes::className(), ['campaignID' => 'campaignID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCDraws()
    {
        return $this->hasMany(CDraws::className(), ['campaignID' => 'campaignID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCEntries()
    {
        return $this->hasMany(CEntries::className(), ['campaignID' => 'campaignID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCSettings()
    {
        return $this->hasMany(CSettings::className(), ['campaignID' => 'campaignID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaffleorders()
    {
        return $this->hasMany(Raffleorders::className(), ['campaignID' => 'campaignID']);
    }
}
