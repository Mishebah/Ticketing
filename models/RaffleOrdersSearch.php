<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RaffleOrders;

/**
 * RaffleOrdersSearch represents the model behind the search form about `app\models\RaffleOrders`.
 */
class RaffleOrdersSearch extends RaffleOrders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderID', 'MSISDN','clientID', 'campaignID','paymentID', 'attendeeMobileNumber', 'orderQuantity', 'status', 'insertedBy', 'updatedBy'], 'integer'],
            [['orderNo', 'payerName', 'attendeeName', 'attendeeEmail', 'dateCreated', 'dateModified'], 'safe'],
            [['amountPaid', 'orderAmount'], 'number'],
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
        $query = RaffleOrders::find();

        // add conditions that should always apply here
        if(yii::$app->user->identity->clientID != Yii::$app->params['ADMIN_CLIENT_ID'])
             $query->andWhere(['clientID'=> yii::$app->user->identity->clientID]);

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
            'orderID' => $this->orderID,
            'clientID' => $this->clientID,
            'campaignID' => $this->campaignID,
            'amountPaid' => $this->amountPaid,
            'MSISDN' => $this->MSISDN,
            'paymentID' => $this->paymentID,
            'attendeeMobileNumber' => $this->attendeeMobileNumber,
            'orderQuantity' => $this->orderQuantity,
            'orderAmount' => $this->orderAmount,
            'status' => $this->status,
            'dateCreated' => $this->dateCreated,
            'dateModified' => $this->dateModified,
            'insertedBy' => $this->insertedBy,
            'updatedBy' => $this->updatedBy,
        ]);

        $query->andFilterWhere(['like', 'orderNo', $this->orderNo])
            ->andFilterWhere(['like', 'payerName', $this->payerName])
            ->andFilterWhere(['like', 'attendeeName', $this->attendeeName])
            ->andFilterWhere(['like', 'attendeeEmail', $this->attendeeEmail]);

        return $dataProvider;
    }
}
