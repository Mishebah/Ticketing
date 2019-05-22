<?php

namespace app\controllers;

use Yii;
use app\models\Campaign;
use app\models\CampaignSearch;
use app\models\CampainRequests;
use app\models\Users;
use app\models\Confirmation;
use app\models\CDraws;
use app\models\CDrawsSearch;
use app\models\RPaymentSettings;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use app\components\PermissionUtils;
use yii\web\ForbiddenHttpException;
use app\models\Raffleorders;
use app\models\RaffleOrdersSearch;
use app\models\Raffleordertickets;
use yii\helpers\Html;
use app\components\StatusCodes;
use app\components\CoreUtils;
use yii\data\ActiveDataProvider;
use app\models\Permissions;

/**
 * CampaignController implements the CRUD actions for Campaign model.
 */
class RafflesController extends Controller
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
     * Lists all Campaign models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CampaignSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

   /**public function actionOrders($id)
    {
       $model = Campaign::findAll();

       if($model == null)
      throw new NotFoundHttpException('The requested page does not exist.');
  if ((isset(Yii::$app->params['ADMIN_CLIENT_ID']) and  Yii::$app->campaign->identity->clientID == Yii::$app->params['ADMIN_CLIENT_ID']) or ($model->clientID == Yii::$app->campaign->identity->clientID))  {
            return $model;
            }
    else
      throw new NotFoundHttpException('The requested page does not exist.');
    
    }
    }**/



	    public function actionApi($id)
    {
		
		        $model = new RPaymentSettings();
				$campaignModel = $this->findModel($id);
				
		$model->dateCreated =  new Expression('NOW()');
		$model->campaignID= 	$campaignModel->campaignID;
		$model->settingName = 	$campaignModel->campaignName;
		$model->settingType  = 	1 ;
		$model->scenario="api-create"; 
  if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return \yii\widgets\ActiveForm::validate($model);
    }	
        if ($model->load(Yii::$app->request->post())) {
					
if( $model->save())
			{
				 	Yii::$app->session->addFlash( 'success',"Settings added to item" );
          return $this->redirect(['view', 'id' => $model->campaignID]);
			}
			else
			{
				Yii::$app->session->addFlash( 'success',"Error | ". json_encode($model->getErrors()));
           return $this->redirect(['view', 'id' => $model->campaignID]);
			}
        } else {
            return $this->renderAjax('api', [
			 'campaignModel' => $campaignModel,
                'model' => $model,
            ]);
        }
		
      


    }
