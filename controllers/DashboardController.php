<?php
namespace app\controllers;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use app\components\CoreUtils;
use app\components\PermissionUtils;
class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
						if(!PermissionUtils::checkModuleActionPermission("Dashboard",PermissionUtils::VIEW_ALL)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
		
		 if(!isset(Yii::$app->user->identity->clientID))
			 	throw new ForbiddenHttpException('You are not allowed to perform this action.');
		
		 
		 
		if ( Yii::$app->user->identity->clientID == Yii::$app->params['ADMIN_CLIENT_ID'])  {
			
			return $this->adminDashboard();
		}
		else
		{
			return $this->clientDashboard();
		}

	}


private function clientDashboard()
{
	$connection = \Yii::$app->db;
/* $summaryStats = $connection->createCommand("select count(*)totalSMS,count(distinct(if(statuscode =1,outboundid,null)))success,count(distinct(if(statuscode =0,outboundid,null)))queued,count(distinct(if(statuscode not in (1,0),outboundid,null)))failed,count(distinct(if(datecreated > current_date() and statuscode =1,outboundid,null)))dsuccess,count(distinct(if(datecreated > current_date() and statuscode =0,outboundid,null)))dqueued,count(distinct(if(datecreated > current_date() and statuscode  not in (1,0),outboundid,null)))dfailed,count(distinct(if(datecreated > current_date(),outboundid,null)))dtotal  from outbound where datecreated  > date_format(current_date(),'%Y-%m-01') ")->queryAll();
*/
//broadcastStats
 $broadcastStats = $connection->createCommand("select  broadcastStatusName,count(*)schedules  from broadcasts join  broadcastStatus using(broadcastStatusID) where date(senttime) > current_date() and clientID =". Yii::$app->user->identity->clientID." group by broadcastStatusID")->queryAll();


 
//we need to llop through this 
$dailyStats = $connection->createCommand('select hour(dateCreated)hh, count(*) sent  from outbound where datecreated > current_date()  and clientID ='. Yii::$app->user->identity->clientID.'   group by  hh order by hh  ')->queryAll();
$subColumns = [];
$subResults = [];
foreach($dailyStats as $sub)
{
     $subColumns[] = $sub['hh'];
    $subResults['sent'][] = $sub['sent'];
}
$subColumns = json_encode(array_values(array_unique($subColumns)));

        return $this->render('index',['broadcastStats'=>$broadcastStats,"subResults"=>$subResults,"subColumns"=>$subColumns]);
}

private function adminDashboard()
{
	$connection = \Yii::$app->db;
/* $summaryStats = $connection->createCommand("select count(*)totalSMS,count(distinct(if(statuscode =1,outboundid,null)))success,count(distinct(if(statuscode =0,outboundid,null)))queued,count(distinct(if(statuscode not in (1,0),outboundid,null)))failed,count(distinct(if(datecreated > current_date() and statuscode =1,outboundid,null)))dsuccess,count(distinct(if(datecreated > current_date() and statuscode =0,outboundid,null)))dqueued,count(distinct(if(datecreated > current_date() and statuscode  not in (1,0),outboundid,null)))dfailed,count(distinct(if(datecreated > current_date(),outboundid,null)))dtotal  from outbound where datecreated  > date_format(current_date(),'%Y-%m-01') ")->queryAll();
*/

//we pick the 
//broadcastStats
 $broadcastStats = $connection->createCommand("select  broadcastStatusName,count(*)schedules  from broadcasts join  broadcastStatus using(broadcastStatusID) where date(senttime) =current_date() group by broadcastStatusID")->queryAll();
 
  $dailyStats = $connection->createCommand("select sourceAddress,count(*)totalSMS,count(distinct(if(statuscode =1,outboundid,null)))success,count(distinct(if(statuscode =0,outboundid,null)))queued,count(distinct(if(statuscode not in (1,0),outboundid,null)))failed from outbound where datecreated  > current_date() group by sourceAddress")->queryAll();
//we need to llop through this 
$dailyStats = $connection->createCommand('select hour(dateCreated)hh, count(*) sent  from outbound where datecreated > current_date()  group by  hh order by hh  ')->queryAll();
$subColumns = [];
$subResults = [];
foreach($dailyStats as $sub)
{
     $subColumns[] = $sub['hh'];
    $subResults['sent'][] = $sub['sent'];
}
$subColumns = json_encode(array_values(array_unique($subColumns)));

        return $this->render('index',['broadcastStats'=>$broadcastStats,"subResults"=>$subResults,"subColumns"=>$subColumns]);
}
public function actionCredits()
{
		 if(!isset(Yii::$app->user->identity->clientID))
			 	throw new ForbiddenHttpException('You are not allowed to perform this action.');
			$credits = CoreUtils::getClientCredit();
return $this->asJson(['success' => true, 'credits'=>$credits]);
			
}
public function actionStats()
{
	
							if(!PermissionUtils::checkModuleActionPermission("Dashboard",PermissionUtils::VIEW_ALL)){
				throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
		
		 if(!isset(Yii::$app->user->identity->clientID))
			 	throw new ForbiddenHttpException('You are not allowed to perform this action.');
		
		 
		 
		if ( Yii::$app->user->identity->clientID == Yii::$app->params['ADMIN_CLIENT_ID'])  {
			
		  $connection = \Yii::$app->db;
 $summaryStats = $connection->createCommand("select count(*)totalSMS,count(distinct(if(statuscode =1,outboundid,null)))success,count(distinct(if(statuscode =0,outboundid,null)))queued,count(distinct(if(statuscode not in (1,0),outboundid,null)))failed,count(distinct(if(datecreated > current_date() and statuscode =1,outboundid,null)))dsuccess,count(distinct(if(datecreated > current_date() and statuscode =0,outboundid,null)))dqueued,count(distinct(if(datecreated > current_date() and statuscode  not in (1,0),outboundid,null)))dfailed,count(distinct(if(datecreated > current_date(),outboundid,null)))dtotal  from outbound where datecreated  > date_format(current_date(),'%Y-%m-01') ")->queryAll();
return $this->asJson(['success' => true, 'results'=>$summaryStats[0]]);
		}
		else
		{  $connection = \Yii::$app->db;
 $summaryStats = $connection->createCommand("select count(*)totalSMS,count(distinct(if(statuscode =1,outboundid,null)))success,count(distinct(if(statuscode =0,outboundid,null)))queued,count(distinct(if(statuscode not in (1,0),outboundid,null)))failed,count(distinct(if(datecreated > current_date() and statuscode =1,outboundid,null)))dsuccess,count(distinct(if(datecreated > current_date() and statuscode =0,outboundid,null)))dqueued,count(distinct(if(datecreated > current_date() and statuscode  not in (1,0),outboundid,null)))dfailed,count(distinct(if(datecreated > current_date(),outboundid,null)))dtotal  from outbound where clientID = ".Yii::$app->user->identity->clientID." and datecreated  > date_format(current_date(),'%Y-%m-01') ")->queryAll();
return $this->asJson(['success' => true, 'results'=>$summaryStats[0]]);
		}
		


}
 
}
