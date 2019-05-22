<?php

namespace app\controllers;

use Yii;
use app\models\Campaign;
use app\models\CCodes;
use app\models\CCodeentries;
use yii\web\UploadedFile;
use app\models\CampaignSearch;
use yii\web\Controller;
use app\models\CCodesSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\widgets\ActiveForm;
use app\models\RPaymentSettings;
use app\components\StatusCodes;
use yii\helpers\Html;
use yii\web\ForbiddenHttpException;
use app\components\CoreUtils;
use app\components\PermissionUtils;
use yii2tech\spreadsheet\Spreadsheet;
/**
 * CampaignController implements the CRUD actions for Campaign model.
 */
class CampaignController extends Controller
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

    /**
     * Displays a single Campaign model.
     * @param integer $id
     * @return mixed
     */
   public function actionView($id)
    {
		 $model = $this->findModel($id);
	  
	        $confirmDataProvider = new ActiveDataProvider([
           // 'query' => Confirmation::find()->where('campaignID = :campaignID', [':campaignID' => $model->campaignID])
		
		 ]);
		 $competitionEntries = new ActiveDataProvider([
            'query' => CCodes::find()->where('campaignID = :campaignID', [':campaignID' => $model->campaignID])
		
		 ]);
		 $codesDP = new ActiveDataProvider([
            'query' => CCodes::find()->where('campaignID = :campaignID', [':campaignID' => $model->campaignID])
		
		 ]);
		 
		 $searchModel = new CCodesSearch();
     
      $ccmodel = new CCodes();
		
        return $this->render('view', [
            
            'model' => $model, "codesDP" =>$codesDP,"ccmodel" =>$ccmodel,"competitionEntries" =>$competitionEntries,"searchModel" => $searchModel

			 ]);

    }

    /**
     * Creates a new Campaign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Campaign();
        $model ->campaignType =2;
        
         if ($model->load(Yii::$app->request->post())) {
	         $time = microtime(true); // time in Microseconds
				$model->cImage = UploadedFile::getInstance($model, 'cImage');
			        if ($model->validate()) {
				$file = UploadedFile::getInstance($model, 'cImage');
               
				 	$filename = yii::$app->user->identity->clientID."_".yii::$app->user->identity->clientID."_".$time. '.' . $file->extension;
                    $model->cImage->saveAs('uploads/' .$filename);
                  
					$model->campaignImage =  $filename;
				     
                     if ($model->save())                     
                 return $this->redirect(['view', 'id' => $model->campaignID]);
      
                    }}
            return $this->render('create', [
                'model' => $model
            ]);
        
    }
    public function actionCodes($id)
    {
        
                $model = new RPaymentSettings();
                $campaignModel = $this->findModel($id);
                
        $model->dateCreated =  new Expression('NOW()');
        $model->campaignID=     $campaignModel->campaignID;
        $model->settingName =   $campaignModel->campaignName;
        $model->settingType  =  2;
        $model->scenario="code-create"; 
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
            return $this->renderAjax('codes', [
             'campaignModel' => $campaignModel,
                'model' => $model,
            ]);
        }}
    public function actionMessage($id)
    {
        
                $model = new RPaymentSettings();
                $campaignModel = $this->findModel($id);
                
        $model->dateCreated =  new Expression('NOW()');
        $model->campaignID=     $campaignModel->campaignID;
        $model->settingName =   $campaignModel->campaignName;
        $model->settingType  =  2;
        $model->scenario="message_update"; 
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
            return $this->renderAjax('message', [
             'campaignModel' => $campaignModel,
                'model' => $model,
            ]);
        }}
        
        
        
        
        
      public function actionSinglecode($id)
    {
		
		        $model = new CCodes();
				$campaignModel = $this->findModel($id);
				
		$model->dateCreated =  new Expression('NOW()');
		$model->campaignID= 	$campaignModel->campaignID;
		$model->settingName = 	$campaignModel->campaignName;
		$model->type  = 	1 ;
	$model->scenario="singlecode-create";
    
    
    
  if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return \yii\widgets\ActiveForm::validate($model);
    }
   
        if ($model->load(Yii::$app->request->post())  & $model->validate()) {{
          $codes = explode(",",$model->singleCode);
          
          $length = count($codes);
         
           $model->cCount = $length;
            
  $codes = array_unique($codes);
$codes =  array_filter($codes); 

   $transaction = Yii::$app->db->beginTransaction();
		if(sizeof($codes) > 0)
		{
try {
	$savedRecs = 0;
	$model->insertedBy= yii::$app->user->identity->userID;
      $model->updatedBy=  yii::$app->user->identity->userID;
     $model->dateCreated = new Expression('NOW()');
	 $model->status = StatusCodes::ACTIVE;
	  $model->clientID =  yii::$app->user->identity->clientID;
	 if($model->save())
   
	 {
		 $savedRecs = 0;
		 //we have the numbers now we add the values per chunk 
		 
        $chunks = array_chunk($codes, 1000);
        foreach ($chunks as $chunk) //Execute multiple queries
        {
          foreach($chunk as $num)
			$insArr[] = [$model->codeID,yii::$app->user->identity->clientID,1,$num,yii::$app->user->identity->userID,yii::$app->user->identity->userID,new Expression('NOW()')];
      
      
		 $savedRecs += \Yii::$app->db->createCommand()
  ->batchInsert("cCodeEntries",["cCodeID","clientID","type","code","insertedBy","updatedBy","dateCreated"],$insArr)->execute();
				$insArr =null;
		
          }
	
	if($savedRecs >0)
	{
	  $transaction->commit();
	  	Yii::$app->session->addFlash( 'success',"New List Added   $model->settingName  Total Records ". sizeof($codes) ."  Saved Records  ".$savedRecs . " | " .(microtime(true) - $time) . ' Seconds elapsed'  );
   return $this->redirect(['view', 'id' => $model->campaignID]);
	}
	else
	{
	Yii::$app->session->addFlash( 'error',"Unable to save record  $model->settingName  Total Records ". sizeof($codes) ."  Saved Records  ".$savedRecs. " | ".(microtime(true) - $time) . ' Seconds elapsed' );
		    $transaction->rollBack();

  return $this->redirect(['view', 'id' => $model->campaignID]);
	}		 
	 }
   
	
} catch (Exception $e) 
{
    $transaction->rollBack();
	throw new BadRequestHttpException($e->getMessage(), 0, $e);
}
}
else
{
	Yii::$app->session->addFlash( 'error',"Unable to save record  $model->settingName  List is empty");
	
}
}
}
return $this->renderAjax('singlecode',
                         [
            'model' => $model,
        ]);
    }

          
        
    
    
    
    
    public function  actionCodeupload($id)
    {
		   
        $model = new CCodes();
        $campaignModel = $this->findModel($id);
        $model->dateCreated =  new Expression('NOW()');
		$model->campaignID= 	$campaignModel->campaignID;
		$model->settingName = 	$campaignModel->campaignName;
		$model->type  = 	1 ;
$model->scenario="code-upload";
     if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post() )) {
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      return \yii\widgets\ActiveForm::validate($model);
     }
      if ($model->load(Yii::$app->request->post())) {
    
	$time = microtime(true); // time in Microseconds
				$model->codeupload  = UploadedFile::getInstance($model, 'codeupload');
			        if ($model->validate()) {
          
				$time = time();
				 $file = UploadedFile::getInstance($model, 'codeupload');
				 	$filename = yii::$app->user->identity->clientID."_".yii::$app->user->identity->userID."_".$time. '.' . $file->extension;
                    $model->codeupload->saveAs('cuploads/' .$filename);
                    $model->originalFileName = $file->baseName . '.' . $file->extension;
					$model->generatedFileName =  $filename;
				   $codes =[];
           
				 if($file->extension =='csv' )
				 {
                     $handle = fopen("cuploads/".$model->generatedFileName, "r");
										
		                     while (($fileop = fgetcsv($handle, 1000, ",")) !== false) 
                     {
					    $code = $fileop[0];
										$codes[] = $code;
                     }
				 }
         elseif($file->extension =='xls' or $file->extension=='xlsx')
				 {
try {
	$data = \moonland\phpexcel\Excel::widget([
  'mode' => 'import', 
  'fileName' => "cuploads/".$model->generatedFileName, 
  'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
  'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
  //'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
 ]);

         //foreach ($data as $key=>$value) {//Execute multiple queries
//$newArray = array_values($value);
$newArray = []; 
foreach ($data as $key) 
{ 
    foreach ($key as $value) 
    { 
    $newArray[] = $value; 
    } 
}

$codes=$newArray;
     

	//if(isset($newArray[0]))

	//{		$code = ($newArray[0]);

					//	if   ($code!=0)
					//	$codes[] = $code;
             
          
	//}
  
      //  }
         
        
} catch (Exception $e) 
{
	throw new BadRequestHttpException($e->getMessage(), 0, $e);
}
}
         
      				
					 //we have removed duplicates now we chaunch it and add some values to it then split it back 
					 $codes = array_unique($codes);
$codes =  array_filter($codes); 

   $transaction = Yii::$app->db->beginTransaction();
		if(sizeof($codes) > 0)
		{
try {
	$savedRecs = 0;
	$model->insertedBy= yii::$app->user->identity->userID;
      $model->updatedBy=  yii::$app->user->identity->userID;
     $model->dateCreated = new Expression('NOW()');
	 $model->status = StatusCodes::ACTIVE;
	  $model->clientID =  yii::$app->user->identity->clientID;
	 if($model->save())
	 {
		 $savedRecs = 0;
		 //we have the numbers now we add the values per chunk 
		 
        $chunks = array_chunk($codes, 1000);
        foreach ($chunks as $chunk) //Execute multiple queries
        {
          foreach($chunk as $num)
			$insArr[] = [$model->codeID,yii::$app->user->identity->clientID,1,$num,yii::$app->user->identity->userID,yii::$app->user->identity->userID,new Expression('NOW()')];
      
      
		 $savedRecs += \Yii::$app->db->createCommand()
  ->batchInsert("cCodeEntries",["cCodeID","clientID","type","code","insertedBy","updatedBy","dateCreated"],$insArr)->execute();
				$insArr =null;
		
          }
	
	if($savedRecs >0)
	{
	  $transaction->commit();
	  	Yii::$app->session->addFlash( 'success',"New List Added   $model->settingName  Total Records ". sizeof($codes) ."  Saved Records  ".$savedRecs . " | " .(microtime(true) - $time) . ' Seconds elapsed'  );
   return $this->redirect(['view', 'id' => $model->campaignID]);
	}
	else
	{
	Yii::$app->session->addFlash( 'error',"Unable to save record  $model->settingName  Total Records ". sizeof($codes) ."  Saved Records  ".$savedRecs. " | ".(microtime(true) - $time) . ' Seconds elapsed' );
		    $transaction->rollBack();

  return $this->redirect(['view', 'id' => $model->campaignID]);
	}		 
	 }
   
	
} catch (Exception $e) 
{
    $transaction->rollBack();
	throw new BadRequestHttpException($e->getMessage(), 0, $e);
}
}
else
{
	Yii::$app->session->addFlash( 'error',"Unable to save record  $model->settingName  List is empty");
	
}
}
else
{
print_r($model->getErrors());
  die(":fadfad");

}}
return $this->renderAjax('codeupload',
                         [
            'model' => $model,
        ]);
    }

    
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
    
    
    public function actionCodegenerate($id)
   {
		
		        $model = new CCodes();
				$campaignModel = $this->findModel($id);
				
		$model->dateCreated =  new Expression('NOW()');
		$model->campaignID= 	$campaignModel->campaignID;
		$model->settingName = 	$campaignModel->campaignName;
		$model->type  = 	1 ;
		$model->scenario="code-generate"; 
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
            return $this->renderAjax('codegenerate', [
			 'campaignModel' => $campaignModel,
                'model' => $model,
            ]);
        }
		
    
    }
    

    

    /**
     * Deletes an existing Campaign model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Campaign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Campaign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Campaign::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
