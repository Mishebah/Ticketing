<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groupTypes".
 *
 * @property string $groupTypeID
 * @property string $groupTypeName
 * @property string $description
 * @property integer $active
 * @property string $activityHistory
 * @property string $dateCreated
 * @property integer $insertedBy
 * @property string $dateModified
 * @property integer $updatedBy
 *
 * @property Groups[] $groups
 */
class GroupTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groupTypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'required'],
            [['active', 'insertedBy', 'updatedBy'], 'integer'],
            [['activityHistory'], 'string'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['groupTypeName'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'groupTypeID' => Yii::t('app', 'Group Type ID'),
            'groupTypeName' => Yii::t('app', 'Group Type Name'),
            'description' => Yii::t('app', 'Description'),
            'active' => Yii::t('app', 'Active'),
            'activityHistory' => Yii::t('app', 'Activity History'),
            'dateCreated' => Yii::t('app', 'Date Created'),
            'insertedBy' => Yii::t('app', 'Inserted By'),
            'dateModified' => Yii::t('app', 'Date Modified'),
            'updatedBy' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['groupTypeID' => 'groupTypeID']);
    }
}
