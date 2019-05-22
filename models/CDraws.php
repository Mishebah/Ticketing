<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cDraws".
 *
 * @property string $drawID
 * @property string $uuid
 * @property string $campaignID
 * @property string $clientID
 * @property string $drawNumber
 * @property string $drawEntriesFrom
 * @property string $drawEntriesTo
 * @property integer $winningNumber
 * @property integer $status
 * @property string $entriesCount
 * @property integer $winnersCount
 * @property integer $processed
 * @property integer $bucketID
 * @property string $dateProcessed
 * @property string $dateFirstProcessed
 * @property string $numberOfRuns
 * @property string $dateCreated
 * @property string $insertedBy
 * @property string $dateModified
 * @property string $updatedBy
 * @property string $narration
 *
 * @property CDrawEntries[] $cDrawEntries
 * @property CDrawWinners[] $cDrawWinners
 * @property Campaign $campaign
 * @property Clients $client
 */
class CDraws extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cDraws';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uuid', 'campaignID', 'clientID', 'drawNumber', 'drawEntriesFrom', 'drawEntriesTo'], 'required'],
            [['campaignID', 'clientID', 'drawNumber', 'winningNumber', 'entriesCount', 'winnersCount', 'processed', 'bucketID', 'allowPreviousWinners','numberOfRuns', 'insertedBy', 'updatedBy'], 'integer'],
            [['drawEntriesFrom', 'drawEntriesTo', 'dateProcessed', 'dateFirstProcessed', 'dateCreated', 'dateModified'], 'safe'],
            [['narration'], 'string'],
			[['drawNumber'], 'default', 'value'=> 1],
            [['uuid'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 4],
            [['drawNumber'], 'unique'],
            [['campaignID'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::className(), 'targetAttribute' => ['campaignID' => 'campaignID']],
            [['clientID'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['clientID' => 'clientID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'drawID' => Yii::t('app', 'Draw ID'),
            'uuid' => Yii::t('app', 'Uuid'),
            'campaignID' => Yii::t('app', 'Campaign ID'),
            'clientID' => Yii::t('app', 'Client ID'),
            'drawNumber' => Yii::t('app', 'Winners to Draw:'),
            'drawEntriesFrom' => Yii::t('app', 'Draw Entries From'),
            'drawEntriesTo' => Yii::t('app', 'Draw Entries To'),
            'winningNumber' => Yii::t('app', 'Winning Number'),
            'status' => Yii::t('app', 'Status'),
            'entriesCount' => Yii::t('app', 'Entries Count'),
            'winnersCount' => Yii::t('app', 'Winners Count'),
            'processed' => Yii::t('app', 'Processed'),
            'bucketID' => Yii::t('app', 'Bucket ID'),
            'dateProcessed' => Yii::t('app', 'Date Processed'),
            'dateFirstProcessed' => Yii::t('app', 'Date First Processed'),
            'numberOfRuns' => Yii::t('app', 'Number Of Runs'),
            'dateCreated' => Yii::t('app', 'Date Created'),
            'insertedBy' => Yii::t('app', 'Inserted By'),
            'dateModified' => Yii::t('app', 'Date Modified'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'narration' => Yii::t('app', 'Narration'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCDrawEntries()
    {
        return $this->hasMany(CDrawEntries::className(), ['drawID' => 'drawID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCDrawWinners()
    {
        return $this->hasMany(CDrawWinners::className(), ['drawID' => 'drawID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaign()
    {
        return $this->hasOne(Campaign::className(), ['campaignID' => 'campaignID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['clientID' => 'clientID']);
    }
}
