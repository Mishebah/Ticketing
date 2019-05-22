<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inMessages".
 *
 * @property string $messageID
 * @property string $messageContent
 * @property int $msgLength
 * @property int $msgPages
 * @property string $messageStatusID
 * @property string $dateCreated
 * @property string $updatedBy
 * @property string $dateModified
 */
class InMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inMessages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['messageContent'], 'string'],
            [['msgLength', 'messageStatusID', 'updatedBy'], 'integer'],
            [['messageStatusID', 'updatedBy'], 'required'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['msgPages'], 'string', 'max' => 1],
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
            'updatedBy' => 'Updated By',
            'dateModified' => 'Date Modified',
        ];
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaction()
    {
        return $this->hasOne(Transactions::className(), ['inboundSMSID' => 'messageID']);
    }
}
