<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reports;

/**
 * ReportsSearch represents the model behind the search form about `app\models\Reports`.
 */
class ReportsSearch extends Reports
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reportID', 'reportTypeID', 'active', 'insertedBy', 'updatedBy'], 'integer'],
            [['reportName', 'reportOutputColumns', 'reportQuery', 'dateCreated', 'dateModified', 'dateActivated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Reports::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'reportID' => $this->reportID,
            'reportTypeID' => $this->reportTypeID,
            'active' => $this->active,
            'insertedBy' => $this->insertedBy,
            'dateCreated' => $this->dateCreated,
            'updatedBy' => $this->updatedBy,
            'dateModified' => $this->dateModified,
            'dateActivated' => $this->dateActivated,
        ]);

        $query->andFilterWhere(['like', 'reportName', $this->reportName])
            ->andFilterWhere(['like', 'reportOutputColumns', $this->reportOutputColumns])
            ->andFilterWhere(['like', 'reportQuery', $this->reportQuery]);

        return $dataProvider;
    }
}
