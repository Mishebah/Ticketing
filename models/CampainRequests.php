<?php

namespace app\models;

use Yii;
use yii\db\Expression;
/**
 
 * @property string $rSettingID
 * @property string $clientID
 * @property string $campaignID
 * @property string $settingName
 * @property integer $settingType
 * @property string $serviceUrl
 * @property string $serviceKey
  * @property string $shortCode
 * @property string $serviceSecret
 * @property string $servicePassKey
 * @property string $updatedBy
 * @property integer $active
 * @property string $activityHistory
 * @property string $dateCreated
 * @property string $dateModified
 * @property string $insertedBy
 */
class CampainRequests extends \yii\db\ActiveRecord
{
  public $mobileNumber;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campainrequests';
    }
  
       public function init()
    { 
     
        if(!$this instanceof ClientsSearch) 
        {
      $this->insertedBy=  isset(yii::$app->user->identity->userID) ? yii::$app->user->identity->userID: 0;
      $this->updatedBy=  isset(yii::$app->user->identity->userID)? yii::$app->user->identity->userID:  0;
     $this->dateCreated =  new Expression('NOW()');
   $this->clientID =  yii::$app->user->identity->clientID;
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payBill', 'messageContent'], 'required'],
            [['payBill','clientID', 'campaignID', 'updatedBy', 'insertedBy'], 'integer'],
            [['messageContent'], 'string'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['settingName'], 'string', 'max' => 60],
        [['payBill','messageContent'],'required','on'=>['paybill-create','paybill-update']],  
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'requestsID' => 'Request ID',
            'clientID' => 'Client ID',
            'campaignID' => 'Raffle ID',
            'settingName' => 'Setting Name',
            'settingType' => 'Setting Type',
            'messageContent'=> 'Message',
            'updatedBy' => 'Updated By',
            'paybill'=>'Paybill or Till Number',
            'dateCreated' => 'Date Created',
            'dateModified' => 'Date Modified',
            'insertedBy' => 'Inserted By',
        ];
    }

}
