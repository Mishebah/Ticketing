<?php
namespace App\lib;
 
/**
 * AppRouter class is invoked from the index.php file
 *  does the routing for the request.
 *
 * PHP VERSION 7.0
 *
 * @category  PAYMENT GATEWAY
 * @package   BenchMark
 * @copyright 2017 Gravity Limited Ltd
 * @license   Proprietory License
 * @link      http://gravity.co.ke
 */
class AppRouter{ 
    /**
     * This function routes requests to a specific action in a controller using
     * yii format.
     *
     * @author George
     *
     * @return bool
     */
    public function router() {
        $controller = null;
        $action = null;

        //echo "hi: <pre>";print_r($_GET['url']);$getURL = rtrim($_GET['url'], '/');$url = explode('/', $getURL);print_r($url);echo " :end";die;
        if (isset($_GET['url'])) {
            $getURL = rtrim($_GET['url'], '/');
            $url = explode('/', $getURL);
            if (isset($url[0])) {
                $controller = ucfirst($url[0]);
            } else {
                trigger_error(
                    "No controller specified in the request", E_USER_ERROR
                );
            }
            if (isset($url[1])) {
                $action = $url[1];
            } else {
                trigger_error(
                    "No action specified in the request for the class: "
                    . $controller, E_USER_ERROR
                );
            }
        } else {
            trigger_error(
                "No query string specified in the request", E_USER_ERROR
            );
        }
		 $controller.="Handler";

$file = 'app' . DS . 'src' . DS . 'RequestHandler' . DS . $controller . '.php';

        // Check if the file exists
        if (file_exists($file)) {
		//	$this->autoload('AppRouter');
            require_once $file;

            $instance = new $controller();
            $instance->processRequest($action);

            return false;
        } else {
            trigger_error('No controller specified in the request !', E_USER_ERROR);
        }
        return true;
    }

}
