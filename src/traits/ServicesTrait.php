<?php
namespace concepture\yii2account\traits;

use concepture\yii2account\services\AccountOperationService;
use concepture\yii2account\services\AccountService;
use Yii;

/**
 * Trait ServicesTrait
 * @package concepture\yii2account\traits
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
trait ServicesTrait
{
    /**
     * @return AccountService
     */
    public function userAccountService()
    {
        return Yii::$app->accountService;
    }

    /**
     * @return AccountOperationService
     */
    public function userAccountOperationService()
    {
        return Yii::$app->accountOperationService;
    }
}

