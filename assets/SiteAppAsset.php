<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SiteAppAsset extends AssetBundle
{
    public $basePath = '@app/site';
    public $baseUrl = '@web/site';


	    public $css = [
	'css/bootstrap.min.css',
	'css/aos.css',
	'css/magnific-popup.css',
     'css/pe-icon-7-stroke.css',
	 'css/materialdesignicons.min.css',
		'css/style.css',
		'css/colors/default.css',
          ];
		  
		
 	    public $js = [

	//	'vendor/jquery/jquery.js',
		//'js/jquery-2.1.4.min.js',
		'js/bootstrap.min.js',
		'js/jquery.easing.1.3.min.js',
		'js/SmoothScroll.js',
		'js/aos.js',
		'js/jquery.magnific-popup.min.js',
		'js/jquery.sticky.js',
		'js/jquery.app.js',
    ];

    public $depends = [
      //  'yii\web\YiiAsset',
    //  'yii\bootstrap\BootstrapAsset',
	  //  'yii\bootstrap\BootstrapPluginAsset',
     //   'yii\bootstrap\BootstrapAsset',
    ];
}
