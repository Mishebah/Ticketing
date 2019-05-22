<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@app/theme';
    public $baseUrl = '@web/theme';
   public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
 ];
	    public $css = [
	'assets/css/icons.min.css',
	'assets/css/app.min.css',
          ];
		  
				    public $js = [
		'assets/js/app.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\YiiAsset',
       'yii\bootstrap\BootstrapAsset',
	   'yii\bootstrap\BootstrapPluginAsset',
		
    ];
}

