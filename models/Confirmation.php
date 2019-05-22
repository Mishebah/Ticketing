<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "confirmation".
 *
 * @property integer $requestsID
 * @property integer $clientID
 * @property integer $campaignID
 * @property string $settingName
 * @property integer $settingType
 * @property string $shortCode
 * @property string $messageContent
 * @property string $serviceUrl
 * @property integer $updatedBy
 * @property integer $active
 * @property string $dateCreated
 * @property string $dateModified
 * @property integer $insertedBy
 */
class Confirmation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'confirmation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['requestsID','shortCode','clientID', 'campaignID','campaignID'], 'integer'],
            [['messageContent',], 'string'],
            [['updatedBy', 'insertedBy',],'safe'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['settingName'], 'string', 'max' => 60],
            ['serviceUrl', 'url'],
            [['active'], 'string', 'max' => 3],
			  [['serviceUrl'],'required','on'=>['webhook-create','webhook-update']], 
			[['messageContent','shortCode'],'required','on'=>['request-code','code-update']],	
	  
         ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'requestsID' => 'Requests ID',
            'clientID' => 'Client ID',
            'campaignID' => 'Campaign ID',
            'settingName' => 'Setting Name',
            'settingType' => 'Setting Type',
            'shortCode' => 'Short Code',
            'messageContent' => 'Message Content',
            'serviceUrl' => 'Service Url',
            'updatedBy' => 'Updated By',
            'active' => 'Active',
            'dateCreated' => 'Date Created',
            'dateModified' => 'Date Modified',
            'insertedBy' => 'Inserted By','settingName' => 'Setting Name',
            'settingType' => 'Setting Type',
            'shortCode' => 'Short Code',
            'messageContent' => 'Message Content',
            'serviceUrl' => 'Service Url',
            'updatedBy' => 'Updated By',
            'active' => 'Active',
            'dateCreated' => 'Date Created',
            'dateModified' => 'Date Modified',
            'insertedBy' => 'Inserted By',
        ];
    }
}
