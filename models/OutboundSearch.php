<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Outbound;

/**
 * OutboundSearch represents the model behind the search form of `app\models\Outbound`.
 */
class OutboundSearch extends Outbound
{
			public $dateFrom ;
		public $dateTo ;
		public $messageContent ;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['outboundID', 'transactionID', 'messageID', 'gatewayUUID', 'MSISDN', 'priority', 'numberOfSends', 'statusCode', 'resendFrequency', 'maxSends', 'updatedBy'], 'integer'],
            [['sourceAddress', 'lastSend', 'firstSend', 'nextSend', 'dateFrom','dateTo','messageContent','expiryDate', 'delivered', 'deliveryTime', 'resend', 'dateCreated', 'dateModified'], 'safe'],
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
//        $query = Outbound::find();
           $query = Outbound::find()->joinWith('message', true, 'INNER JOIN');

 //$query = Outbound::find()->innerJoin('outMessages','outbound.messageID = outMessages.messageID')->innerJoin('transactions','outbound.transactionID = transactions.transactionID');

/* $query = Outbound::find()->innerJoin('outMessages','outbound.messageID = outMessages.messageID')->innerJoin('transactions','outbound.transactionID = transactions.transactionID')->innerJoin('services','transactions.serviceID = services.serviceID');
*/	
        // add conditions that should always apply here
		if(yii::$app->user->identity->clientID != Yii::$app->params['ADMIN_CLIENT_ID'])
			 $query->andWhere(['clientID'=> yii::$app->user->identity->clientID]);
	 
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
									'sort' => [
        'defaultOrder' => [
            'outboundID' => SORT_DESC,
              ],],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'outboundID' => $this->outboundID,
            'transactionID' => $this->transactionID,
            'messageID' => $this->messageID,
            'gatewayUUID' => $this->gatewayUUID,
            'MSISDN' => $this->MSISDN,
            'lastSend' => $this->lastSend,
            'firstSend' => $this->firstSend,
            'priority' => $this->priority,
            'nextSend' => $this->nextSend,
            'expiryDate' => $this->expiryDate,
            'numberOfSends' => $this->numberOfSends,
            'statusCode' => $this->statusCode,
            'deliveryTime' => $this->deliveryTime,
            'resendFrequency' => $this->resendFrequency,
            'maxSends' => $this->maxSends,
            'dateCreated' => $this->dateCreated,
            'updatedBy' => $this->updatedBy,
            'dateModified' => $this->dateModified,
        ]);

        $query->andFilterWhere(['like', 'sourceAddress', $this->sourceAddress])
            ->andFilterWhere(['like', 'delivered', $this->delivered])
            ->andFilterWhere(['like', 'resend', $this->resend])   
			->andFilterWhere(['> ', 'outbound.dateCreated', $this->dateFrom])
			->andFilterWhere(['< ', 'outbound.dateCreated', $this->dateTo])
			->andFilterWhere(['like', 'messageContent', $this->messageContent]);
        return $dataProvider;
    }
}
