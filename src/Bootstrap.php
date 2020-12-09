<?php
namespace concepture\yii2account;

use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    //Метод, который вызывается автоматически при каждом запросе
    public function bootstrap($app)
    {
        //загружаем компоненты
        $components  = require __DIR__ . '/config/component.php';
        Yii::$app->setComponents($components);
    }
}