<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cDrawEntries".
 *
 * @property string $entryID
 * @property string $drawID
 * @property string $cEntryID
 * @property string $clientID
 * @property string $dateCreated
 * @property string $insertedBy
 * @property string $dateModified
 * @property string $updatedBy
 * @property integer $status
 * @property string $narration
 *
 * @property Clients $client
 * @property CEntries $cEntry
 * @property CDraws $draw
 */
class CDrawEntries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cDrawEntries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entryID', 'drawID', 'cEntryID', 'clientID', 'dateCreated', 'insertedBy', 'updatedBy', 'narration'], 'required'],
            [['entryID', 'drawID', 'cEntryID', 'clientID', 'insertedBy', 'updatedBy', 'status'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['narration'], 'string'],
            [['clientID'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['clientID' => 'clientID']],
            [['cEntryID'], 'exist', 'skipOnError' => true, 'targetClass' => CEntries::className(), 'targetAttribute' => ['cEntryID' => 'entryID']],
            [['drawID'], 'exist', 'skipOnError' => true, 'targetClass' => CDraws::className(), 'targetAttribute' => ['drawID' => 'drawID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'entryID' => Yii::t('app', 'Entry ID'),
            'drawID' => Yii::t('app', 'Draw ID'),
            'cEntryID' => Yii::t('app', 'C Entry ID'),
            'clientID' => Yii::t('app', 'Client ID'),
            'dateCreated' => Yii::t('app', 'Date Created'),
            'insertedBy' => Yii::t('app', 'Inserted By'),
            'dateModified' => Yii::t('app', 'Date Modified'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
            'narration' => Yii::t('app', 'Narration'),
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
    public function getCEntry()
    {
        return $this->hasOne(CEntries::className(), ['entryID' => 'cEntryID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDraw()
    {
        return $this->hasOne(CDraws::className(), ['drawID' => 'drawID']);
    }
}
