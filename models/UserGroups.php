<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userGroups".
 *
 * @property string $userGroupID
 * @property string $userID
 * @property string $groupID
 * @property integer $active
 * @property string $insertedBy
 * @property string $dateCreated
 * @property string $updatedBy
 * @property string $dateModified
 *
 * @property Groups $group
 * @property Users $user
 */
class UserGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userGroups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['groupID'], 'required'],
            [['userID', 'groupID', 'active', 'insertedBy', 'updatedBy'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['userID', 'groupID'], 'unique', 'targetAttribute' => ['userID', 'groupID'], 'message' => 'The combination of User ID and Group ID has already been taken.'],
            [['groupID'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['groupID' => 'groupID']],
            [['userID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userID' => 'userID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userGroupID' => Yii::t('app', 'User Group ID'),
            'userID' => Yii::t('app', 'User ID'),
            'groupID' => Yii::t('app', 'Group ID'),
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
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['groupID' => 'groupID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['userID' => 'userID']);
    }
}
