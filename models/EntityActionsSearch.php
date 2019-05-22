<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EntityActions;

/**
 * EntityActionsSearch represents the model behind the search form about `app\models\EntityActions`.
 */
class EntityActionsSearch extends EntityActions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entityActionID', 'active', 'insertedBy', 'updatedBy'], 'integer'],
            [['actionName', 'dateCreated', 'dateModified'], 'safe'],
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
        $query = EntityActions::find();

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
            'entityActionID' => $this->entityActionID,
            'active' => $this->active,
            'insertedBy' => $this->insertedBy,
            'updatedBy' => $this->updatedBy,
            'dateCreated' => $this->dateCreated,
            'dateModified' => $this->dateModified,
        ]);

        $query->andFilterWhere(['like', 'actionName', $this->actionName]);

        return $dataProvider;
    }
}
