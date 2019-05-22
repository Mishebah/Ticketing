<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Campaign;

/**
 * CampaignSearch represents the model behind the search form about `app\models\Campaign`.
 */
class CampaignSearch extends Campaign
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campaignID', 'campaignType', 'clientID', 'entries', 'creditsUsed', 'insertedBy', 'updatedBy'], 'integer'],
            [['campaignName', 'description', 'uuid', 'startDate', 'endDate', 'status', 'dateCreated', 'dateModified'], 'safe'],
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
        $query = Campaign::find();

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
            'campaignID' => $this->campaignID,
            'campaignType' => $this->campaignType,
            'clientID' => $this->clientID,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'entries' => $this->entries,
            'creditsUsed' => $this->creditsUsed,
            'insertedBy' => $this->insertedBy,
            'dateCreated' => $this->dateCreated,
            'updatedBy' => $this->updatedBy,
            'dateModified' => $this->dateModified,
        ]);

        $query->andFilterWhere(['like', 'campaignName', $this->campaignName])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
