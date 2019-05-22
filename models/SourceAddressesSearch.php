<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SourceAddresses;

/**
 * SourceAddressesSearch represents the model behind the search form of `app\models\SourceAddresses`.
 */
class SourceAddressesSearch extends SourceAddresses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sourceAddressID', 'accessCode', 'insertedBy', 'updatedBy'], 'integer'],
            [['sourceAddress', 'active', 'dateCreated', 'dateModified'], 'safe'],
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
        $query = SourceAddresses::find();

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
            'sourceAddressID' => $this->sourceAddressID,
            'accessCode' => $this->accessCode,
            'insertedBy' => $this->insertedBy,
            'dateCreated' => $this->dateCreated,
            'updatedBy' => $this->updatedBy,
            'dateModified' => $this->dateModified,
        ]);

        $query->andFilterWhere(['like', 'sourceAddress', $this->sourceAddress])
            ->andFilterWhere(['like', 'active', $this->active]);

        return $dataProvider;
    }
}
