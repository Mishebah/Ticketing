<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ccodes".
 *
 * @property integer $codeID
 * @property integer $campaignID
 * @property integer $clientID
 * @property string $settingName
 * @property integer $type
 * @property integer $cCount
 * @property string $rule
 * @property string $originalFileName
 * @property string $generatedFileName
 * @property integer $cLength
 * @property integer $cHasUpperCase
 * @property integer $cHasLowerCase
 * @property integer $cHasDigits
 * @property string $cPrefix
 * @property string $cSuffix
 * @property string $startDate
 * @property string $endDate
 * @property integer $insertedBy
 * @property string $dateCreated
 * @property integer $status
 * @property integer $updatedBy
 * @property string $dateModified
 *
 * @property Ccodeentries[] $ccodeentries
 * @property Campaign $campaign
 * @property Users $insertedBy0
 * @property Users $updatedBy0
 */
class CCodes extends \yii\db\ActiveRecord
{
     public $codeupload;
     public $singleCode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ccodes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          
             [['codeupload'],'file','checkExtensionByMimeType' => false, 'extensions' => 'csv,xls,xlsx','maxSize'=>1024 * 1024 * 10],
            [['campaignID','cHasUpperCase', 'cHasLowerCase', 'cHasDigits', 'clientID', 'cCount', 'cLength', 'insertedBy', 'updatedBy'], 'integer'],
            [['rule'], 'string'],
            [['singleCode'],'string'],
            [['cCount'],'integer'],
            [['startDate', 'endDate', 'dateCreated', 'dateModified'], 'safe'],
            [['settingName'], 'string', 'max' => 200],
            [['type', 'status'], 'integer'],
             [['codeupload'],'required','on'=>['code-upload']],
            [['singleCode'],'required','on'=>['singlecode-create']],
             [['codeupload'],'required','on'=>['code-generate']],
            [['originalFileName', 'generatedFileName'], 'string', 'max' => 50],
            [['cPrefix', 'cSuffix'], 'string', 'max' => 5],
            [['campaignID'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::className(), 'targetAttribute' => ['campaignID' => 'campaignID']],
            [['insertedBy'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['insertedBy' => 'userID']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['updatedBy' => 'userID']],
            [['clientID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['clientID' => 'userID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codeID' => 'Code ID',
            'campaignID' => 'Campaign ID',
            'clientID' => 'Client ID',
            'settingName' => 'Setting Name',
            'type' => 'Type',
            'cCount' => 'Number Of Codes To be Generated',
            'rule' => 'Rule',
            'originalFileName' => 'Original File Name',
            'generatedFileName' => 'Generated File Name',
            'cLength' => 'Length of Code',
            'cHasUpperCase' => 'Code Has Upper Case',
            'cHasLowerCase' => 'Code Has Lower Case',
            'cHasDigits' => 'Code Has Digits',
            'cPrefix' => 'Code Prefix',
            'cSuffix' => 'Code Suffix',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
            'insertedBy' => 'Inserted By',
            'dateCreated' => 'Date Created',
            'status' => 'Status',
            'updatedBy' => 'Updated By',
            'dateModified' => 'Date Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCcodeentries()
    {
        return $this->hasMany(Ccodeentries::className(), ['cCodeID' => 'codeID']);
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
    public function getInsertedBy0()
    {
        return $this->hasOne(Users::className(), ['userID' => 'insertedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy0()
    {
        return $this->hasOne(Users::className(), ['userID' => 'updatedBy']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Users::className(), ['userID' => 'clientID']);
    }
}
