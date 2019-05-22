<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cDrawWinners".
 *
 * @property string $winID
 * @property string $drawID
 * @property string $cEntryID
 * @property string $clientID
 * @property integer $numRun
 * @property string $dateCreated
 * @property string $insertedBy
 * @property string $dateModified
 * @property string $updatedBy
 * @property integer $status
 * @property string $narration
 *
 * @property Clients $client
 * @property CDraws $draw
 */
class CDrawWinners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cDrawWinners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['winID', 'drawID', 'cEntryID', 'clientID', 'dateCreated', 'insertedBy', 'updatedBy', 'narration'], 'required'],
            [['winID', 'drawID', 'cEntryID', 'clientID', 'numRun', 'insertedBy', 'updatedBy', 'status'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['narration'], 'string'],
            [['clientID'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['clientID' => 'clientID']],
            [['drawID'], 'exist', 'skipOnError' => true, 'targetClass' => CDraws::className(), 'targetAttribute' => ['drawID' => 'drawID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'winID' => Yii::t('app', 'Win ID'),
            'drawID' => Yii::t('app', 'Draw ID'),
            'cEntryID' => Yii::t('app', 'C Entry ID'),
            'clientID' => Yii::t('app', 'Client ID'),
            'numRun' => Yii::t('app', 'Num Run'),
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
    public function getDraw()
    {
        return $this->hasOne(CDraws::className(), ['drawID' => 'drawID']);
    }
}
