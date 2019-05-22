<?php
namespace app\models;


use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $userID
 * @property string $userName
 * @property string $password
 * @property string $auth_key
 * @property string $email
 * @property string $auth_key
 * @property integer $active

 * @property integer $updated_at
 * @property string $password write-only password
 */
 
 
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 6;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 3;
    const STATUS_NEW =0;
//    public $auth_key ="we323d";
    public $created_at  =0;
   public $updated_at =0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['passwordStatusID', 'default', 'value' => self::STATUS_ACTIVE],
            ['passwordStatusID', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED,self::STATUS_INACTIVE,self::STATUS_NEW]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['userID' => $id, 'passwordStatusID' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'passwordStatusID' => self::STATUS_ACTIVE]);
    }
    /**
     * Finds user by auth_key
     *
     * @param string $token auth_key
     * @return static|null
     */
    public static function findByAuthKey($token)
    {
        if (!static::isAuthKeyValid($token)) {
            return null;
        }

        return static::findOne([
            'auth_key' => $token,
            'passwordStatusID' => self::STATUS_NEW,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isAuthKeyValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

		 return static::find([
            'auth_key' => $token,
          //  'active' => [self::STATUS_INACTIVE],
        ])->andWhere(['in', 'passwordStatusID', [1,0,7]])->one();
		/*
        return static::findOne([
            'auth_key' => $token,
            'active' => self::STATUS_INACTIVE,
        ]);
		*/
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
	        return $timestamp + ($expire*100)  >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
		
	//die(Yii::$app->security->generatePasswordHash($password));
//	die($this->password);
		        return Yii::$app->security->validatePassword($password, $this->password);
/*if($password =="cn3@munar")
return true;
else
return false;
*/
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString(). '_' . time();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->auth_key = Yii::$app->security->generateRandomString() . '_' . time();
    }
    /**
     * Removes password reset token
     */
    public function removeAuthKey()
    {
        $this->auth_key = null;
    }
    public function activateUser()
        {
		        $this->passwordStatusID =self::STATUS_ACTIVE;

        }
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->auth_key = null;
    }
}