<?php

namespace concepture\yii2account\enum;

use Yii;
use concepture\yii2logic\enum\Enum;

/**
 * Виды операции с аккаунтами пользователей
 *
 * Class AccountOperationTypeEnum
 * @package concepture\yii2account\enum
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class AccountOperationTypeEnum extends Enum
{
    const REFILL = 1;
    const WRITE_OFF = 0;

    public static function labels()
    {
        return [
            self::REFILL => Yii::t('account', "Пополнение"),
            self::WRITE_OFF => Yii::t('account', "Списание"),
        ];
    }
}
