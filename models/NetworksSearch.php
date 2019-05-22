<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Networks;

/**
 * NetworksSearch represents the model behind the search form of `app\models\Networks`.
 */
class NetworksSearch extends Networks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['networkID', 'prefix', 'numberLength', 'prefixLength', 'createdBy', 'updatedBy'], 'integer'],
            [['networkName', 'networkFullName', 'proxyUrl', 'dateCreated', 'dateModified'], 'safe'],
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
        $query = Networks::find();

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
            'networkID' => $this->networkID,
            'prefix' => $this->prefix,
            'numberLength' => $this->numberLength,
            'prefixLength' => $this->prefixLength,
            'createdBy' => $this->createdBy,
            'dateCreated' => $this->dateCreated,
            'updatedBy' => $this->updatedBy,
            'dateModified' => $this->dateModified,
        ]);

        $query->andFilterWhere(['like', 'networkName', $this->networkName])
            ->andFilterWhere(['like', 'networkFullName', $this->networkFullName])
            ->andFilterWhere(['like', 'proxyUrl', $this->proxyUrl]);

        return $dataProvider;
    }
}
