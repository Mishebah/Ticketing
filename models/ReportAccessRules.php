<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reportAccessRules".
 *
 * @property string $reportAccessRuleID
 * @property string $groupID
 * @property string $reportTypeID
 * @property integer $active
 * @property string $insertedBy
 * @property string $dateCreated
 * @property string $updatedBy
 * @property string $dateModified
 */
class ReportAccessRules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reportAccessRules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['groupID', 'reportTypeID', 'active'], 'required'],
            [['groupID', 'reportTypeID', 'active', 'insertedBy', 'updatedBy'], 'integer'],
            [['dateCreated', 'dateModified'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reportAccessRuleID' => Yii::t('app', 'Report Access Rule ID'),
            'groupID' => Yii::t('app', 'Group ID'),
            'reportTypeID' => Yii::t('app', 'Report Type ID'),
            'active' => Yii::t('app', 'Active'),
            'insertedBy' => Yii::t('app', 'Inserted By'),
            'dateCreated' => Yii::t('app', 'Date Created'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'dateModified' => Yii::t('app', 'Date Modified'),
        ];
    }
}
