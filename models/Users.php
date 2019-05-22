<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "users".
 *
 * @property integer $userID
 * @property integer $clientID
 * @property string $fullNames
 * @property string $emailAddress
 * @property string $IDNumber
 * @property integer $MSISDN
 * @property string $password
 * @property integer $passwordAttempts
 * @property integer $passwordStatusID
 * @property string $datePasswordChanged
 * @property integer $active
 * @property string $dateActivated
 * @property string $dateCreated
 * @property string $dateModified
 * @property integer $updatedBy
 * @property integer $createdBy
 *
 * @property ApiUsers[] $apiUsers
 * @property UserClusterMappings[] $userClusterMappings
 * @property UserGroups[] $userGroups
 * @property Groups[] $groups
 * @property UserLogs[] $userLogs
 * @property Clients $client
 * @property PasswordStatuses $passwordStatus
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 	  public function init()
    { 
       /// if(!$this instanceof ApplicationSearch)  
		  // if($this->hasAttribute("clientID"))
      // $this->clientID =  yii::$app->user->identity->clientID ;
        if(!$this instanceof UsersSearch) 
        {
      $this->createdBy= yii::$app->user->identity->userID;
      $this->updatedBy= yii::$app->user->identity->userID;
     $this->dateCreated = new Expression('NOW()');
        }
        parent::init();
    }
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientID', 'MSISDN', 'emailAddress'], 'required'],
            [['clientID', 'MSISDN', 'passwordAttempts', 'passwordStatusID',  'updatedBy', 'createdBy'], 'integer'],
            [['datePasswordChanged', 'dateActivated', 'dateCreated', 'dateModified'], 'safe'],
            [['fullNames', 'emailAddress'], 'string', 'max' => 120],
            [['IDNumber'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 150],
            [['emailAddress'], 'unique'],
			['emailAddress', 'email'],
            [['clientID'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['clientID' => 'clientID']],
            [['passwordStatusID'], 'exist', 'skipOnError' => true, 'targetClass' => PasswordStatuses::className(), 'targetAttribute' => ['passwordStatusID' => 'passwordStatusID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userID' => Yii::t('app', 'User ID'),
            'clientID' => Yii::t('app', 'Client ID'),
            'fullNames' => Yii::t('app', 'Full Names'),
            'emailAddress' => Yii::t('app', 'Email Address'),
            'IDNumber' => Yii::t('app', 'ID Number'),
            'MSISDN' => Yii::t('app', 'Telephone Number'),
            'password' => Yii::t('app', 'Password'),
            'passwordAttempts' => Yii::t('app', 'Password Attempts'),
            'passwordStatusID' => Yii::t('app', 'Password Status ID'),
            'datePasswordChanged' => Yii::t('app', 'Date Password Changed'),
            'dateActivated' => Yii::t('app', 'Date Activated'),
            'dateCreated' => Yii::t('app', 'Date Created'),
            'dateModified' => Yii::t('app', 'Date Modified'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'createdBy' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApiUsers()
    {
        return $this->hasMany(ApiUsers::className(), ['userID' => 'userID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserClusterMappings()
    {
        return $this->hasMany(UserClusterMappings::className(), ['userID' => 'userID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGroups()
    {
        return $this->hasMany(UserGroups::className(), ['userID' => 'userID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasOne(Groups::className(), ['groupID' => 'groupID'])->viaTable('userGroups', ['userID' => 'userID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLogs()
    {
        return $this->hasMany(UserLogs::className(), ['userID' => 'userID']);
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
    public function getPasswordStatus()
    {
        return $this->hasOne(PasswordStatuses::className(), ['passwordStatusID' => 'passwordStatusID']);
    }
}