public function actionWebhook($id)
    {

     $model = new Confirmation();
        $campaignModel = $this->findModel($id);
        
   
    $model->campaignID=   $campaignModel->campaignID;
       $model->settingType  =  1 ;
    $model->scenario="webhook-create"; 
  if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return \yii\widgets\ActiveForm::validate($model);
    } 
        if ($model->load(Yii::$app->request->post())) {
          
if( $model->save())
      {
          Yii::$app->session->addFlash( 'success',"Settings added to item" );
          return $this->redirect(['view', 'id' => $model->campaignID]);
      }
      else
      {
        Yii::$app->session->addFlash( 'success',"Error | ". json_encode($model->getErrors()));
           return $this->redirect(['view', 'id' => $model->campaignID]);
      }
        } else {
            return $this->renderAjax('webhook', [
       'campaignModel' => $campaignModel,
                'model' => $model,
            ]);
        }
    
      


    }

    public function actionRequest($id)
    {
    
            $model = new Confirmation();
        $campaignModel = $this->findModel($id);
        
    $model->dateCreated =  new Expression('NOW()');
    $model->campaignID=   $campaignModel->campaignID;
    $model->settingName =   $campaignModel->campaignName;
    $model->settingType  =  1 ;
    $model->scenario="request-code"; 
  if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return \yii\widgets\ActiveForm::validate($model);
    } 
        if ($model->load(Yii::$app->request->post())) {
          
if( $model->save())
      {
          Yii::$app->session->addFlash( 'success',"Thank you!Settings Recieved" );
          return $this->redirect(['view', 'id' => $model->campaignID]);
      }
      else
      {
        Yii::$app->session->addFlash( 'success',"Error | ". json_encode($model->getErrors()));
           return $this->redirect(['view', 'id' => $model->campaignID]);
      }
        } else {
            return $this->renderAjax('requestt', [
       'campaignModel' => $campaignModel,
                'model' => $model,
            ]);
        }
    }
	
		    public function actionMpesa($id)
    {
		
		        $model = new RPaymentSettings();
				$campaignModel = $this->findModel($id);
				
		$model->dateCreated =  new Expression('NOW()');
		$model->campaignID= 	$campaignModel->campaignID;
		$model->settingName = 	$campaignModel->campaignName;
		$model->settingType  = 	3 ;
		$model->scenario="mpesa-create"; 
  if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return \yii\widgets\ActiveForm::validate($model);
    }	
        if ($model->load(Yii::$app->request->post())) {
					
if( $model->save())
			{
				 	Yii::$app->session->addFlash( 'success',"Settings added to item" );
          return $this->redirect(['view', 'id' => $model->campaignID]);
			}
			else
			{
				Yii::$app->session->addFlash( 'success',"Error | ". json_encode($model->getErrors()));
           return $this->redirect(['view', 'id' => $model->campaignID]);
			}
        } else {
            return $this->renderAjax('mpesa', [
			 'campaignModel' => $campaignModel,
                'model' => $model,
            ]);
        }
		
      


    }

     public function actionConfig($id)
    {
        
                $model = new CampainRequests();
                $campaignModel = $this->findModel($id);
                
        $model->dateCreated =  new Expression('NOW()');
        $model->campaignID=     $campaignModel->campaignID;
        $model->settingName =   $campaignModel->campaignName;
        $model->settingType  =  2;
        $model->scenario="paybill-create"; 
  if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return \yii\widgets\ActiveForm::validate($model);
    }   
        if ($model->load(Yii::$app->request->post())) {
                    
if( $model->save())
            {
                    Yii::$app->session->addFlash( 'success',"Thank You! Request Recieved" );
          return $this->redirect(['view', 'id' => $model->campaignID]);
            }
            else
            {
                Yii::$app->session->addFlash( 'success',"Error | ". json_encode($model->getErrors()));
           return $this->redirect(['view', 'id' => $model->campaignID]);
            }
        } else {
            return $this->renderAjax('customconfig', [
             'campaignModel' => $campaignModel,
                'model' => $model,
            ]);
        }}
    /**
     * Displays a single Campaign model.
     * @param string $id
     * @return mixed
    * */
    public function actionView($id)
    {
		 $model = $this->findModel($id);
	  
	        $confirmDataProvider = new ActiveDataProvider([
            'query' => Confirmation::find()->where('campaignID = :campaignID', [':campaignID' => $model->campaignID])
		
		 ]);
		 $paymentDataProvider = new ActiveDataProvider([
            'query' => CampainRequests::find()->where('campaignID = :campaignID', [':campaignID' => $model->campaignID])
		
		 ]);
		 $orderDataProvider = new ActiveDataProvider([
            'query' => RaffleOrders::find()->where('campaignID = :campaignID', [':campaignID' => $model->campaignID])
		
		 ]);
		 
		 $searchModel = new RaffleOrdersSearch();
		//campainrequestsjoinWith(': CampainRequests')->
		
        return $this->render('view', [
            
            'model' => $model, "confirmDataProvider" =>$confirmDataProvider,"paymentDataProvider" =>$paymentDataProvider,"orderDataProvider" =>$orderDataProvider,"searchModel" => $searchModel

			 ]);

    }
	    public function actionOrderview($id)
    {
		 $model = RaffleOrders::findOne($id);
  $ticketDataProvider = new ActiveDataProvider([
            'query' => RaffleOrderTickets::find()->where('orderID = :orderID AND status =:status', [':orderID' => $model->orderID,"status"=>1])
        ]);
 
	 
		
        return $this->render('ordersview', [
                            'model' => $model, "ticketDataProvider" =>$ticketDataProvider
			 ]);

    }
	
/**
      *Creates a new Campaign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Campaign();
        $model ->campaignType =1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->campaignID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	    public function actionDraw()
    {
        $model = new CDraws();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['draw', 'id' => $model->campaignID]);
        } else {
            return $this->render('draw', [
                'model' => $model,
            ]);
        }
    }
	
public function actionActivity()
  {
        $searchModel = new CampaignSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Campaign model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->campaignID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Campaign model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionStop($id)
    {


      $model = $this->findModel($id);
      $model->updatedBy=  yii::$app->user->identity->userID;
   $model->status
    = StatusCodes::INACTIVE;
    
   // $model->passwordStatusID = 6;

   if($model->save())
    Yii::$app->session->addFlash( 'success',"Users has been deleted " );
    else
    Yii::$app->session->addFlash( 'error',"Error on deleting Users " );

        return $this->redirect(['index']);
       // $model = $this->findModel($id)->delete();

        //return $this->redirect(['index']);
    }

    /**
     * Finds the Campaign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Campaign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
		$model = Campaign::findOne($id);
			if($model == null)
			throw new NotFoundHttpException('The requested page does not exist.');
	if ($model->clientID == Yii::$app->user->identity->clientID)  {
            return $model;
        }
		else
			throw new NotFoundHttpException('The requested page does not exist.');

    }
}
