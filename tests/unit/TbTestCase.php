<?php

require(__DIR__ . '/../../vendor/yiisoft/yii/tests/TestApplication.php');
require(__DIR__ . '/../../vendor/yiisoft/yii/framework/collections/CMap.php');

class TbTestCase extends \Codeception\TestCase\Test
{
    protected function mockApplication($config = array(), $appClass = 'TestApplication')
    {
        static $defaultConfig = array(
            'basePath' => __DIR__
        );
        Yii::createApplication(
            $appClass,
            CMap::mergeArray($defaultConfig, $config)
        );
    }

    protected function destroyApplication()
    {
        Yii::setApplication(null);
    }

    protected function _after()
    {
        $this->destroyApplication();
    }
}