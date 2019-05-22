<?php
namespace app\components;
use app\models\Users;
use app\models\UsersGroups;
use app\models\Permissions;
use app\models\ModulesActions;
use app\models\Modules;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use  yii\web\Session;

use yii\db\Expression;
use yii\helpers\Json;

//select m.moduleID from users u join userGroups ug using(userID) join permissions p using (groupID) join modulesActions ma using (moduleActionID) join modules m using(moduleID) where moduleName =:moduleName and entityActionID =:entityActionID and u.active = :uActive and ug.active = :ugActive and p.active = :pActive and ma.active = :maActive and m.active = :mActive

class PermissionUtils
{

   
    const CREATE = 2;
    const UPDATE = 7;
    const DELETE = 4;
    const VIEW_ALL = 8;
    const VIEW_ONE =9;
	 const RESET_PASSWORD =6;
    /**
     * attribute views
     */
    const IS_VISIBLE = 1;
    const IS_EDITABLE = 1;

    /**
     * Checks to see if the user has set menu actions with view policies 
     * @param Array $userID 
     */
    public static function setUserModules() {
        
	$query = new \yii\db\Query();
$query	->select([
        'moduleName','entityActionID']
        )  
        ->from('users')
       ->innerJoin('userGroups','userGroups.userID = users.userID')		
       ->innerJoin('permissions','permissions.groupID = userGroups.groupID')	
       ->innerJoin('moduleActions','permissions.moduleActionID = moduleActions.moduleActionID')	
       ->innerJoin('modules','modules.moduleID = moduleActions.moduleID')
 		->andWhere(['users.userID' =>yii::$app->user->identity->userID]) 
	   ->andWhere(['users.active' => StatusCodes::ACTIVE])
	   ->andWhere(['userGroups.active' => StatusCodes::ACTIVE])
	   ->andWhere(['permissions.active' => StatusCodes::ACTIVE])
	   ->andWhere(['moduleActions.active' => StatusCodes::ACTIVE])
	   ->andWhere(['modules.active' => StatusCodes::ACTIVE])
        ->distinct(); 
	
$command = $query->createCommand();
$data = $command->queryAll();

$session = Yii::$app->session;
if ($session->isActive)
	$session->open();

$userModules  = array();
        foreach ($data as $module) {
            $userModules[$module['moduleName']][] = $module['entityActionID'];
        }
$session->set('modules',$userModules);
    }
  /**
     * Check that a user has permission to access a specific module
     * @param string $moduleName
     * @return boolean
     */
    public static function checkModuleActionPermission($moduleName,$action) {
		if (!isset(yii::$app->user->identity->clientID) or  (Yii::$app->user->isGuest))
			return false;
		
  if (isset(Yii::$app->params['ADMIN_USER_ID']) and yii::$app->user->identity->userID == Yii::$app->params['ADMIN_USER_ID'])  {
            return true;
        }
		
		
  $query = new \yii\db\Query();
$query  ->select([
        'users.userID']
        )
        ->from('users')
       ->innerJoin('userGroups','userGroups.userID = users.userID')
       ->innerJoin('permissions','permissions.groupID = userGroups.groupID')
         ->innerJoin('modules','modules.moduleID = permissions.moduleID')
           ->where(['moduleName' =>$moduleName])
           ->andWhere(['users.userID' =>yii::$app->user->identity->userID])
           ->andWhere(['users.active' => StatusCodes::ACTIVE])
           ->andWhere(['userGroups.active' => StatusCodes::ACTIVE])
           ->andWhere(['permissions.active' => StatusCodes::ACTIVE])
           ->andWhere(['passwordStatusID' => 1])
           ->andWhere(['modules.active' => StatusCodes::ACTIVE])
          // ->andWhere(['entityActionID' => $action])
        ->distinct();

$command = $query->createCommand();
$data = $command->queryOne();


if($data)
	return true;
else
	return false;

		
    }
	  /**
     * Check that a user has permission to access a specific module
     * @param string $moduleName
     * @return boolean
     */
    public static function checkModulePermission($moduleName) {
	
		if (!isset(yii::$app->user->identity->clientID) or  (Yii::$app->user->isGuest))
			return false;

     if (isset(Yii::$app->params['ADMIN_USER_ID']) and yii::$app->user->identity->userID == Yii::$app->params['ADMIN_USER_ID'])  {
            return true;
        }
		

		
  $query = new \yii\db\Query();
$query  ->select([
        'users.userID']
        )
        ->from('users')
       ->innerJoin('userGroups','userGroups.userID = users.userID')
       ->innerJoin('permissions','permissions.groupID = userGroups.groupID')
         ->innerJoin('modules','modules.moduleID = permissions.moduleID')
           ->where(['moduleName' =>$moduleName])
           ->andWhere(['users.userID' =>yii::$app->user->identity->userID])
           ->andWhere(['users.active' => StatusCodes::ACTIVE])
           ->andWhere(['userGroups.active' => StatusCodes::ACTIVE])
           ->andWhere(['permissions.active' => StatusCodes::ACTIVE])
           ->andWhere(['passwordStatusID' => 1])
           ->andWhere(['modules.active' => StatusCodes::ACTIVE])
           ->andWhere(['entityActionID' => self::VIEW_ALL])
        ->distinct();

$command = $query->createCommand();
$data = $command->queryOne();
if($data)
	return true;
else
	return false;

    }
    /**
     * Validate if module action/access is allowed
     */
    public static function validateAllowedActionAccess($actions, $moduleName) {
        //check if user is logged in
        if (Yii::$app->user->isGuest) {
                   $this->redirect(array('site/login'));
		}
			 if (isset(Yii::$app->params['ADMIN_USER_ID']) and yii::$app->user->identity->userID == Yii::$app->params['ADMIN_USER_ID']) {
            return true;
        }  
			   
      if (isset(Yii::$app->params['ADMIN_CLIENT_ID']) and  Yii::$app->user->identity->clientID == Yii::$app->params['ADMIN_CLIENT_ID']) {
            return true;
        }
		
		
		//select m.moduleID from users u join userGroups ug using(userID) join permissions p using (groupID) join modulesActions ma using (moduleActionID) join modules m using(moduleID) where moduleName =:moduleName and entityActionID =:entityActionID and u.active = :uActive and ug.active = :ugActive and p.active = :pActive and ma.active = :maActive and m.active = :mActive
		$query = new \yii\db\Query();
$query	->select([
        'users.userID']
        )  
        ->from('users')
       ->innerJoin('userGroups','userGroups.userID = users.userID')		
       ->innerJoin('permissions','permissions.groupID = userGroups.groupID')	
       ->innerJoin('moduleActions','permissions.moduleActionID = moduleActions.moduleActionID')	
       ->innerJoin('modules','modules.moduleID = moduleActions.moduleID')
	   ->where(['moduleName' =>$moduleName]) 
		->andWhere(['users.userID' =>yii::$app->user->identity->userID]) 
	   ->andWhere(['users.active' => StatusCodes::ACTIVE])
	   ->andWhere(['userGroups.active' => StatusCodes::ACTIVE])
	   ->andWhere(['permissions.active' => StatusCodes::ACTIVE])
	   ->andWhere(['moduleActions.active' => StatusCodes::ACTIVE])
	   ->andWhere(['modules.active' => StatusCodes::ACTIVE])
	   ->andWhere(['entityActionID' => $actions])		   
        ->distinct(); 
		
$command = $query->createCommand();
$data = $command->queryAll();
if($data and count($data)> 0)
return true;

return false;
}

  
    public static function populateDataChanges($tableInfo, $entityActionID, $schema, $changeLogID, $changeStateID, $cascadeInfo
    = NULL, $isMainModule = 1) {

        $response = array();

        try {

            if ($cascadeInfo != NULL) {

                $tableCount = sizeof($cascadeInfo);
                $tableCountCounter = 0;

                foreach ($cascadeInfo as $tableInfo) {

                    $sql = "SELECT * FROM  " . $tableInfo['TABLE'] . " WHERE "
                        . $tableInfo['PK_FIELD_NAME'] . " = "
                        . $tableInfo['PK_FIELD_VALUE'] . ";";
                    $command = Yii::app()->db->createCommand($sql);
                    $dataReader = $command->queryAll();
                    $tableCountCounter++;

                    foreach ($dataReader as $records) {
                        foreach ($records as $key => $value) {
                            $dataChanges = new DataChanges();
                            $dataChanges->changeLogID = $changeLogID;
                            $dataChanges->tablePKID = $tableInfo['PK_FIELD_VALUE'];
                            $dataChanges->column = $key;
                            $dataChanges->entityActionID = $entityActionID;
                            $dataChanges->newValue = NULL;
                            $dataChanges->oldValue = $value;
                            $dataChanges->schema = $schema;
                            $dataChanges->table = $tableInfo['TABLE'];
                            $dataChanges->changeStateID = $changeStateID;
                            //The main module table is always last in the list hence the condition below;
                            $dataChanges->isMainModule = ($tableCount == $tableCountCounter) ? 1 : 0;
                            $dataChanges->save();
                        }
                    }
                }
            }
            else {
                $sql = "SELECT * FROM  " . $tableInfo['TABLE'] . " WHERE "
                    . $tableInfo['PK_FIELD_NAME'] . " = "
                    . $tableInfo['PK_FIELD_VALUE'] . ";";
                $command = Yii::app()->db->createCommand($sql);
                $dataReader = $command->queryAll();

                foreach ($dataReader as $records) {
                    foreach ($records as $key => $value) {
                        $dataChanges = new DataChanges();
                        $dataChanges->changeLogID = $changeLogID;
                        $dataChanges->tablePKID = $tableInfo['PK_FIELD_VALUE'];
                        $dataChanges->column = $key;
                        $dataChanges->entityActionID = $entityActionID;
                        $dataChanges->newValue = NULL;
                        $dataChanges->oldValue = $value;
                        $dataChanges->schema = $schema;
                        $dataChanges->table = $tableInfo['TABLE'];
                        $dataChanges->changeStateID = $changeStateID;
                        $dataChanges->isMainModule = $isMainModule;
                        $dataChanges->save();
                    }
                }
            }


            $response['SUCCESS'] = TRUE;
            $response['REASON'] = 'Created the datachanges record successfully';
        } catch (Exception $exc) {

            $response['SUCCESS'] = FALSE;
            $response['REASON'] = self::DEFAULT_CHECKER_FAILURE_REASON
                . " <br> <b>DETAILS: </b><br>" . $exc->getMessage();
            CoreUtils::flog2('ERROR',
                "EXCEPTION: populateDataChanges($tableName, $tablePKID, "
                . "$tablePKField, $entityActionID, $schema, $changeLogID) <$exc> ");
        }

        return $response;
    }

    /**
     * Gets the state name given the state ID
     * @param int $stateID
     * @return string
     */
    private static function getStateNameFromID($stateID) {
        try {
            $model = EntityStates::model()->findByPk($stateID);
            if ($model) {
                return $model->entityStateName;
            }
            else {
                return "INVALID STATE";
            }
        } catch (Exception $exc) {
            return "INVALID STATE";
        }
    }

    /**
     * Gets the entity action name given the entity action ID
     * @param int $stateID
     * @return string
     */
    private static function getEntityActionNameFromID($entityActionID) {

        try {
            $model = EntityActions::model()->findByPk($entityActionID);
            if ($model) {
                return $model->entityActionName;
            }
            else {
                return "INVALID ACTION";
            }
        } catch (Exception $exc) {
            return "INVALID ACTION";
        }
    }

 

}

?>
