<?php
// This is global bootstrap for autoloading 

// disable Yii error handling logic
defined('YII_ENABLE_EXCEPTION_HANDLER') or define('YII_ENABLE_EXCEPTION_HANDLER', false);
defined('YII_ENABLE_ERROR_HANDLER') or define('YII_ENABLE_ERROR_HANDLER', false);

require(__DIR__ . '/../vendor/yiisoft/yii/framework/yii.php');

$config = array(
    'basePath' => __DIR__ . '/../..',
    'aliases' => array(
        'bootstrap' => __DIR__ . '/..',
    ),
);

Yii::createWebApplication($config);