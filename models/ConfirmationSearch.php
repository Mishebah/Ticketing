<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Confirmation;

/**
 * ConfirmationSearch represents the model behind the search form about `app\models\Confirmation`.
 */
class ConfirmationSearch extends Confirmation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['requestsID', 'clientID', 'campaignID', 'updatedBy', 'insertedBy'], 'integer'],
            [['settingName', 'settingType', 'shortCode', 'messageContent', 'serviceUrl', 'active', 'dateCreated', 'dateModified'], 'safe'],
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
        $query = Confirmation::find();

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
            'requestsID' => $this->requestsID,
            'clientID' => $this->clientID,
            'campaignID' => $this->campaignID,
            'updatedBy' => $this->updatedBy,
            'dateCreated' => $this->dateCreated,
            'dateModified' => $this->dateModified,
            'insertedBy' => $this->insertedBy,
        ]);

        $query->andFilterWhere(['like', 'settingName', $this->settingName])
            ->andFilterWhere(['like', 'settingType', $this->settingType])
            ->andFilterWhere(['like', 'shortCode', $this->shortCode])
            ->andFilterWhere(['like', 'messageContent', $this->messageContent])
            ->andFilterWhere(['like', 'serviceUrl', $this->serviceUrl])
            ->andFilterWhere(['like', 'active', $this->active]);

        return $dataProvider;
    }
}
