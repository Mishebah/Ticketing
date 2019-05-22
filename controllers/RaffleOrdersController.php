<?php

namespace app\controllers;

use Yii;
use app\models\RaffleOrders;
use app\models\RaffleOrderTickets;
use app\models\RaffleOrdersSearch;
use yii\web\Controller;
use app\models\campaign;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RaffleOrdersController implements the CRUD actions for RaffleOrders model.
 */
class RaffleOrdersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RaffleOrders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RaffleOrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,//'model' => $this->findModel($campaignId)
        ]);
    }

    /**
     * Displays a single RaffleOrders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	
      $model = $this->findModel($id);
	  
	        $ticketDataProvider = new ActiveDataProvider([
            'query' => RaffleOrderTickets::find()->where('orderID = :orderID AND status =:status', [':orderID' => $model->orderID,"status"=>1])
        ]);
 

	  
        return $this->render('view', [
            
            'model' => $model, "ticketDataProvider" =>$ticketDataProvider

        ]);
    }

    /**
     * Creates a new RaffleOrders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RaffleOrders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->orderID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RaffleOrders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->orderID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RaffleOrders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
*/
    /**
     * Finds the RaffleOrders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RaffleOrders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RaffleOrders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
