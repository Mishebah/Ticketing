<?php

namespace app\controllers;

use Yii;
use app\models\Reports;
use app\models\ReportsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\PermissionUtils;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\Html;
use yii\web\ForbiddenHttpException;


/**
 * ReportsController implements the CRUD actions for Reports model.
 */
class ReportsController extends Controller
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
     * Lists all Reports models.
     * @return mixed
     */
    public function actionIndex()
    {
						if(!PermissionUtils::checkModuleActionPermission("Reports",PermissionUtils::VIEW_ALL)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
      $dataProvider = new ActiveDataProvider([
            'query' => Reports::find(),
        ]);
 $model = new Reports();

 //we do pagination her 

		          if (isset($_REQUEST['Reports']) && !isset($_REQUEST['generateReport'])) {
					  $model->reportID =   $_REQUEST['Reports']['reportID'];
           return  $this->render('index', [
                'model' => $model, 'selectedReportID' => $_REQUEST['Reports']['reportID'],
            ]);
            exit;
 }


			
			

         if (isset($_REQUEST['Reports']) && isset($_REQUEST['generateReport'])) {
            //get values
            $reportID = $_REQUEST['Reports']['reportID'];
            if (strcmp($reportID, '') == 0 || $reportID == null) {
               // $response['REASON'] = 'Please select a report.';
               Yii::$app->session->addFlash('error', 'Please select a report.');
 return $this->render('index', [
            'dataProvider' => $dataProvider,
			'model'=>$model
        ]);                exit();
            }		
			 
           /*
		   Set correct reporttype Filter
		   $admin =1 
		   client = 2
		   
		   */
		$cond= ['reportID' => (int) $reportID, 'reportTypeID' => 1];
		if(yii::$app->user->identity->clientID != Yii::$app->params['ADMIN_CLIENT_ID'])
			$cond['reportTypeID']= 2 ;
		
		   	$model =Reports::findOne($cond);
			
			if(!$model or $model==null)
			{
				 $model = new Reports();

				
	 Yii::$app->session->addFlash('error', 'Please select a report.');
 return $this->render('index', [
            'dataProvider' => $dataProvider,
			'model'=>$model
        ]);                exit();
            }	
			
            $reportQuery = $model->reportQuery;
    
            $postData = $_REQUEST;
            unset($postData['Reports']);
			unset($postData['_csrf-backend']);
            unset($postData['generateReport']);
			/*IF not Admin, set the clientID to always be defined
			*/
		if(yii::$app->user->identity->clientID != Yii::$app->params['ADMIN_CLIENT_ID'])
			$postData['clientID'] = yii::$app->user->identity->clientID ;
		
            $queryStuff = $this->formulateFinalQuery($reportQuery, $postData);
            $formattedQuery = $queryStuff['finalQuery'];
            $params = $queryStuff['finalQueryParams'];
//                      $formattedQuery = $this->formulateFinalQuery($reportQuery, $postData);
           // $rows = $this->getRowCount($formattedQuery, $params);
            $reportName = $model->reportName;
            $reportTitle = $model->reportName;
            if (isset($_REQUEST['dateFrom'])) {
                $reportName.=": From date: " . $_REQUEST['dateFrom'] . "";
                $reportTitle.= " From date <span class='emTitle'>" . $_REQUEST['dateFrom'] . "</span>";
            }

            if (isset($_REQUEST['dateTo'])) {
                $reportName.=": to date: " . $_REQUEST['dateTo'] . "";
                $reportTitle.= ": to date <span class='emTitle'>" . $_REQUEST['dateTo'] . "</span>";
            }
			
			$connection = \Yii::$app->db;
$count = $connection->createCommand( "select count(*)as x from ($formattedQuery) as n")
      ->bindValues($params)->queryScalar();


				
				$dataProvider = new SqlDataProvider([
				'key' => 'id',
    'sql' =>$formattedQuery,
    'params' => $params,
   'totalCount' => $count,
    'pagination' => [
        'pageSize' => 100,
    ],
]);
         			return $this->render('index', [
         	'model'=>$model,
			 'sql' =>$formattedQuery,
             'params' => json_encode($params),
			'dataProvider'=>$dataProvider,
			'header' => $reportName,
            'title' => $reportTitle,
			'id' => 'transactionReport' . $model->reportID,
			'columns'=>explode(",", $model->reportOutputColumns)
        ]);
		
            exit();

			
			
		 }

        return $this->render('index', [
         	'model'=>$model
        ]);
    }
	 public function actionExport()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Reports::find(),
        ]);
 $model = new Reports();

 //we do pagination her 

		          if (isset($_REQUEST['Reports']) && !isset($_REQUEST['generateReport'])) {
					   Yii::$app->session->addFlash('error', 'No Records to export.');
					  $model->reportID =   $_REQUEST['Reports']['reportID'];
           return  $this->render('transaction', [
                'model' => $model, 'selectedReportID' => $_REQUEST['Reports']['reportID'],
            ]);
            exit;
 }
         if (isset($_REQUEST['Reports']) && isset($_REQUEST['generateReport'])) {
            //get values
            $reportID = $_REQUEST['Reports']['reportID'];
            if (strcmp($reportID, '') == 0 || $reportID == null) {
               // $response['REASON'] = 'Please select a report.';
               Yii::$app->session->addFlash('error', 'Please select a report.');
 return $this->render('transaction', [
            'dataProvider' => $dataProvider,
			'model'=>$model
        ]);                exit();
            }		
			 
           		$cond= ['reportID' => (int) $reportID, 'reportTypeID' => 1];
		if(yii::$app->user->identity->clientID != Yii::$app->params['ADMIN_CLIENT_ID'])
			$cond['reportTypeID']= 2 ;
		
		   	$model =Reports::findOne($cond);
						if(!$model or $model==null)
			{
				 $model = new Reports();

				
	 Yii::$app->session->addFlash('error', 'Please select a report.');
 return $this->render('index', [
            'dataProvider' => $dataProvider,
			'model'=>$model
        ]);                exit();
            }	
			
            $reportQuery = $model->reportQuery;
    
            $postData = $_REQUEST;
            unset($postData['Reports']);
			unset($postData['_csrf-backend']);
            unset($postData['generateReport']);
		if(yii::$app->user->identity->clientID != Yii::$app->params['ADMIN_CLIENT_ID'])
			$postData['clientID'] = yii::$app->user->identity->clientID ;
		
            $queryStuff = $this->formulateFinalQuery($reportQuery, $postData);
			//print_r( $queryStuff);

            $formattedQuery = $queryStuff['finalQuery'];
            $params = $queryStuff['finalQueryParams'];

//                      $formattedQuery = $this->formulateFinalQuery($reportQuery, $postData);
           // $rows = $this->getRowCount($formattedQuery, $params);
            $reportName = $model->reportName;
            $reportTitle = $model->reportName;
            if (isset($_REQUEST['dateFrom'])) {
                $reportName.=": From date: " . $_REQUEST['dateFrom'] . "";
                $reportTitle.= " From date <span class='emTitle'>" . $_REQUEST['dateFrom'] . "</span>";
            }

            if (isset($_REQUEST['dateTo'])) {
                $reportName.=": to date: " . $_REQUEST['dateTo'] . "";
                $reportTitle.= ": to date <span class='emTitle'>" . $_REQUEST['dateTo'] . "</span>";
            }
			
$connection = \Yii::$app->db;
$data = $connection->createCommand($formattedQuery)
         ->bindValues($params)->queryAll();
  $filename = $model->reportName.".csv";
	  header("Content-Disposition: attachment; filename=\" $filename\"");
        header("Content-Type: text/csv; charset=utf-8");
		$output = fopen('php://output', 'w');

		fputcsv($output, array($reportName));
        fputcsv($output, array("Total Records: " , count($data)));
		
$columns = explode(",", $model->reportOutputColumns);
fputcsv($output, $columns);

if(count($data)> 0)
{
	foreach($data as $row)
	fputcsv($output, $row);
}
   		
//we have the columns now we export the data 

}
	else
	{
		 Yii::$app->session->addFlash('error', 'No Records to export.');
					  $model->reportID =   $_REQUEST['Reports']['reportID'];
          return  $this->render('transaction', [
                'model' => $model, 'selectedReportID' => $_REQUEST['Reports']['reportID'],
            ]);
			
	}
	}
