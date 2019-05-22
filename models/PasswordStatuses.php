<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "passwordStatuses".
 *
 * @property integer $passwordStatusID
 * @property string $passwordStatus
 * @property integer $insertedBy
 * @property string $dateCreated
 * @property integer $updatedBy
 * @property string $dateModified
 *
 * @property Users[] $users
 */
class PasswordStatuses extends \yii\db\ActiveRecord
{
	    const PASSWORD_STATUS_NEW_USER = 0;
    const PASSWORD_STATUS_ACTIVE = 1;
    const PASSWORD_STATUS_ONE_TIME = 2;
    const PASSWORD_STATUS_LOCKED = 3;
    const PASSWORD_STATUS_EXPIRED = 4;
    const PASSWORD_STATUS_DORMANT = 5;
    const PASSWORD_STATUS_DELETED_USER = 6;
    const PASSWORD_STATUS_RESET = 7;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'passwordStatuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['passwordStatusID', 'passwordStatus'], 'required'],
            [['passwordStatusID', 'insertedBy', 'updatedBy'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['passwordStatus'], 'string', 'max' => 60],
            [['passwordStatus'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'passwordStatusID' => Yii::t('app', 'Password Status ID'),
            'passwordStatus' => Yii::t('app', 'Password Status'),
            'insertedBy' => Yii::t('app', 'Inserted By'),
            'dateCreated' => Yii::t('app', 'Date Created'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'dateModified' => Yii::t('app', 'Date Modified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['passwordStatusID' => 'passwordStatusID']);
    }
}
