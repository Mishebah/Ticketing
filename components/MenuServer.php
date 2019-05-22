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
use app\models\UserPasswordRequest;
use app\models\Users;
use yii\helpers\Url;
use yii\web\Request;
/**
 * This class serves the menu for the application
 * UI depending on the user status and permissions
 *
 */
class MenuServer
{

 
    /**
     * Default menu Function, for all who have not
     */
    public static function defaultMenu() {
        //construct the menu items
        $menu = '<ul class="nav pull-right">
                <li>' . Html::a('<i class="icon-off icon-black"></i> ' . Yii::t(Yii::app()->language,
                    'Login'), array(
                '/site/login')) . '</li>
            </ul>';
        return $menu;
    }
    //Function to return the menu list WITH PERMISSIONS
    private static function menuListTop($module, $menuLabel, $link, $class = '',$target='') {
        $list = NULL;
		//               $topmenu_li.=self::menuListTop("sPayments", 'Payments',         Yii::app()->createAbsoluteUrl('sPayments/admin',array()),'');
		//               				<?= Html::a('Payments Platform', ['/'], ['class'=>'simple-text logo-normal']) 

        if (PermissionUtils::checkModulePermission($module)) {
            if ($class == '') {
                if($target==''){
                    $list.='<li class="nav-item">' . Html::a($menuLabel, [$link],['class'=>'nav-link','style'=>"font-weight:bold;"]) . '</li>';
                }else{
                    $list.='<li class="nav-item">'.Html::a($menuLabel, [$link],['class'=>'nav-link']).'</li>';
                }

            } else {
                if($target==''){
                    $list.=Html::a($menuLabel, [$link],['class'=>'dropdown-item']) ;
                }else{
                    $list.='<li class="nav-item">'.Html::a($menuLabel, [$link],['class'=>$class]).'</li>';
                }

            }
        }
        return $list;
    }
    //Function to return the menu list WITH PERMISSIONS
    private static function menuList($module, $menuLabel, $link, $class = '') {
        $list = NULL;
        if (PermissionUtils::checkModulePermission($module)) {
            if ($class == '') {
                $list.='<li>' . Html::a($menuLabel, $link) . '</li>';
            } else {
                $list.='<li>' . Html::a('<span class="' . $class . '"></span>' . $menuLabel,
                        $link) . '</li>';
            }
        }
        return $list;
    } 


    public static function guestMenu() {
        $guestMenu = '<div class="col-md-8">';
        if (!Yii::app()->user->isGuest) :
            $loggedInMenu .= MenuServer::topMenu();
        endif;
        $guestMenu .= '</div>';
        $guestMenu .= '<div class="col-md-4">';
        if (!Yii::app()->user->isGuest) :
            if (Yii::app()->user->isSetup() || Yii::app()->user->isSuper()) {
                $guestMenu .= MenuServer::sideMenu();
            } else {
                $guestMenu .= MenuServer::clientSideMenu();
            }
        endif;
        $guestMenu .= '</div>';

        return $guestMenu;
    }

    /**
     * Logged in function to display menu for logged in users
     */
    public static function loggedInMenu($isSignUp = false) {
        $loggedInMenu = '';
        if (!Yii::$app->user->isGuest) {
            $loggedInMenu .= MenuServer::topMenu();
        } else {
            $loggedInMenu .= '';
        }
        $loggedInMenu .= '';
        $loggedInMenu .= '';
        if (!Yii::$app->user->isGuest) {
                $loggedInMenu .= MenuServer::sideMenu();

        } else {
            $loggedInMenu .= '';
         
        }

        $loggedInMenu .= '';

        return $loggedInMenu;
    }
    


    public static function topMenu() {

$url = Yii::$app->request->getAbsoluteUrl();
        $topmenu_li = '';
        $topmenu_li .= '<ul class="navbar-nav mr-auto">';
       // $topmenu_li.=self::menuListTop("site", 'Dashboard','site/', '');
        //Yii::app()->createUrl('default',array('dash'=>'channels'))
        $topmenu_li.=self::menuListTop("Broadcasts", 'Bulk Messages','broadcasts/','');
		        $topmenu_li.=self::menuListTop("BulkUploads", 'Bulk Upload Messages','bulk-uploads/','');

     $topmenu_li.=self::menuListTop("ContactLists", 'Contact Lists','contact-lists/','');
     $topmenu_li.=self::menuListTop("Inbox", 'Inbox','in-messages/','');
	 $topmenu_li.=self::menuListTop("outbound", 'Outbox','outbound/','');

        if (PermissionUtils::checkModulePermission("creditAllocation") or PermissionUtils::checkModulePermission("CreditConsumption") ) {
        $topmenu_li.= ' <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight:bold;" >Credit</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink1">';
		   $topmenu_li.=self::menuListTop("CreditConsumption", 'Credit Consumption','credit-consumption/','dropdown-item');
		   $topmenu_li.=self::menuListTop("CreditAllocation", 'Credit Allocation','credit-allocation/','dropdown-item');	
                $topmenu_li.= ' </div>
            </li> ';
		}
		
	$topmenu_li.=self::menuListTop("reports", 'Reports','reports/','');
	//         $list.='<li class="nav-item">' . Html::a($menuLabel, [$link],['class'=>'nav-link']) . '</li>';
   if (PermissionUtils::checkModulePermission("Settings")) {
        $topmenu_li.= ' <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight:bold;" >Settings</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">';
		   $topmenu_li.=self::menuListTop("services", 'services','services/','dropdown-item');
		   $topmenu_li.=self::menuListTop("servicekeywords", 'service keywords','service-keywords/','dropdown-item');
		    $topmenu_li.=self::menuListTop("sourceAddress", 'Source Address','source-addresses/','dropdown-item');
	    $topmenu_li.=self::menuListTop("Networks", 'Network Configs','networks/','dropdown-item');
		  $topmenu_li.=self::menuListTop("clients", 'clients','clients/','dropdown-item');
		   $topmenu_li.=self::menuListTop("users", 'users','users/','dropdown-item');
		   $topmenu_li.=self::menuListTop("apiusers", 'API Users','api-users/','dropdown-item');
		    $topmenu_li.=self::menuListTop("groups", 'groups','groups/','dropdown-item');  
			$topmenu_li.=self::menuListTop("permissions", 'permissions','permissions/','dropdown-item');  			
                $topmenu_li.= ' </div>
            </li> ';
   }
			$topmenu_li.='</ul>';
		
         ////dynamically build menu values
        return $topmenu_li;
    }
   
    public static function sideMenu() {
        $sidemenu_li = '';	
        ///pass the values that the application values have been passed here
        ///all those values have been stored in a session which when it dies the user
        ///will have logged out
        $sidemenu_li.= '<ul class="nav navbar-nav navbar-right">';
        $sidemenu_li.= '<li class="dropdown">';
        $sidemenu_li.= '<a data-toggle="dropdown" class="dropdown-toggle" href="#" style="font-weight:bold;">
                            ' . yii::$app->user->identity->userName . '  <span class="caret"></span></a>';
        $sidemenu_li.= '<ul role="menu" class="dropdown-menu">
                            <span class="arrow top"></span> ';
        #Setup
        //$sidemenu_li.= '<li class="dropdown-header" style="' . $setupTabDisplay . '">SETUP</li>';
        #Profile
        //$sidemenu_li.= '<li class="dropdown-header">MY PROFILE</li>';
        $sidemenu_li.= '<li> ' . Html::a("My Profile",["users/profile"]) . '</li>';
        $sidemenu_li.= '<li> ' . Html::a("Change My Password",  \Yii::$app->urlManager->createAbsoluteUrl("users/change-password")) . '</li>';
		  $sidemenu_li.= '<li> ' . Html::a('<span class=\'glyphicon glyphicon-off\'></span> Logout',
    ['/site/logout'],
    ['class'=>'nav-link','style' => 'color: red;',"data-method"=>"post"]). '</li>
                                    </ul>
                                </li>';
        $sidemenu_li.= '</ul>';

      
        return $sidemenu_li;
        //<li class="dropdown-header" role="presentation">Dropdown header</li>
    }
}
?>

