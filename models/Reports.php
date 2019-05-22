<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reports".
 *
 * @property string $reportID
 * @property string $reportName
 * @property string $reportTypeID
 * @property string $reportOutputColumns
 * @property string $reportQuery
 * @property integer $active
 * @property string $insertedBy
 * @property string $dateCreated
 * @property string $updatedBy
 * @property string $dateModified
 * @property string $dateActivated
 *
 * @property ReportTypes $reportType
 */
class Reports extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reportName', 'reportTypeID', 'reportOutputColumns', 'active'], 'required'],
            [['reportTypeID', 'active', 'insertedBy', 'updatedBy'], 'integer'],
            [['reportOutputColumns', 'reportQuery'], 'string'],
            [['dateCreated', 'dateModified', 'dateActivated'], 'safe'],
            [['reportName'], 'string', 'max' => 255],
            [['reportName'], 'unique'],
            [['reportTypeID'], 'exist', 'skipOnError' => true, 'targetClass' => ReportTypes::className(), 'targetAttribute' => ['reportTypeID' => 'reportTypeID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reportID' => Yii::t('app', 'Report ID'),
            'reportName' => Yii::t('app', 'Report Name'),
            'reportTypeID' => Yii::t('app', 'Report Type ID'),
            'reportOutputColumns' => Yii::t('app', 'Report Output Columns'),
            'reportQuery' => Yii::t('app', 'Report Query'),
            'active' => Yii::t('app', 'Active'),
            'insertedBy' => Yii::t('app', 'Inserted By'),
            'dateCreated' => Yii::t('app', 'Date Created'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'dateModified' => Yii::t('app', 'Date Modified'),
            'dateActivated' => Yii::t('app', 'Date Activated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportType()
    {
        return $this->hasOne(ReportTypes::className(), ['reportTypeID' => 'reportTypeID']);
    }
}
