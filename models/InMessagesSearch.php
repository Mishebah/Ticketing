<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InMessages;

/**
 * InMessagesSearch represents the model behind the search form of `app\models\InMessages`.
 */
class InMessagesSearch extends InMessages
{
    /**
     * @inheritdoc
     */
	 			public $dateFrom ;
		public $dateTo ;
		
    public function rules()
    {
        return [
            [['messageID', 'msgLength', 'messageStatusID', 'updatedBy'], 'integer'],
            [['messageContent', 'msgPages','dateFrom','dateTo', 'dateCreated', 'dateModified'], 'safe'],
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
        $query = InMessages::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
									'sort' => [
        'defaultOrder' => [
            'messageID' => SORT_DESC,
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
            'messageID' => $this->messageID,
            'msgLength' => $this->msgLength,
            'messageStatusID' => $this->messageStatusID,
            'dateCreated' => $this->dateCreated,
            'updatedBy' => $this->updatedBy,
            'dateModified' => $this->dateModified,
        ]);

        $query->andFilterWhere(['like', 'messageContent', $this->messageContent])
					->andFilterWhere(['> ', 'dateCreated', $this->dateFrom])
			->andFilterWhere(['< ', 'dateCreated', $this->dateTo])
            ->andFilterWhere(['like', 'msgPages', $this->msgPages]);

        return $dataProvider;
    }
}
