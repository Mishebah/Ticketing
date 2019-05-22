<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sourceAddresses".
 *
 * @property string $sourceAddressID
 * @property string $sourceAddress
 * @property int $accessCode
 * @property int $active
 * @property string $insertedBy
 * @property string $dateCreated
 * @property string $updatedBy
 * @property string $dateModified
 *
 * @property Services[] $services
 * @property Users $insertedBy0
 * @property Users $updatedBy0
 */
class SourceAddresses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sourceAddresses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['accessCode', 'insertedBy', 'dateCreated', 'updatedBy'], 'required'],
            [['accessCode', 'insertedBy', 'updatedBy'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['sourceAddress'], 'string', 'max' => 50],
            [['sourceAddress'], 'unique'],
            [['insertedBy'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['insertedBy' => 'userID']],
            [['updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['updatedBy' => 'userID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sourceAddressID' => 'Source Address ID',
            'sourceAddress' => 'Source Address',
            'accessCode' => 'Access Code',
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
    public function getServices()
    {
        return $this->hasMany(Services::className(), ['sourceAddressID' => 'sourceAddressID']);
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
}
