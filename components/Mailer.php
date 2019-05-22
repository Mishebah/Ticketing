<?php
namespace app\components;
  
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\db\Expression;
use yii\helpers\Json;
use yii\httpclient\Client;
use app\components\StatusCodes;
use app\models\EmailQueue;
use app\models\Users;

class Mailer
{
public function sendEmail($email,$name,$subject,$url,$action)
{

			$model = new EmailQueue();
			$model->emailDestination =$email;
			$model->emailSubject = $subject;
			$model->emailFrom =  Yii::$app->params['adminEmail'];
			$model->emailMessage = Mailer::emailTemplate($url,$email,$name,$action);
			$model->active =1;
			$model->dateCreated = new Expression('NOW()');
			$model->insertedBy = isset(yii::$app->user->identity->userID)?yii::$app->user->identity->userID : 1;
			if($model->save())
{
Mailer::mail($model);
			return true;

}
			else
				return false;
			
	
	
}
private function mail($model)
{

$headers = "From: " . strip_tags($model->emailFrom) . "\r\n";
$headers .= "Reply-To: ". strip_tags($model->emailFrom) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
try{

mail($model->emailDestination, $model->emailSubject, $model->emailMessage, $headers);
}
 catch (Exception $e) 
{
//Yii::warning("Ooops...division by zero.");
	throw new BadRequestHttpException($e->getMessage(), 0, $e);
}
}

private function emailTemplate($url,$email,$name,$action)
{
	
$my_var = <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
	    <style type="text/css">
        /* CLIENT-SPECIFIC STYLES */
        #outlook a{padding:0;} /* Force Outlook to provide a "view in brows=
er" message */
        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotm=
ail to display emails at full width */
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalCla=
ss font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Forc=
e Hotmail to display normal line spacing */
        body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adj=
ust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes=
 */
        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove sp=
acing between tables in Outlook 2007 and up */
        img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of=
 resized image in Internet Explorer */

        /* RESET STYLES */
        body{margin:0; padding:0;}
        img{border:0; height:auto; line-height:100%; outline:none; text-dec=
oration:none;}
        table{border-collapse:collapse !important;}
        body{height:100% !important; margin:0; padding:0; width:100% !impor=
tant;}

        /* iOS BLUE LINKS */
        .appleBody a {color:#68440a; text-decoration: none;}
        .appleFooter a {color:#999999; text-decoration: none;}

        /* MOBILE STYLES */
        @media screen and (max-width: 525px) {

            /* ALLOWS FOR FLUID TABLES */
            table[class="wrapper"]{
                width:100% !important;
            }

            /* ADJUSTS LAYOUT OF LOGO IMAGE */
            td[class="logo"]{
                text-align: left;
                padding: 20px 0 20px 0 !important;
            }

            td[class="logo"] img{
                margin:0 auto!important;
            }

            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
            td[class="mobile-hide"]{
                display:none;}

            img[class="mobile-hide"]{
                display: none !important;
            }

            img[class="img-max"]{
                max-width: 100% !important;
                width: 100% !important;
                height:auto !important;
            }

            /* FULL-WIDTH TABLES */
            table[class="responsive-table"]{
                width:100%!important;
            }

            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
            td[class="padding"]{
                padding: 10px 5% 15px 5% !important;
            }

            td[class="padding-copy"]{
                padding: 10px 5% 10px 5% !important;
                text-align: center;
            }

            td[class="padding-meta"]{
                padding: 30px 5% 0px 5% !important;
                text-align: center;
            }

            td[class="no-pad"]{
                padding: 0 0 20px 0 !important;
            }

            td[class="no-padding"]{
                padding: 0 !important;
            }

            td[class="section-padding"]{
                padding: 50px 15px 50px 15px !important;
            }

            td[class="section-padding-bottom-image"]{
                padding: 50px 15px 0 15px !important;
            }

            /* ADJUST BUTTONS ON MOBILE */
            td[class="mobile-wrapper"]{
                padding: 10px 5% 15px 5% !important;
            }

            table[class="mobile-button-container"]{
                margin:0 auto;
                width:100% !important;
            }

            a[class="mobile-button"]{
                width:80% !important;
                padding: 15px !important;
                border: 0 !important;
                font-size: 16px !important;
            }

        }
    </style>
</head>
<body style="margin: 0; padding: 0;">
   
<!-- HEADER -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody><tr style="background-color:#03A9F4">
        <td bgcolor="#03A9F4">
            <div align="center" style="padding: 0px 15px 0px 15px;">
                <table border="0" cellpadding="0" cellspacing="0" width="500" class="wrapper">
                    <!-- LOGO/PREHEADER TEXT -->
                    <tbody><tr>
                        <td style="padding: 20px 0px 20px 0px;" class="logo">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody><tr>
                                    <td bgcolor="#03A9F4" width="100" align="center">
                                     
								   <a href="http://www.clarity.co.ke" target="_blank">
                                            <img alt="clarity" src="" width="214" height="70" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;" border="0">
                                        </a>
										
                                    </td>
                                </tr>
                                </tbody></table>
                        </td>
                    </tr>
                    </tbody></table>
            </div>
        </td>
    </tr>
    </tbody></table>

<!-- ONE COLUMN SECTION -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody><tr>
        <td bgcolor="#ffffff" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">
            <table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table">
                <tbody><tr>
                    <td>
                        <!-- HERO IMAGE -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td align="center" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvet=
ica, Arial, sans-serif; color: #666666;" class="padding-copy">
                                              Hello {$name}, click below to set {$action}.
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <!-- BULLETPROOF BUTTON -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                                        <tbody>
                                        <tr>
                                            <td align="center" style="padding: 25px 0 0 0;" class="padding-copy">
                                                <table border="0" cellspacing="0" cellpadding="0" class="responsive-table">
                                                    <tbody>
                                                    <tr>
                                                        <td align="center">

<a href="{$url}" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #256F9C; border-top: 15px solid #256F9C; border-bottom: 15px solid #256F9C; border-left: 25px solid #256F9C; border-right: 25px solid #256F9C; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;" class="mobile-button">{$action}
</a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <table width="500" border="0" cellspacing="0" cellpadding="10" align="center" class="responsive-table">
                                        <tbody>
                                        <tr>
                                            <td align="center" style="f=
ont-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
                                                <span class="original-only" style="font-family: Arial, sans-serif; font-size: 12px; color: #444444=
;">Please <b>DO NOT</b> click activate, if you did not create this account. Email us at </span><a style="color: #666666; text-decoration: none;" href="mailto:support@clarity.co.ke">support@clarity.co.ke</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody></table>
                    </td>
                </tr>
                </tbody></table>
        </td>
    </tr>
    </tbody></table>
	<!-- FOOTER -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody><tr>
        <td bgcolor="#ffffff" align="center" style="padding: 20px 0px;">
            <!-- UNSUBSCRIBE COPY -->
            <table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="responsive-table">
                <tbody><tr>
                    <td align="center" style="font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
                        <span class="appleFooter" style="color:#666666;"></span><br><a class="original-only" href="http://clarity.co.ke" style="color: #666666=
; text-decoration: none;">Visit Us</a><span class="original-only" style="font-family: Arial, sans-serif; font-size: 12px; color: #444444;">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span><a style="color: #666666; text-decoration: none;" href="mailto:support@clarity.co.ke">Email Us</a>
                    </td>
                </tr>
                </tbody></table>
        </td>
    </tr>
    </tbody></table>
</body>
</html>

EOD;
return $my_var ;
}

}
