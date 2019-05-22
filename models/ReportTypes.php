<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reportTypes".
 *
 * @property string $reportTypeID
 * @property string $reportTypeName
 * @property string $description
 * @property integer $active
 * @property string $dateCreated
 * @property integer $insertedBy
 * @property string $dateModified
 * @property integer $updatedBy
 *
 * @property Reports[] $reports
 */
class ReportTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reportTypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reportTypeName', 'description', 'dateCreated', 'insertedBy', 'updatedBy'], 'required'],
            [['description'], 'string'],
            [['active', 'insertedBy', 'updatedBy'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
            [['reportTypeName'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reportTypeID' => Yii::t('app', 'Report Type ID'),
            'reportTypeName' => Yii::t('app', 'Report Type Name'),
            'description' => Yii::t('app', 'Description'),
            'active' => Yii::t('app', 'Active'),
            'dateCreated' => Yii::t('app', 'Date Created'),
            'insertedBy' => Yii::t('app', 'Inserted By'),
            'dateModified' => Yii::t('app', 'Date Modified'),
            'updatedBy' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Reports::className(), ['reportTypeID' => 'reportTypeID']);
    }
}
