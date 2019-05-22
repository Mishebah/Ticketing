<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ccodeentries".
 *
 * @property integer $codeID
 * @property integer $cCodeID
 * @property integer $clientID
 * @property integer $type
 * @property string $code
 * @property integer $insertedBy
 * @property string $dateCreated
 * @property integer $status
 * @property integer $updatedBy
 * @property string $dateModified
 *
 * @property Clients $client
 * @property Ccodes $cCode
 * @property Users $insertedBy0
 */
class CCodeentries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ccodeentries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cCodeID', 'clientID', 'insertedBy', 'dateCreated', 'updatedBy'], 'required'],
            [['cCodeID', 'clientID', 'insertedBy', 'updatedBy'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['type', 'status'], 'string', 'max' => 3],
            [['code'], 'string', 'max' => 50],
            [['clientID'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['clientID' => 'clientID']],
            [['cCodeID'], 'exist', 'skipOnError' => true, 'targetClass' => Ccodes::className(), 'targetAttribute' => ['cCodeID' => 'codeID']],
            [['insertedBy'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['insertedBy' => 'userID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codeID' => 'Code ID',
            'cCodeID' => 'C Code ID',
            'clientID' => 'Client ID',
            'type' => 'Type',
            'code' => 'Code',
            'insertedBy' => 'Inserted By',
            'dateCreated' => 'Date Created',
            'status' => 'Status',
            'updatedBy' => 'Updated By',
            'dateModified' => 'Date Modified',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['clientID' => 'clientID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCCode()
    {
        return $this->hasOne(Ccodes::className(), ['codeID' => 'cCodeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsertedBy0()
    {
        return $this->hasOne(Users::className(), ['userID' => 'insertedBy']);
    }
}
