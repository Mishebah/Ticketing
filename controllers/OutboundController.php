<?php

namespace app\controllers;

use Yii;
use app\models\Outbound;
use app\models\OutboundSearch;
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
 * OutboundController implements the CRUD actions for Outbound model.
 */
class OutboundController extends Controller
{
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
                          <li class="selected active">'. Html::a('Contact Lists<span class="fa arrow"></span>', ['/contact-list'],['class'=>'class=&#039;selected active&#039;']).'                          
							<ul class="active-menu">														
							<li>
							'. Html::a('-- New List <span class="glyphicon glyphicon-menu-right">', ['/contact-list/create'],['class'=>'active']).'                    
								</li>
								<li>
							'. Html::a('-- All Lists <span class="glyphicon glyphicon-menu-right">', ['/contact-list'],['class'=>'active']).'                    
								</li>
                            	</ul>
                          <li class="selected active">'. Html::a('Contact List Entries<span class="fa arrow"></span>', ['/contact-list-entries/index'],['class'=>'class=&#039;selected active&#039;']).'                          
							<ul class="active-menu">														
							<li>
							'. Html::a('-- Add Number to List <span class="glyphicon glyphicon-menu-right">', ['/contact-list-entries/create'],['class'=>'active']).'                    
								</li>
								<li>
							'. Html::a('-- All Numbers <span class="glyphicon glyphicon-menu-right">', ['/contact-list-entries/index'],['class'=>'active']).'                    
								</li>
                            	</ul>
                             </ul>
					</div>
				</div>';
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
     * Lists all Outbound models.
     * @return mixed
     */
    public function actionApi()
    {
                                if(!PermissionUtils::checkModuleActionPermission("Outbound",PermissionUtils::VIEW_ALL)){
                                throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        $searchModel = new OutboundSearch();
        $searchModel->priority =1 ;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->pagination = ['pageSize' => 100];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex()
    {
				if(!PermissionUtils::checkModuleActionPermission("Outbound",PermissionUtils::VIEW_ALL)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }	
        $searchModel = new OutboundSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->pagination = ['pageSize' => 100];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Outbound model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
				if(!PermissionUtils::checkModuleActionPermission("Outbound",PermissionUtils::VIEW_ONE)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



    /**
     * Finds the Outbound model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Outbound the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
					$model = Outbound::findOne($id);
	if($model == null)
			throw new NotFoundHttpException('The requested page does not exist.');
	if ((isset(Yii::$app->params['ADMIN_CLIENT_ID']) and  Yii::$app->user->identity->clientID == Yii::$app->params['ADMIN_CLIENT_ID']) or ($model->clientID == Yii::$app->user->identity->clientID))  {
            return $model;
        }
		else
			throw new NotFoundHttpException('The requested page does not exist.');

    }
}
