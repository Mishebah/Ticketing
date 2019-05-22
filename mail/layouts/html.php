<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php $this->head() ?>
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
        body{margin:0; padding:0; font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;}

        table{border-collapse:collapse !important; }
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
                text-align: center;
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
                padding: 100px 5% 10px 5% !important;
                text-align: right;
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
    <?php $this->beginBody() ?>
	
	<body style="margin: 0; padding: 0;">
    <?= $content ?>
	
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody><tr>
        <td bgcolor="#ffffff" align="center" style="padding: 10px 15px 70px 15px;" class="section-padding">
            <table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table">
                <tbody><tr>
                    <td>
                        <!-- HERO IMAGE -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">
                                    <table width="500" border="0" cellspacing="0" cellpadding="10" align="center" class="responsive-table">
                                        <tbody>
                                        <tr>
                                            <td align="center" style="f=
ont-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;">
                                                <span class="original-only" style="font-family: Arial, sans-serif; font-size: 12px; color: #444444=
;">Please <b>DO NOT</b> click, if you did not request this email. Email us at </span><a style="color: #666666; text-decoration: none;" href="mailto:info@percap.co.ke">info@percap.co.ke</a>
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

    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>
