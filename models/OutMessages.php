<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outMessages".
 *
 * @property string $messageID
 * @property string $messageContent
 * @property int $msgLength
 * @property int $msgPages
 * @property string $messageStatusID
 * @property string $dateCreated
 * @property string $createdBy
 * @property string $dateModified
 * @property string $updatedBy
 *
 * @property Broadcasts[] $broadcasts
 * @property Outbound[] $outbounds
 */
class OutMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outMessages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['messageContent'], 'string'],
            [['msgLength', 'msgPages','messageStatusID', 'createdBy', 'updatedBy'], 'integer'],
            [['messageContent'], 'required'],
            [['dateCreated', 'dateModified'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'messageID' => 'Message ID',
            'messageContent' => 'Message Content',
            'msgLength' => 'Msg Length',
            'msgPages' => 'Msg Pages',
            'messageStatusID' => 'Message Status ID',
            'dateCreated' => 'Date Created',
            'createdBy' => 'Created By',
            'dateModified' => 'Date Modified',
            'updatedBy' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcasts()
    {
        return $this->hasMany(Broadcasts::className(), ['messageID' => 'messageID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutbounds()
    {
        return $this->hasMany(Outbound::className(), ['messageID' => 'messageID']);
    }
}
