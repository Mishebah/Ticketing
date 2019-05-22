<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CDraws;

/**
 * CDrawsSearch represents the model behind the search form about `common\models\CDraws`.
 */
class CDrawsSearch extends CDraws
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['drawID', 'campaignID', 'clientID', 'drawNumber', 'winningNumber', 'entriesCount', 'winnersCount', 'processed', 'bucketID', 'numberOfRuns', 'insertedBy', 'updatedBy'], 'integer'],
            [['uuid', 'drawEntriesFrom', 'drawEntriesTo', 'status', 'dateProcessed', 'dateFirstProcessed', 'dateCreated', 'dateModified', 'narration'], 'safe'],
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
        $query = CDraws::find();

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
            'drawID' => $this->drawID,
            'campaignID' => $this->campaignID,
            'clientID' => $this->clientID,
            'drawNumber' => $this->drawNumber,
            'drawEntriesFrom' => $this->drawEntriesFrom,
            'drawEntriesTo' => $this->drawEntriesTo,
            'winningNumber' => $this->winningNumber,
            'entriesCount' => $this->entriesCount,
            'winnersCount' => $this->winnersCount,
            'processed' => $this->processed,
            'bucketID' => $this->bucketID,
            'dateProcessed' => $this->dateProcessed,
            'dateFirstProcessed' => $this->dateFirstProcessed,
            'numberOfRuns' => $this->numberOfRuns,
            'dateCreated' => $this->dateCreated,
            'insertedBy' => $this->insertedBy,
            'dateModified' => $this->dateModified,
            'updatedBy' => $this->updatedBy,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'narration', $this->narration]);

        return $dataProvider;
    }
}
