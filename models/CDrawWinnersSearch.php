<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CDrawWinners;

/**
 * CDrawWinnersSearch represents the model behind the search form about `common\models\CDrawWinners`.
 */
class CDrawWinnersSearch extends CDrawWinners
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['winID', 'drawID', 'cEntryID', 'clientID', 'numRun', 'insertedBy', 'updatedBy', 'status'], 'integer'],
            [['dateCreated', 'dateModified', 'narration'], 'safe'],
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
        $query = CDrawWinners::find();

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
            'winID' => $this->winID,
            'drawID' => $this->drawID,
            'cEntryID' => $this->cEntryID,
            'clientID' => $this->clientID,
            'numRun' => $this->numRun,
            'dateCreated' => $this->dateCreated,
            'insertedBy' => $this->insertedBy,
            'dateModified' => $this->dateModified,
            'updatedBy' => $this->updatedBy,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'narration', $this->narration]);

        return $dataProvider;
    }
}