<?php

namespace app\models;

use Yii;
use yii\db\Expression;
/**
 * This is the model class for table "rPaymentSettings".
 *
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
class RPaymentSettings extends \yii\db\ActiveRecord
{
	public $mobileNumber;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rPaymentSettings';
    }
	
		   public function init()
    { 
       /// if(!$this instanceof ApplicationSearch)  
		  // if($this->hasAttribute("clientID"))
     //  $this->clientID =  isset(yii::$app->user->identity->clientID) ?yii::$app->user->identity->clientID : 0;
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
            [['campaignID'], 'required'],
            [['clientID', 'campaignID', 'updatedBy', 'insertedBy'], 'integer'],
            [['activityHistory','aPi','shortCode'], 'string'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['settingName'], 'string', 'max' => 60],
            [['serviceUrl', 'serviceKey', 'serviceSecret', 'servicePassKey'], 'string', 'max' => 200],
            [['active'], 'string', 'max' => 3],
			  [['campaignID', 'serviceUrl'],'required','on'=>['api-create','api-update']],
			  [['campaignID', 'coDEs'],'required','on'=>['code-create','code-update']],
			  [['campaignID', 'meSSage'],'required','on'=>['message_update']],
			  [['campaignID','shortCode', 'serviceKey', 'serviceSecret', 'servicePassKey'],'required','on'=>['mpesa-create','mpesa-update']],	
	  
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rSettingID' => 'R Setting ID',
            'clientID' => 'Client ID',
            'campaignID' => 'Raffle ID',
            'settingName' => 'Setting Name',
			'coDEs' => 'Competition Code',
            'settingType' => 'Setting Type',
            'serviceUrl' => 'Service Url',
			'aPi' => 'API',
			'meSSage' => 'Message',
            'serviceKey' => 'Service Key',
            'serviceSecret' => 'Service Secret',
            'servicePassKey' => 'Service Pass Key',
            'updatedBy' => 'Updated By',
            'active' => 'Active',
			'shortCode'=>'Paybill or Till Number',
            'activityHistory' => 'Activity History',
            'dateCreated' => 'Date Created',
            'dateModified' => 'Date Modified',
            'insertedBy' => 'Inserted By',
        ];
    }
}
