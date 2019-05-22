<?php
namespace app\models;

use Yii;



class MainModel extends \yii\db\ActiveRecord 
{
	
public function beforeSave($insert)
{
	        if ($insert) :

$current_time = date('Y-m-d H:i:s');
if ( $this->isNewRecord ):
//  'insertedBy', 'dateCreated', 'updatedBy'
if($this->hasAttribute('dateCreated'))
$this->dateCreated = $current_time;
if($this->hasAttribute('dateModified'))
$this->dateModified = $current_time;

if($this->hasAttribute('createdBy')) // make sure user field name i user_id
$this->createdBy = yii::$app->user->identity->userID;

if($this->hasAttribute('insertedBy')) // make sure user field name i user_id
$this->insertedBy = yii::$app->user->identity->userID;

if($this->hasAttribute('updatedBy')) // make sure user field name i user_id
$this->updatedBy = yii::$app->user->identity->userID;

if($this->hasAttribute('clientID')) // make sure user field name i user_id
$this->clientID =  Yii::$app->user->identity->clientID ;

if($this->hasAttribute('uuid')) // make sure user field name i user_id
$this->uuid =$this->uniqidReal();

if($this->hasAttribute('active')) // make sure user field name i user_id
$this->active =1;

if($this->hasAttribute('status')) // make sure user field name i user_id
$this->status =1;


endif;
if (! $this->isNewRecord ):
if($this->hasAttribute('dateModified'))
$this->dateModified = $current_time;

if($this->hasAttribute('updatedBy')) // make sure user field name i user_id
$this->updatedBy = yii::$app->user->identity->userID;

endif;

endif;

return parent::beforeSave($insert);
}


function uniqidReal($lenght = 13) {
    // uniqid gives 13 chars, but you could adjust it to your needs.
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($lenght / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $lenght);
}

}
