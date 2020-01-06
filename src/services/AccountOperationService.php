<?php
namespace concepture\yii2account\services;

use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2logic\services\Service;
use concepture\yii2logic\services\traits\StatusTrait;
use concepture\yii2account\enum\AccountOperationTypeEnum;
use concepture\yii2account\forms\AccountForm;
use concepture\yii2account\forms\AccountOperationForm;
use concepture\yii2account\traits\ServicesTrait;
use Exception;

/**
 * Class AccountOperationService
 * @package concepture\yii2account\services
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class AccountOperationService extends Service
{
    use StatusTrait;
    use ServicesTrait;

    /**
     * Пополнение счета
     *
     * @param integer $user_id
     * @param double $sum
     * @param integer $currency
     * @param string $description
     * @return boolean
     * @throws Exception
     */
    public function refill($user_id, $sum, $currency, $description = null)
    {
        $account = $this->userAccountService()->getOneByCondition([
            'user_id' => $user_id,
            'currency' => $currency,
        ]);
        if (! $account){
            $accountForm = new AccountForm();
            $accountForm->user_id = $user_id;
            $accountForm->currency = $currency;
            $accountForm->status = 1;
            $account = $this->userAccountService()->create($accountForm);
        }

        return $this->doOperation($sum, $account, UserAccountOperationTypeEnum::REFILL, $description);
    }

    /**
     * Снятие со счета
     *
     * @param integer $user_id
     * @param double $sum
     * @param integer $currency
     * @param string $description
     * @return boolean
     * @throws Exception
     */
    public function writeOff($user_id, $sum, $currency, $description = null)
    {
        $account = $this->userAccountService()->getOneByCondition([
            'user_id' => $user_id,
            'currency' => $currency,
        ]);
        if (! $account){
            throw new Exception("account not exists");
        }

        if ($account->balance < $sum){
            throw new Exception("not enough balance");
        }

        return $this->doOperation($sum, $account, UserAccountOperationTypeEnum::WRITE_OFF, $description);
    }

    /**
     * Операция
     *
     * @param $sum
     * @param $account
     * @param $type
     * @param string $description
     * @return bool
     * @throws Exception
     */
    protected function doOperation($sum, $account, $type, $description = null)
    {
        $form = new AccountOperationForm();
        $form->type = $type;
        $form->currency = $account->currency;
        $form->sum = $sum;
        $form->status = 1;
        $form->account_id = $account->id;
        if ($description){
            $form->description = $description;
        }

        if (! $this->userAccountOperationService()->create($form))
        {
            throw new Exception("operation failed");
        }

        if ($type == UserAccountOperationTypeEnum::REFILL){
            $account->balance += $form->sum;
        }else{
            $account->balance -= $form->sum;
        }

        if (! $account->save(false)){
            throw new Exception("operation failed");
        }

        return true;
    }
}
