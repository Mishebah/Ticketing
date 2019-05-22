<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form about `app\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userID', 'clientID', 'MSISDN', 'passwordAttempts', 'passwordStatusID', 'active', 'updatedBy', 'createdBy'], 'integer'],
            [[ 'fullNames', 'emailAddress', 'IDNumber',  'password', 'datePasswordChanged', 'dateActivated', 'dateCreated', 'dateModified'], 'safe'],
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
        $query = Users::find();

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
            'userID' => $this->userID,
            'clientID' => $this->clientID,
            'MSISDN' => $this->MSISDN,
            'passwordAttempts' => $this->passwordAttempts,
            'passwordStatusID' => $this->passwordStatusID,
            'datePasswordChanged' => $this->datePasswordChanged,
            'active' => $this->active,
            'dateActivated' => $this->dateActivated,
            'dateCreated' => $this->dateCreated,
            'dateModified' => $this->dateModified,
            'updatedBy' => $this->updatedBy,
            'createdBy' => $this->createdBy,
        ]);

        $query->andFilterWhere(['like', 'fullNames', $this->fullNames])
            ->andFilterWhere(['like', 'emailAddress', $this->emailAddress])
            ->andFilterWhere(['like', 'IDNumber', $this->IDNumber])
            ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }
}
