<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Permissions;

/**
 * PermissionsSearch represents the model behind the search form of `app\models\Permissions`.
 */
class PermissionsSearch extends Permissions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permissionID', 'moduleID', 'entityActionID', 'groupID', 'insertedBy', 'updatedBy'], 'integer'],
            [['access', 'active', 'dateCreated', 'dateModified'], 'safe'],
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
        $query = Permissions::find();

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
            'permissionID' => $this->permissionID,
            'moduleID' => $this->moduleID,
            'entityActionID' => $this->entityActionID,
            'groupID' => $this->groupID,
            'insertedBy' => $this->insertedBy,
            'dateCreated' => $this->dateCreated,
            'updatedBy' => $this->updatedBy,
            'dateModified' => $this->dateModified,
        ]);

        $query->andFilterWhere(['like', 'access', $this->access])
            ->andFilterWhere(['like', 'active', $this->active]);

        return $dataProvider;
    }
}
