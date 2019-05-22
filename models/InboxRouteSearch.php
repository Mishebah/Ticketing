<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InboxRoute;

/**
 * InboxRouteSearch represents the model behind the search form about `app\models\InboxRoute`.
 */
class InboxRouteSearch extends InboxRoute
{
				public $dateFrom ;
		public $dateTo ;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inboxID', 'numberOfSends', 'remoteID'], 'integer'],
            [['SOURCEADDR', 'DESTADDR', 'NETID', 'ORIGIN', 'UDH', 'MESSAGE', 'status', 'processed', 'updatedTime','dateTo','dateFrom', 'dateCreated'], 'safe'],
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
        $query = InboxRoute::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
												'sort' => [
        'defaultOrder' => [
            'inboxID' => SORT_DESC,
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
            'inboxID' => $this->inboxID,
            'numberOfSends' => $this->numberOfSends,
            'remoteID' => $this->remoteID,
            'updatedTime' => $this->updatedTime,
            'dateCreated' => $this->dateCreated,
        ]);

        $query->andFilterWhere(['like', 'SOURCEADDR', $this->SOURCEADDR])
            ->andFilterWhere(['like', 'DESTADDR', $this->DESTADDR])
            ->andFilterWhere(['like', 'MESSAGE', $this->MESSAGE])
			->andFilterWhere(['> ', 'dateCreated', $this->dateFrom])
			->andFilterWhere(['< ', 'dateCreated', $this->dateTo]);
			
        return $dataProvider;
    }
}