private function formulateFinalQuery($reportsql, $post) {
        //fetch Mnemonics list
        //get post values
        //replace the placeholders with POST values
        //return final Query
        //ALLOWED MNEMONICS
        //DATETO,DATEFROM
        $hashMap = array();
		$finalQueryParams = array();
       // CoreUtils::flog2('SEQUEL', "POST::::" . CoreUtils::printArray($post));
        foreach ($post as $hash => $value) {
            $hash = "^" . strtoupper($hash) . "^";
            $hashMap[$hash] = $value;
        }

        //replace in the query
        $finalQuery = $reportsql;
        foreach ($hashMap as $key => $value) {
			$pos = strrpos($reportsql,$key );

		if ($pos == true) {	
            if (isset($value)) {
                //we have to create parametized queries to prevent SQL injection
                $param = ":" . str_replace('^', '', $key);
                $val = "'" . $value . "'";
                $keyToReplace = "'" . $key . "'";
                $finalQuery = str_replace($keyToReplace, $param, $finalQuery);
                $finalQueryParams[$param] = $value;
            }
		}
        }
        $finalStuff['finalQuery'] = $finalQuery;
        $finalStuff['finalQueryParams'] = $finalQueryParams;
        
        return $finalStuff;
    }
    

    /**
     * Finds the Reports model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Reports the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
$model = Reports::findOne($id);
		if ((isset(Yii::$app->params['ADMIN_CLIENT_ID']) and  Yii::$app->user->identity->clientID == Yii::$app->params['ADMIN_CLIENT_ID']))
		{
            return $model;
        }
		else
			throw new NotFoundHttpException('The requested page does not exist.');
		
    }
}
