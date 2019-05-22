<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "permissions".
 *
 * @property string $permissionID
 * @property string $moduleID
 * @property string $entityActionID
 * @property string $groupID
 * @property int $access
 * @property int $active
 * @property string $insertedBy
 * @property string $dateCreated
 * @property string $updatedBy
 * @property string $dateModified
 *
 * @property Groups $group
 * @property EntityActions $entityAction
 * @property Modules $module
 */
class Permissions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permissions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['moduleID', 'entityActionID', 'groupID'], 'required'],
            [['moduleID', 'entityActionID', 'groupID', 'insertedBy', 'updatedBy'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
          //  [['access', 'active'], 'string', 'max' => 3],
            [['moduleID', 'entityActionID', 'groupID'], 'unique', 'targetAttribute' => ['moduleID', 'entityActionID', 'groupID']],
            [['groupID'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['groupID' => 'groupID']],
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
            'permissionID' => 'Permission ID',
            'moduleID' => 'Module ID',
            'entityActionID' => 'Entity Action ID',
            'groupID' => 'Group ID',
            'access' => 'Access',
            'active' => 'Active',
            'insertedBy' => 'Inserted By',
            'dateCreated' => 'Date Created',
            'updatedBy' => 'Updated By',
            'dateModified' => 'Date Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['groupID' => 'groupID']);
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
}
