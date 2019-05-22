<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User *///
//$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/activate', 'token' => $user->auth_key]);
?>
<div class="password-reset">
    <p>Hello <b><?= Html::encode($user->username) ?>,</b>
	<br />
	Welcome to Percap's SMS Platform

	To get you started, we have populated your account with KES. <b><?=Yii::$app->params['DEFAULT_SETTINGS']['FREE_UNITS'];  ?> </b> worth of free credit. <br />You can use these credits to send messages to your phone number within minutes.

	</p>

    <p>Follow the link below to activate your account:</p>

    <p>
	<a href="<?= $resetLink ?>" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #256F9C; border-top: 15px solid #256F9C; border-bottom: 15px solid #256F9C; border-left: 25px solid #256F9C; border-right: 25px solid #256F9C; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;" class="mobile-button">Activate Account
</a>
</p>
</div>