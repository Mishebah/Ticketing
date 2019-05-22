<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CCodes;

/**
 * CCodesSearch represents the model behind the search form about `app\models\CCodes`.
 */
class CCodesSearch extends CCodes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codeID', 'campaignID', 'clientID', 'cCount', 'cLength', 'insertedBy', 'updatedBy'], 'integer'],
            [['settingName', 'type', 'rule', 'originalFileName', 'generatedFileName', 'cHasUpperCase', 'cHasLowerCase', 'cHasDigits', 'cPrefix', 'cSuffix', 'startDate', 'endDate', 'dateCreated', 'status', 'dateModified'], 'safe'],
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
        $query = CCodes::find();

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
            'codeID' => $this->codeID,
            'campaignID' => $this->campaignID,
            'clientID' => $this->clientID,
            'cCount' => $this->cCount,
            'cLength' => $this->cLength,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'insertedBy' => $this->insertedBy,
            'dateCreated' => $this->dateCreated,
            'updatedBy' => $this->updatedBy,
            'dateModified' => $this->dateModified,
        ]);

        $query->andFilterWhere(['like', 'settingName', $this->settingName])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'rule', $this->rule])
            ->andFilterWhere(['like', 'originalFileName', $this->originalFileName])
            ->andFilterWhere(['like', 'generatedFileName', $this->generatedFileName])
            ->andFilterWhere(['like', 'cHasUpperCase', $this->cHasUpperCase])
            ->andFilterWhere(['like', 'cHasLowerCase', $this->cHasLowerCase])
            ->andFilterWhere(['like', 'cHasDigits', $this->cHasDigits])
            ->andFilterWhere(['like', 'cPrefix', $this->cPrefix])
            ->andFilterWhere(['like', 'cSuffix', $this->cSuffix])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
