<?php
namespace app\models;//call te inbuilt class to create model objects.
use Yii;
use yii\base\Model;
use app\components\StatusCodes;
use  yii\web\Session;
use app\config\db;
/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;
	private $_userModules = array();

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)){
                $this->addError($attribute, 'Incorrect username or password');
            }
           }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
		
        return $this->_user;
    }
	    private function setUserModules() {

          /*
				allow all permissions for Admin user 
				*/
	  /* if (isset(Yii::$app->params['ADMIN_USER_ID']) and yii::$app->user->identity->userID == Yii::$app->params['ADMIN_USER_ID']) {
            return true;
        } 
		*/
		//select m.moduleID from users u join userGroups ug using(userID) join permissions p using (groupID) join modulesActions ma using (moduleActionID) join modules m using(moduleID) where moduleName =:moduleName and entityActionID =:entityActionID and u.active = :uActive and ug.active = :ugActive and p.active = :pActive and ma.active = :maActive and m.active = :mActive
	$query = new \yii\Query();
$query	->select([
        'moduleName']
        )  
       ->from('users')
       ->innerJoin('userGroups','userGroups.userID = users.userID')		
       ->innerJoin('permissions','permissions.groupID = userGroups.groupID')	
       ->innerJoin('moduleActions','permissions.moduleActionID = moduleActions.moduleActionID')	
       ->innerJoin('modules','modules.moduleID = moduleActions.moduleID')
 		->andWhere(['users.userID' =>$this->_user->userID]) 
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

        foreach ($data as $module) {
            array_push($this->_userModules, strtolower($module['moduleName']));
        }
		
$session->set('modules',$this->_userModules);

    }
}