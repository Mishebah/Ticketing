<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property string $groupID
 * @property string $groupTypeID
 * @property string $groupName
 * @property string $description
 * @property integer $active
 * @property string $dateCreated
 * @property integer $insertedBy
 * @property string $dateModified
 * @property integer $updatedBy
 *
 * @property GroupTypes $groupType
 * @property Permissions[] $permissions
 * @property ModuleActions[] $moduleActions
 * @property UserGroups[] $userGroups
 * @property Users[] $users
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['groupTypeID', 'active'], 'required'],
            [['groupTypeID', 'active', 'insertedBy', 'updatedBy'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['groupName'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 100],
            [['groupTypeID'], 'exist', 'skipOnError' => true, 'targetClass' => GroupTypes::className(), 'targetAttribute' => ['groupTypeID' => 'groupTypeID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'groupID' => Yii::t('app', 'Group ID'),
            'groupTypeID' => Yii::t('app', 'Group Type ID'),
            'groupName' => Yii::t('app', 'Group Name'),
            'description' => Yii::t('app', 'Description'),
            'active' => Yii::t('app', 'Active'),
            'dateCreated' => Yii::t('app', 'Date Created'),
            'insertedBy' => Yii::t('app', 'Inserted By'),
            'dateModified' => Yii::t('app', 'Date Modified'),
            'updatedBy' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupType()
    {
        return $this->hasOne(GroupTypes::className(), ['groupTypeID' => 'groupTypeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions()
    {
        return $this->hasMany(Permissions::className(), ['groupID' => 'groupID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleActions()
    {
        return $this->hasMany(ModuleActions::className(), ['moduleActionID' => 'moduleActionID'])->viaTable('permissions', ['groupID' => 'groupID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGroups()
    {
        return $this->hasMany(UserGroups::className(), ['groupID' => 'groupID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['userID' => 'userID'])->viaTable('userGroups', ['groupID' => 'groupID']);
    }
}
