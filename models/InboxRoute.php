<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inboxRoute".
 *
 * @property string $inboxID
 * @property string $SOURCEADDR
 * @property string $DESTADDR
 * @property integer $NETID
 * @property string $ORIGIN
 * @property string $UDH
 * @property string $MESSAGE
 * @property integer $status
 * @property integer $processed
 * @property integer $numberOfSends
 * @property string $remoteID
 * @property string $updatedTime
 * @property string $dateCreated
 */
class InboxRoute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inboxRoute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numberOfSends', 'remoteID'], 'integer'],
            [['updatedTime', 'dateCreated'], 'safe'],
            [['SOURCEADDR', 'DESTADDR'], 'string', 'max' => 15],
            [['NETID', 'status', 'processed'], 'string', 'max' => 3],
            [['ORIGIN', 'UDH'], 'string', 'max' => 50],
            [['MESSAGE'], 'string', 'max' => 900],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inboxID' => 'Inbox ID',
            'SOURCEADDR' => 'Sourceaddr',
            'DESTADDR' => 'Destaddr',
            'NETID' => 'Netid',
            'ORIGIN' => 'Origin',
            'UDH' => 'Udh',
            'MESSAGE' => 'Message',
            'status' => 'Status',
            'processed' => 'Processed',
            'numberOfSends' => 'Number Of Sends',
            'remoteID' => 'Remote ID',
            'updatedTime' => 'Updated Time',
            'dateCreated' => 'Date Created',
        ];
    }
}
