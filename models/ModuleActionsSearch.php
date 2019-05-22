<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ModuleActions;

/**
 * ModuleActionsSearch represents the model behind the search form about `app\models\ModuleActions`.
 */
class ModuleActionsSearch extends ModuleActions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['moduleActionID', 'moduleID', 'entityActionID', 'active', 'insertedBy', 'updatedBy'], 'integer'],
            [['action', 'dateCreated', 'dateModified'], 'safe'],
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
        $query = ModuleActions::find();

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
            'moduleActionID' => $this->moduleActionID,
            'moduleID' => $this->moduleID,
            'entityActionID' => $this->entityActionID,
            'active' => $this->active,
            'insertedBy' => $this->insertedBy,
            'dateCreated' => $this->dateCreated,
            'updatedBy' => $this->updatedBy,
            'dateModified' => $this->dateModified,
        ]);

        $query->andFilterWhere(['like', 'action', $this->action]);

        return $dataProvider;
    }
}
