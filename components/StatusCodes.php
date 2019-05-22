<?php
namespace app\components;
  
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

use yii\db\Expression;
use yii\helpers\Json;
use yii\httpclient\Client;

class StatusCodes
{

//Service Statuses
//1.One Time PIN
    const OTP_GENERATED_OK = 198;
    const PIN_RESET = 207;
    //PIN Status

	const ACTIVE =1;
	const CREATED =2;
	const INACTIVE =3;
	const REJECTED =4;
	const DELETED =6;
	const _NULL =5;
	
	const ENTITY_STATES = [1=>"ACTIVE",2=>"CREATED",3=>"INACTIVE",4=>"REJECTED",5=>"NULL",6=>"DELETED"];


}

?>