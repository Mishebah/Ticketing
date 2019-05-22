<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entityActions".
 *
 * @property string $entityActionID
 * @property string $actionName
 * @property integer $active
 * @property string $insertedBy
 * @property string $updatedBy
 * @property string $dateCreated
 * @property string $dateModified
 *
 * @property DataChanges[] $dataChanges
 * @property ModuleActions[] $moduleActions
 * @property Modules[] $modules
 */
class EntityActions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entityActions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actionName', 'active'], 'required'],
            [['active', 'insertedBy', 'updatedBy'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['actionName'], 'string', 'max' => 45],
            [['actionName'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'entityActionID' => Yii::t('app', 'Entity Action ID'),
            'actionName' => Yii::t('app', 'Action Name'),
            'active' => Yii::t('app', 'Active'),
            'insertedBy' => Yii::t('app', 'Inserted By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'dateCreated' => Yii::t('app', 'Date Created'),
            'dateModified' => Yii::t('app', 'Date Modified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataChanges()
    {
        return $this->hasMany(DataChanges::className(), ['entityActionID' => 'entityActionID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleActions()
    {
        return $this->hasMany(ModuleActions::className(), ['entityActionID' => 'entityActionID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModules()
    {
        return $this->hasMany(Modules::className(), ['moduleID' => 'moduleID'])->viaTable('moduleActions', ['entityActionID' => 'entityActionID']);
    }
}
