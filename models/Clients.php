<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "clients".
 *
 * @property integer $clientID
 * @property string $clientName
 * @property string $clientDesc
 * @property string $clientLogo
 * @property string $clientCode
 * @property string $contactPersonName
 * @property string $businessPIN
 * @property string $telephoneNo
 * @property string $postalAddress
 * @property string $physicalAddress
 * @property string $emailAddress
 * @property integer $passwordExpiryAge
 * @property string $adminMode
 * @property integer $active
 * @property string $activityHistory
 * @property integer $insertedBy
 * @property string $dateCreated
 * @property integer $updatedBy
 * @property string $dateModified

 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
        }
        parent::init();
    }
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'active', 'insertedBy', 'updatedBy'], 'integer'],
            [['clientName',   'emailAddress'], 'required'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['clientName',  'postalAddress', 'physicalAddress'], 'string', 'max' => 100],
            [['emailAddress'], 'string', 'max' => 200],
            [['emailAddress'], 'unique'],
			['emailAddress', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'clientID' => Yii::t('app', 'Client ID'),
            'clientName' => Yii::t('app', 'Name'),
            'clientDesc' => Yii::t('app', 'Desc'),
            'contactPersonName' => Yii::t('app', 'Contact Person Name'),
            'postalAddress' => Yii::t('app', 'Postal Address'),
            'physicalAddress' => Yii::t('app', 'Physical Address'),
            'emailAddress' => Yii::t('app', 'Email Address'),
            'active' => Yii::t('app', 'Active'),
            'activityHistory' => Yii::t('app', 'Activity History'),
            'insertedBy' => Yii::t('app', 'Inserted By'),
            'dateCreated' => Yii::t('app', 'Date Created'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'dateModified' => Yii::t('app', 'Date Modified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApiUsers()
    {
        return $this->hasMany(ApiUsers::className(), ['clientID' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientHosts()
    {
        return $this->hasMany(ClientHosts::className(), ['clientID' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientProfiles()
    {
        return $this->hasMany(ClientProfiles::className(), ['clientID' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profiles::className(), ['profileID' => 'profileID'])->viaTable('clientProfiles', ['clientID' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientVehicleTags()
    {
        return $this->hasMany(ClientVehicleTags::className(), ['clientID' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientVisitorTags()
    {
        return $this->hasMany(ClientVisitorTags::className(), ['clientID' => 'clientID']);
    }

   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagTypes()
    {
        return $this->hasOne(TagTypes::className(), ['clientID' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTempServiceSettings()
    {
        return $this->hasMany(TempServiceSettings::className(), ['payerClientID' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['clientID' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicleLogs()
    {
        return $this->hasMany(VehicleLog::className(), ['clientID' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitorProfiles()
    {
        return $this->hasMany(VisitorProfiles::className(), ['clientID' => 'clientID']);
    }
}
