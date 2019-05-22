<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modules".
 *
 * @property string $moduleID
 * @property string $moduleName
 * @property string $description
 * @property integer $active
 * @property string $insertedBy
 * @property string $dateCreated
 * @property string $updatedBy
 * @property string $dateModified
 *
 * @property ModuleActions[] $moduleActions
 * @property EntityActions[] $entityActions
 */
class Modules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['moduleName', 'description', 'active'], 'required'],
            [['active', 'insertedBy', 'updatedBy'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['moduleName'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 120],
            [['moduleName'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'moduleID' => Yii::t('app', 'Module ID'),
            'moduleName' => Yii::t('app', 'Module Name'),
            'description' => Yii::t('app', 'Description'),
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
    public function getModuleActions()
    {
        return $this->hasMany(ModuleActions::className(), ['moduleID' => 'moduleID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntityActions()
    {
        return $this->hasMany(EntityActions::className(), ['entityActionID' => 'entityActionID'])->viaTable('moduleActions', ['moduleID' => 'moduleID']);
    }
}
