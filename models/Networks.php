<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "networks".
 *
 * @property int $networkID
 * @property string $networkName
 * @property int $prefix
 * @property int $numberLength
 * @property int $prefixLength
 * @property string $networkFullName
 * @property string $proxyUrl
 * @property int $active
 * @property string $createdBy
 * @property string $dateCreated
 * @property string $updatedBy
 * @property string $dateModified
 */
class Networks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'networks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prefix', 'numberLength','networkName', 'networkFullName',  'proxyUrl'], 'required'],
            [['prefix', 'numberLength', 'prefixLength', 'createdBy', 'updatedBy'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
			[['proxyUrl'],'url'],
            [['networkName', 'networkFullName'], 'string', 'max' => 30],
            [['proxyUrl'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'networkID' => 'Network ID',
            'networkName' => 'Network Name',
            'prefix' => 'Prefix',
            'numberLength' => 'Number Length',
            'prefixLength' => 'Prefix Length',
            'networkFullName' => 'Network Full Name',
            'proxyUrl' => 'Proxy Url',
            'active' => 'Active',
            'createdBy' => 'Created By',
            'dateCreated' => 'Date Created',
            'updatedBy' => 'Updated By',
            'dateModified' => 'Date Modified',
        ];
    }
}
