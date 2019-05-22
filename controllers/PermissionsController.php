<?php

namespace app\controllers;

use Yii;
use app\models\Permissions;
use app\models\PermissionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\PermissionUtils;
use yii\web\ForbiddenHttpException;
use yii\helpers\Html;
use yii\db\Expression;
use app\components\StatusCodes;
use app\components\CoreUtils;
/**

/**
 * PermissionsController implements the CRUD actions for Permissions model.
 */
class PermissionsController extends Controller
{
			 			public function beforeAction($action)
{
				if(PermissionUtils::checkModuleActionPermission("Permissions",PermissionUtils::VIEW_ALL)){

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
     * Lists all Permissions models.
     * @return mixed
     */
    public function actionIndex()
    {
					if(!PermissionUtils::checkModuleActionPermission("Permissions",PermissionUtils::VIEW_ALL)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }	
        $searchModel = new PermissionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Creates a new Permissions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
		if(!PermissionUtils::checkModuleActionPermission("Permissions",PermissionUtils::CREATE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        $model = new Permissions();
		  if ($model->load(Yii::$app->request->post()))
		  {
		if(isset($_REQUEST['save']))
		{
	
					$model->insertedBy= yii::$app->user->identity->userID;
					$model->updatedBy=  yii::$app->user->identity->userID;
					$model->dateCreated = new Expression('NOW()');
					$model->active = StatusCodes::ACTIVE;
					   $transaction = Yii::$app->db->beginTransaction();
				
					try {
								$savedRecs= 0;
								$duplicates=0;
						//if(strlen(trim($model->entityActionID))>1)
						Permissions::updateAll(['active'=>6],"active = 1 and moduleID = $model->moduleID and groupID = $model->groupID and entityActionID not in (".join(",",$model->entityActionID).")");
				
		$errors =[];
	
					foreach($model->entityActionID as $action){
							 if(!Permissions::find()->where(['entityActionID'=>$action,'active'=>1,'moduleID'=>$model->moduleID,'groupID'=>$model->groupID])->exists())
							{
								echo $action."|";
							$model->permissionID=null;
							$model->isNewRecord = true;
							$model->entityActionID=$action;
							
							if($model->save())
								{
							$savedRecs++;
								}

						}
						else
						{
							$duplicates++;
						}
					}
	
					// $transaction->commit();
			if($savedRecs >0)
		{
	  $transaction->commit();
	  	Yii::$app->session->addFlash( 'success',"Permissions Assigned to group. Saved Permissions are $savedRecs  Duplicate permisions are $duplicates"  );
   return $this->redirect(['index']);

	}
	else
	{
		if($duplicates>0)
	Yii::$app->session->addFlash( 'error',"Unable to assign permissions. all the records selected are duplicates" );
else
{
	print_r($errors );
		Yii::$app->session->addFlash( 'error',"Unable to assign permissions. " );
	    $transaction->rollBack();
}
 // return $this->redirect(['index']);
	}	
	

			} catch (Exception $e) 
{
	
    $transaction->rollBack();
	throw new BadRequestHttpException($e->getMessage(), 0, $e);
	
}
}

		
 }
        return $this->render('create', [
            'model' => $model,
        ]);
    }



    /**
     * Deletes an existing Permissions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		   if(!PermissionUtils::checkModuleActionPermission("Permissions",PermissionUtils::DELETE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
         $model = $this->findModel($id);
      $model->updatedBy=  yii::$app->user->identity->userID;
	 $model->active = StatusCodes::DELETE;
	 
	 if($model->save())
	 	Yii::$app->session->addFlash( 'success',"Permission has been deleted " );
		else
		Yii::$app->session->addFlash( 'error',"Error on deleting Permission " );

        return $this->redirect(['index']);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Permissions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Permissions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
			$model = Permissions::findOne($id);
	if ((isset(Yii::$app->params['ADMIN_CLIENT_ID']) and  Yii::$app->user->identity->clientID == Yii::$app->params['ADMIN_CLIENT_ID']))
		{
            return $model;
        }
		else
			throw new NotFoundHttpException('The requested page does not exist.');
		

    }
}
