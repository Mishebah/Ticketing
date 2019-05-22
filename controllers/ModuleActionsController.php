<?php

namespace app\controllers;

use Yii;
use app\models\ModuleActions;
use app\models\ModuleActionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\PermissionUtils;
use yii\web\ForbiddenHttpException;

/**
 * ModuleActionsController implements the CRUD actions for ModuleActions model.
 */
class ModuleActionsController extends Controller
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
     * Lists all ModuleActions models.
     * @return mixed
     */
    public function actionIndex()
    {
							if(!PermissionUtils::checkModuleActionPermission("ModuleActions",PermissionUtils::VIEW_ALL)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        $searchModel = new ModuleActionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModuleActions model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
						   if(!PermissionUtils::checkModuleActionPermission("ModuleActions",PermissionUtils::VIEW_ONE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ModuleActions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
									   if(!PermissionUtils::checkModuleActionPermission("ModuleActions",PermissionUtils::CREATE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }  
        $model = new ModuleActions();
$model->insertedBy= yii::$app->user->identity->userID;
      $model->updatedBy=  yii::$app->user->identity->userID;
     $model->dateCreated = new Expression('NOW()');
	 $model->active = StatusCodes::ACTIVE;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->moduleActionID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ModuleActions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
	            			if(!PermissionUtils::checkModuleActionPermission("ModuleActions",PermissionUtils::UPDATE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        } 
        $model = $this->findModel($id);
      $model->updatedBy=  yii::$app->user->identity->userID;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->moduleActionID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ModuleActions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
   if(!PermissionUtils::checkModuleActionPermission("ModuleActions",PermissionUtils::DELETE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }	
      $model = $this->findModel($id);
      $model->updatedBy=  yii::$app->user->identity->userID;
	 $model->active = StatusCodes::INACTIVE;
	 
	 if($model->save())
	 	Yii::$app->session->addFlash( 'success',"ModuleActions has been deleted " );
		else
		Yii::$app->session->addFlash( 'error',"Error on deleting ModuleActions " );

        return $this->redirect(['index']);
    }

    /**
     * Finds the ModuleActions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ModuleActions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
$model = ModuleActions::findOne($id);
		if ((isset(Yii::$app->params['ADMIN_CLIENT_ID']) and  Yii::$app->user->identity->clientID == Yii::$app->params['ADMIN_CLIENT_ID']))
		{
            return $model;
        }
		else
			throw new NotFoundHttpException('The requested page does not exist.');
	
    }
}
