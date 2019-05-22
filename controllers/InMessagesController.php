<?php

namespace app\controllers;

use Yii;
use app\models\InMessages;
use app\models\InMessagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use app\components\CoreUtils;
use yii\db\Expression;
use app\components\PermissionUtils;
use app\components\StatusCodes;
use yii\web\ForbiddenHttpException;

/**
 * InMessagesController implements the CRUD actions for InMessages model.
 */
class InMessagesController extends Controller
{
    /**
     * @inheritdoc
     */
	public function beforeAction($action)
{
    Yii::$app->view->params['menu'] = '  <div class="navbar-default" role="navigation">
                    <div class="navbar-collapse collapse sidebar-navbar-collapse">
							<ul class="nav navbar-nav side-nav">
                            <li class="selected active">'. Html::a('Messages<span class="fa arrow"></span>', ['/broadcasts'],['class'=>'class=&#039;selected active&#039;']).'                          
							<ul class="active-menu">														
							<li>
							'. Html::a('-- New Message <span class="glyphicon glyphicon-menu-right">', ['//broadcasts/create'],['class'=>'active']).'                    
								</li>
								<li>
							'. Html::a('-- All Messages <span class="glyphicon glyphicon-menu-right">', ['/broadcasts/index'],['class'=>'active']).'                    
								</li>
                            </ul>
                          <li class="selected active">'. Html::a('Outbound<span class="fa arrow"></span>', ['/outbound/index'],['class'=>'class=&#039;selected active&#039;']).'                          
							<ul class="active-menu">														
							<li>
							'. Html::a('-- Outbound <span class="glyphicon glyphicon-menu-right">', ['/outbound/create'],['class'=>'active']).'                    
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
     * Lists all InMessages models.
     * @return mixed
     */
    public function actionIndex()
    {
				if(!PermissionUtils::checkModuleActionPermission("InMessages",PermissionUtils::VIEW_ALL)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }	
        $searchModel = new InMessagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InMessages model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		if(!PermissionUtils::checkModuleActionPermission("InMessages",PermissionUtils::VIEW_ONE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }		
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Finds the InMessages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return InMessages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
					$model = InMessages::findOne($id);
	if($model == null)
			throw new NotFoundHttpException('The requested page does not exist.');
	if ((isset(Yii::$app->params['ADMIN_CLIENT_ID']) and  Yii::$app->user->identity->clientID == Yii::$app->params['ADMIN_CLIENT_ID']) or ($model->clientID == Yii::$app->user->identity->clientID))  {
            return $model;
        }
		else
			throw new NotFoundHttpException('The requested page does not exist.');

    }
}
