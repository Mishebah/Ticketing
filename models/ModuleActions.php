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
        return 'moduleActions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['moduleID', 'entityActionID', 'active'], 'required'],
            [['moduleID', 'entityActionID', 'active', 'insertedBy', 'updatedBy'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['action'], 'string', 'max' => 45],
            [['moduleID', 'entityActionID'], 'unique', 'targetAttribute' => ['moduleID', 'entityActionID'], 'message' => 'The combination of Module ID and Entity Action ID has already been taken.'],
            [['entityActionID'], 'exist', 'skipOnError' => true, 'targetClass' => EntityActions::className(), 'targetAttribute' => ['entityActionID' => 'entityActionID']],
            [['moduleID'], 'exist', 'skipOnError' => true, 'targetClass' => Modules::className(), 'targetAttribute' => ['moduleID' => 'moduleID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'moduleActionID' => Yii::t('app', 'Module Action ID'),
            'moduleID' => Yii::t('app', 'Module ID'),
            'entityActionID' => Yii::t('app', 'Entity Action ID'),
            'action' => Yii::t('app', 'Action'),
            'active' => Yii::t('app', 'Active'),
            'insertedBy' => Yii::t('app', 'Inserted By'),
            'dateCreated' => Yii::t('app', 'Date Created'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'dateModified' => Yii::t('app', 'Date Modified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntityAction()
    {
        return $this->hasOne(EntityActions::className(), ['entityActionID' => 'entityActionID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Modules::className(), ['moduleID' => 'moduleID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions()
    {
        return $this->hasMany(Permissions::className(), ['moduleActionID' => 'moduleActionID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['groupID' => 'groupID'])->viaTable('permissions', ['moduleActionID' => 'moduleActionID']);
    }
}
