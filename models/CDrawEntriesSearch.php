<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CDrawEntries;

/**
 * CDrawEntriesSearch represents the model behind the search form about `common\models\CDrawEntries`.
 */
class CDrawEntriesSearch extends CDrawEntries
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entryID', 'drawID', 'cEntryID', 'clientID', 'insertedBy', 'updatedBy', 'status'], 'integer'],
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
        $query = CDrawEntries::find();

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
            'entryID' => $this->entryID,
            'drawID' => $this->drawID,
            'cEntryID' => $this->cEntryID,
            'clientID' => $this->clientID,
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
