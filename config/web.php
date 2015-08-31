<?php
$params = require (__DIR__ . '/params.php');
use \kartik\datecontrol\Module;

$config = [ 
		'id' => 'basic',
		'basePath' => dirname ( __DIR__ ),
		'language' => 'th',
		'bootstrap' => [ 
				'log' 
		],
		'components' => [ 
				'utilsHelper' => [ 
						'class' => 'app\components\UtilsHelperComponent' 
				],
				'request' => [
						// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
						'cookieValidationKey' => '3989da4eb832867da1eb82598a780c37' 
				],
				'cache' => [ 
						'class' => 'yii\caching\FileCache' 
				],
				'user' => [ 
						'class' => 'amnah\yii2\user\components\User' 
				],
				'errorHandler' => [ 
						'errorAction' => 'site/error' 
				],
				'mailer' => [ 
						'class' => 'yii\swiftmailer\Mailer',
						'useFileTransport' => true,
						'messageConfig' => [ 
								'from' => [ 
										'admin@website.com' => 'Admin' 
								], // this is needed for sending emails
								'charset' => 'UTF-8' 
						] 
				],
				'log' => [ 
						'traceLevel' => YII_DEBUG ? 3 : 0,
						'targets' => [ 
								[ 
										'class' => 'yii\log\FileTarget',
										'levels' => [ 'info',
												'error',
												'warning' 
										] 
								] 
						] 
				],
				'db' => require (__DIR__ . '/db.php'),
				'view' => [ 
						'theme' => [ 
								'pathMap' => [ 
// 										'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app',
										'@vendor/amnah/yii2-user/views' => '@app/views/user'
								] 
						] 
				] 
		]
		,
		'params' => $params,
		'modules' => [ 
				'user' => [
						'class' => 'amnah\yii2\user\Module',
						'controllerMap' => [
								'default' => 'app\controllers\user\DefaultController',
								'admin' => 'app\controllers\user\AdminController',
						]
						// set custom module properties here ...
				],
				'gridview' => [ 
						'class' => '\kartik\grid\Module',
						// enter optional module parameters below - only if you need to
						// use your own export download action or custom translation
						// message source
						// 'downloadAction' => 'gridview/export/download',
						'i18n' => [ 
								'class' => 'yii\i18n\PhpMessageSource',
								'basePath' => '@kvgrid/messages',
								'forceTranslation' => true 
						] 
				] 
		]
		 
]
;

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config ['bootstrap'] [] = 'debug';
	$config ['modules'] ['debug'] = 'yii\debug\Module';
	
	$config ['bootstrap'] [] = 'gii';
	$config ['modules'] ['gii'] = 'yii\gii\Module';
}

return $config;
