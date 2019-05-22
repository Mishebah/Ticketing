<?php

namespace app\controllers;

use Yii;
use app\models\Groups;
use app\models\GroupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\PermissionUtils;
use yii\web\ForbiddenHttpException;
use yii\helpers\Html;
use yii\db\Expression;
use app\components\StatusCodes;
use app\components\CoreUtils;
use yii\data\ActiveDataProvider;
use app\models\Permissions;

/**
 * GroupsController implements the CRUD actions for Groups model.
 */
class GroupsController extends Controller
{
		 			public function beforeAction($action)
{
				if(PermissionUtils::checkModuleActionPermission("Groups",PermissionUtils::VIEW_ALL)){

    Yii::$app->view->params['menu'] = '  <div class="navbar-default" role="navigation">
                    <div class="navbar-collapse collapse sidebar-navbar-collapse">
							<ul class="nav navbar-nav side-nav">
							<li class="selected active">'. Html::a('Clients List <span class="fa arrow"></span>', ['/clients/index'],['class'=>'class=&#039;selected active&#039;']).'                          
							<ul class="active-menu">														
							<li>
							'. Html::a('--Create Client <span class="glyphicon glyphicon-menu-right">', ['/clients/create'],['class'=>'active']).'                    
								</li>
								<li>
							'. Html::a('-- All Clients <span class="glyphicon glyphicon-menu-right">', ['/clients/index'],['class'=>'active']).'                    
								</li>
                            	</ul>
							<li class="selected active">'. Html::a('Users List <span class="fa arrow"></span>', ['/users/index'],['class'=>'class=&#039;selected active&#039;']).'                          
							<ul class="active-menu">														
							<li>
							'. Html::a('-- Create Users  <span class="glyphicon glyphicon-menu-right">', ['/users/create'],['class'=>'active']).'                    
								</li>
								<li>
							'. Html::a('-- All Users <span class="glyphicon glyphicon-menu-right">', ['/users/index'],['class'=>'active']).'                    
								</li>
                            	</ul>
                            <li class="selected active">'. Html::a('Permissions<span class="fa arrow"></span>', ['/permissions/index'],['class'=>'class=&#039;selected active&#039;']).'                          
							<ul class="active-menu">														
							<li>
							'. Html::a('-- New permissions<span class="glyphicon glyphicon-menu-right">', ['/permissions/create'],['class'=>'active']).'                    
								</li>
								<li>
							'. Html::a('-- All permissions <span class="glyphicon glyphicon-menu-right">', ['/permissions/index'],['class'=>'active']).'                    
								</li>
                            	</ul>
                          <li class="selected active">'. Html::a('User Groups  <span class="fa arrow"></span>', ['/user-groups/index'],['class'=>'class=&#039;selected active&#039;']).'                          
							<ul class="active-menu">														
							<li>
							'. Html::a('--Assign  user to group <span class="glyphicon glyphicon-menu-right">', ['/user-groups/create'],['class'=>'active']).'                    
								</li>
								<li>
							'. Html::a('--All Assignments <span class="glyphicon glyphicon-menu-right">', ['/user-groups/index'],['class'=>'active']).'                    
								</li>
                            	</ul>

                             </ul>
					</div>
				</div>';
				}
  //return true;
  return parent::beforeAction($action);
}
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
     * Lists all Groups models.
     * @return mixed
     */
    public function actionIndex()
    {
			if(!PermissionUtils::checkModuleActionPermission("Groups",PermissionUtils::VIEW_ALL)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }	
        $searchModel = new GroupsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Groups model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
	   if(!PermissionUtils::checkModuleActionPermission("Groups",PermissionUtils::VIEW_ONE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
       	 $model = $this->findModel($id);
		 if($model)
		 {
			 //we load the  
			 $dataProvider = new ActiveDataProvider([
    'query' => Permissions::find()->innerJoinWith('module', false)->innerJoinWith('entityAction', false)->where(['permissions.active'=>StatusCodes::ACTIVE,'entityActions.active'=>StatusCodes::ACTIVE,'groupID'=>$model->groupID]),
]);
		 
        return $this->render('view', [
            'model' =>  $model,'dataProvider'=> $dataProvider
        ]);
		 }
		 else
			 throw new \yii\web\NotFoundHttpException('You are not allowed to perform this action.');
    }

    /**
     * Creates a new Groups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
							   if(!PermissionUtils::checkModuleActionPermission("Groups",PermissionUtils::CREATE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        $model = new Groups();
$model->insertedBy= yii::$app->user->identity->userID;
      $model->updatedBy=  yii::$app->user->identity->userID;
     $model->dateCreated = new Expression('NOW()');
	 $model->active = StatusCodes::ACTIVE;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->groupID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Groups model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
			if(!PermissionUtils::checkModuleActionPermission("Groups",PermissionUtils::UPDATE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        $model = $this->findModel($id);
      $model->updatedBy=  yii::$app->user->identity->userID;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->groupID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Groups model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
   if(!PermissionUtils::checkModuleActionPermission("Groups",PermissionUtils::DELETE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }	
      $model = $this->findModel($id);
      $model->updatedBy=  yii::$app->user->identity->userID;
	 $model->active = StatusCodes::INACTIVE;
	 
	 if($model->save())
	 	Yii::$app->session->addFlash( 'success',"Groups has been deleted " );
		else
		Yii::$app->session->addFlash( 'error',"Error on deleting Groups " );

        return $this->redirect(['index']);
    }

    /**
     * Finds the Groups model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Groups the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
			$model = Groups::findOne($id);
	if ((isset(Yii::$app->params['ADMIN_CLIENT_ID']) and  Yii::$app->user->identity->clientID == Yii::$app->params['ADMIN_CLIENT_ID']))
		{
            return $model;
        }
		else
			throw new NotFoundHttpException('The requested page does not exist.');
		

    }
}
