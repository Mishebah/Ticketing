<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mnemonics".
 *
 * @property string $mnemonicID
 * @property string $mnemonicName
 * @property string $dateCreated
 * @property string $insertedBy
 * @property string $dateModified
 * @property string $updatedBy
 */
class Mnemonics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mnemonics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mnemonicName'], 'required'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['insertedBy', 'updatedBy'], 'integer'],
            [['mnemonicName'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mnemonicID' => 'Mnemonic ID',
            'mnemonicName' => 'Mnemonic Name',
            'dateCreated' => 'Date Created',
            'insertedBy' => 'Inserted By',
            'dateModified' => 'Date Modified',
            'updatedBy' => 'Updated By',
        ];
    }
}
