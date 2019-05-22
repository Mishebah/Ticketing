<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User *///
//$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/setpassword', 'token' => $user->auth_key]);
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style ="width:100%;
		line-height:inherit;
		text-align:left;
		max-width:800px;
		margin:auto;
		padding:30px;
		border:1px solid #eee;
		box-shadow:0 0 10px rgba(0, 0, 0, .15);
		font-size:16px;
		 padding-bottom: 50px;
		 background:#eee;
		 border-bottom:1px solid #ddd;
		line-height:24px;
		border-spacing: 0px 10px;
		font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		color:#555;">
			<tr>
				<td colspan ="5">

								<p>Hello <b><?= Html::encode($user->userName) ?>,</b></p>
							&nbsp;
				</td>
			</tr>
			
	<tr>
				<td colspan ="5">

								  <p>Follow the link below to reset your password:</p>

    <p>
	<a href="<?= $resetLink ?>" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #256F9C; border-top: 15px solid #256F9C; border-bottom: 15px solid #256F9C; border-left: 25px solid #256F9C; border-right: 25px solid #256F9C; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;" class="mobile-button">Reset My Account Password
</a>
</p>
				</td>
			</tr>

		</table>
		