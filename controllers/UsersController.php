<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\web\ForbiddenHttpException;

use app\models\Users;
use app\models\UserGroups;
use app\models\UsersSearch;
use app\models\PasswordStatuses;
use app\models\ChangePassword;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use app\components\StatusCodes;
use app\components\CoreUtils;
use app\components\Mailer;

use app\components\PermissionUtils;

use yii\db\Query;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
	 			public function beforeAction($action)
{
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
                            <li class="selected active">'. Html::a('Source Address<span class="fa arrow"></span>', ['/source-addresses/index'],['class'=>'class=&#039;selected active&#039;']).'                          
							<ul class="active-menu">												
							<li>
							'. Html::a('-- New Source Address<span class="glyphicon glyphicon-menu-right">', ['/source-addresses/create'],['class'=>'active']).'                    
								</li>
								<li>
							'. Html::a('-- All Source Addresses <span class="glyphicon glyphicon-menu-right">', ['/source-addresses/index'],['class'=>'active']).'                    
								</li>
                            	</ul>
                          <li class="selected active">'. Html::a('Services  <span class="fa arrow"></span>', ['/services/index'],['class'=>'class=&#039;selected active&#039;']).'                          
							<ul class="active-menu">												
							<li>
							'. Html::a('--Create service <span class="glyphicon glyphicon-menu-right">', ['/services/create'],['class'=>'active']).'                    
								</li>
								<li>
							'. Html::a('--Services <span class="glyphicon glyphicon-menu-right">', ['/services/index'],['class'=>'active']).'                    
								</li>
                            	</ul>

                             </ul>
					</div>
				</div>';
  //return true;
  return parent::beforeAction($action);
}
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
		        				if(!PermissionUtils::checkModuleActionPermission("Users",PermissionUtils::VIEW_ALL)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
								   if(!PermissionUtils::checkModuleActionPermission("Users",PermissionUtils::VIEW_ONE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        } 
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	    public function actionProfile()
    {
								   if(!PermissionUtils::checkModuleActionPermission("Users",PermissionUtils::VIEW_ONE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        } 
		if(isset(yii::$app->user->identity->userID))
		{
        return $this->render('view', [
            'model' => $this->findModel(yii::$app->user->identity->userID),
        ]);
		}
		else
		throw new ForbiddenHttpException('You are not allowed to perform this action.');

    }
	

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if(!PermissionUtils::checkModuleActionPermission("Users",PermissionUtils::CREATE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        $model = new Users();
		$userGroupsmodel = new UserGroups();

        if (($model->load(Yii::$app->request->post()) && $model->validate()) && ($userGroupsmodel->load(Yii::$app->request->post()) && $userGroupsmodel->validate())) 
		{	
	$model->createdBy= $userGroupsmodel->insertedBy= yii::$app->user->identity->userID;
      $model->updatedBy= $userGroupsmodel->updatedBy= yii::$app->user->identity->userID;
     $model->dateCreated = $userGroupsmodel->dateCreated =  new Expression('NOW()');
	 $model->active = $userGroupsmodel->active = StatusCodes::ACTIVE;
	$model->passwordStatusID = PasswordStatuses::PASSWORD_STATUS_NEW_USER;
	$model->auth_key = Yii::$app->security->generateRandomString(). '_' . time();
	$model->active = StatusCodes::INACTIVE;

	$connection = \Yii::$app->db;
    $transaction = $connection->beginTransaction();
	try {
	if( $model->save())
	{
		//we have saved a new user now lets save the usergroups 
		$userGroupsmodel->userID =  $model->userID;
		if(!$userGroupsmodel->save())
		{
	Yii::$app->session->addFlash( 'error', "Error Experienced saving transactions");
		$transaction->rollback();
		            return $this->redirect(['index']);

		}
  return Yii::$app
            ->mailer
            ->compose(
//                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
               ['html' => 'passwordResetToken-html'],
                ['user' => $model]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->emailAddress)
            ->setSubject('Password RESET for ' . Yii::$app->name)
            ->send();

	}
	    $transaction->commit();

	} catch (\Exception $e) {
    $transaction->rollBack();
   	Yii::$app->session->addFlash('error', "Error Experienced saving transactions".$e->getMessage());

} catch (\Throwable $e) {
    $transaction->rollBack();
	//Yii::$app()->session->addFlash('error', "Error Experienced saving transactions".$e->getMessage());
		   Yii::$app->session->addFlash( 'error','Error Experienced saving transactionss'.$e->getMessage() );
            return $this->redirect(['index']);

}
	
		   Yii::$app->session->addFlash( 'success',"New user $model->userName Created " );

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,'userGroups'=>$userGroupsmodel,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		if(!PermissionUtils::checkModuleActionPermission("Users",PermissionUtils::UPDATE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
		
        $model = $this->findModel($id);
		$userGroupsmodel =  UserGroups::find()->where(['userID'=>$id,'active'=>1])->one();
//we find the group that is active 
//we now fund the the users who 
    if (($model->load(Yii::$app->request->post()) && $model->validate()) && ($userGroupsmodel->load(Yii::$app->request->post()) && $userGroupsmodel->validate())) 
		{	
  $model->updatedBy= $userGroupsmodel->updatedBy= yii::$app->user->identity->userID;
  	$connection = \Yii::$app->db;
    $transaction = $connection->beginTransaction();

	try {
	if( $model->save())
	{
		//we have saved a new user now lets save the usergroups 
		$userGroupsmodel->userID =  $model->userID;
		if(!$userGroupsmodel->save())
		{
	Yii::$app->session->addFlash( 'error', "Error updating the user details");
		$transaction->rollback();
	return $this->redirect(['index']);

		}

	}
	    $transaction->commit();

	} catch (\Exception $e) {
    $transaction->rollBack();
   	Yii::$app->session->addFlash('error', "Error Experienced saving transactions".$e->getMessage());

} catch (\Throwable $e) {
    $transaction->rollBack();
	//Yii::$app()->session->addFlash('error', "Error Experienced saving transactions".$e->getMessage());
		   Yii::$app->session->addFlash( 'error','Error Experienced saving transactionss'.$e->getMessage() );
            return $this->redirect(['index']);

}
	
		   Yii::$app->session->addFlash( 'success',"User $model->userName updated " );
            return $this->redirect(['index']);
			
        } else {
            return $this->render('update', [
                'model' => $model,'userGroups'=>$userGroupsmodel
            ]);
        }
    }

	    public function actionChangepassword()
    {
 if(!PermissionUtils::checkModuleActionPermission("Users",PermissionUtils::UPDATE) or (!isset(yii::$app->user->identity->userID))){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }	
        try {
             $model = new ChangePassword(yii::$app->user->identity->userID);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

		
		        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {
            Yii::$app->session->addFlash('success', 'New password was saved.');
            return $this->goHome();
        }
		
	


                    return $this->render('changePassword', [
						'model' => $model
					]);
    }
	
    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
 if(!PermissionUtils::checkModuleActionPermission("Users",PermissionUtils::DELETE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }	
      $model = $this->findModel($id);
      $model->updatedBy=  yii::$app->user->identity->userID;
	 $model->active = StatusCodes::INACTIVE;
	  $model->passwordStatusID = 6;

	 if($model->save())
	 	Yii::$app->session->addFlash( 'success',"Users has been deleted " );
		else
		Yii::$app->session->addFlash( 'error',"Error on deleting Users " );

        return $this->redirect(['index']);
    }
	
       public function actionReset($id)
    {
 if(!PermissionUtils::checkModuleActionPermission("Users",PermissionUtils::RESET_PASSWORD)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }	
      $model = $this->findModel($id);
      $model->updatedBy=  yii::$app->user->identity->userID;
	 $model->active = StatusCodes::INACTIVE;
	$model->passwordStatusID = 7;
	$model->auth_key = Yii::$app->security->generateRandomString(). '_' . time();

	 if($model->save())
	 {
	 	Yii::$app->session->addFlash( 'success',"User password has been reset. Please check Email to set the password  " );
		$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/set-password', 'token' => $model->auth_key]);
		
			/*	$passwordRequest = Mailer::sendEmail($model->emailAddress,$model->userName,"RESET PASSWORD",$resetLink ,"SET PASSWORD");
				if($passwordRequest ==null)
					{
			Yii::$app->session->addFlash('error', "Error Experienced saving transactions");
	        return $this->redirect(['index']);

				}
				*/
				   Yii::$app
            ->mailer
            ->compose(
//                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
               ['html' => 'passwordResetToken-html'],
                ['user' => $model]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($model->emailAddress)
            ->setSubject('Password RESET for ' . Yii::$app->name)
            ->send();
	 }
		else
		Yii::$app->session->addFlash( 'error',"Error on reset password".json_encode($model->getErrors()) );

        return $this->redirect(['index']);
    }   /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
$model = Users::findOne($id);
	if($model == null)
			throw new NotFoundHttpException('The requested page does not exist.');
	if ((isset(Yii::$app->params['ADMIN_CLIENT_ID']) and  Yii::$app->user->identity->clientID == Yii::$app->params['ADMIN_CLIENT_ID']) or ($model->clientID == Yii::$app->user->identity->clientID))  {
            return $model;
        }
		else
			throw new NotFoundHttpException('The requested page does not exist.');
		
    }
}
