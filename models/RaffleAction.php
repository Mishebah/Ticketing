<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "moduleActions".
 *
 * @property string $moduleActionID
 * @property string $moduleID
 * @property string $entityActionID
 * @property string $action
 * @property integer $active
 * @property string $insertedBy
 * @property string $dateCreated
 * @property string $updatedBy
 * @property string $dateModified
 *
 * @property EntityActions $entityAction
 * @property Modules $module
 * @property Permissions[] $permissions
 * @property Groups[] $groups
 */
class ModuleActions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raffleActions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clientID', 'campaignID'], 'required'],
            [['clientIdID', 'campaignID', 'insertedBy', 'updatedBy'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['action'], 'string', 'max' => 45],
            [['clientID', 'campaignID'], 'unique', 'targetAttribute' => ['clientID', 'camapaignID'], 'message' => 'The combination of campaignID ID and client ID has already been taken.'],
            [['campaignID'], 'exist', 'skipOnError' => true, 'targetClass' => EntityActions::className(), 'targetAttribute' => ['campaignID' => 'campaignID']],
            [['clientID'], 'exist', 'skipOnError' => true, 'targetClass' => Modules::className(), 'targetAttribute' => ['clientID' => 'clientID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'campaignID' => Yii::t('app', 'campaign ID'),
            'clientID' => Yii::t('app', 'client ID'),
            'entityActionID' => Yii::t('app', 'Entity Action ID'),
            'insertedBy' => Yii::t('app', 'Inserted By'),
            'dateCreated' => Yii::t('app', 'Date Created'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'dateModified' => Yii::t('app', 'Date Modified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApi()
    {
        return $this->hasMany(RPaymentSettings::className(), ['clientID' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustom()
    {
        return $this->hasMany(campainrRequests::className(), ['clientID' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrl()
    {
        return $this->hasMany(Confirmation::className(), ['clientID' => 'clientID']);
    }
}
