<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RaffleOrderTickets;

/**
 * RaffleOrdersTicketsSearch represents the model behind the search form about `app\models\RaffleOrderTickets`.
 */
class RaffleOrdersTicketsSearch extends RaffleOrderTickets
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderTicketID', 'clientID', 'campaignID', 'orderID', 'ticketTypeID', 'ticketQuantity', 'ticketPrice', 'ticketAttendeeMobileNumber', 'status', 'insertedBy', 'updatedBy'], 'integer'],
            [['ticketNo', 'ticketName', 'ticketDescription', 'ticketNumber', 'ticketAttendeeName', 'ticketAttendeeEmail', 'dateCreated', 'dateModified'], 'safe'],
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
        $query = RaffleOrderTickets::find();

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
            'orderTicketID' => $this->orderTicketID,
            'clientID' => $this->clientID,
            'campaignID' => $this->campaignID,
            'orderID' => $this->orderID,
            'ticketTypeID' => $this->ticketTypeID,
            'ticketQuantity' => $this->ticketQuantity,
            'ticketPrice' => $this->ticketPrice,
            'ticketAttendeeMobileNumber' => $this->ticketAttendeeMobileNumber,
            'status' => $this->status,
            'dateCreated' => $this->dateCreated,
            'dateModified' => $this->dateModified,
            'insertedBy' => $this->insertedBy,
            'updatedBy' => $this->updatedBy,
        ]);

        $query->andFilterWhere(['like', 'ticketNo', $this->ticketNo])
            ->andFilterWhere(['like', 'ticketName', $this->ticketName])
            ->andFilterWhere(['like', 'ticketDescription', $this->ticketDescription])
            ->andFilterWhere(['like', 'ticketNumber', $this->ticketNumber])
            ->andFilterWhere(['like', 'ticketAttendeeName', $this->ticketAttendeeName])
            ->andFilterWhere(['like', 'ticketAttendeeEmail', $this->ticketAttendeeEmail]);

        return $dataProvider;
    }
}
