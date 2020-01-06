<?php
namespace concepture\yii2account\services;

use concepture\yii2account\models\Account;
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
     * @param integer $entity_id
     * @param integer $entity_type_id
     * @param string $payment_system_transaction_number
     * @param integer $payment_system_transaction_status
     * @param double $sum
     * @param integer $currency_id
     * @param string $description
     * @return boolean
     * @throws Exception
     */
    public function refill($entity_id, $entity_type_id, $payment_system_transaction_number, $payment_system_transaction_status, $sum, $currency_id, $description = null)
    {
        $account = $this->accountService()->getOneByCondition([
            'entity_id' => $entity_id,
            'entity_type_id' => $entity_type_id,
            'currency_id' => $currency_id,
        ]);
        if (! $account){
            $accountForm = new AccountForm();
            $accountForm->entity_id = $entity_id;
            $accountForm->entity_type_id = $entity_type_id;
            $accountForm->currency_id = $currency_id;
            $accountForm->status = 1;
            $account = $this->userAccountService()->create($accountForm);
        }

        return $this->doOperation($payment_system_transaction_number, $payment_system_transaction_status, $sum, $account, AccountOperationTypeEnum::REFILL, $description);
    }

    /**
     * Снятие со счета
     *
     * @param integer $entity_id
     * @param integer $entity_type_id
     * @param string $payment_system_transaction_number
     * @param integer $payment_system_transaction_status
     * @param double $sum
     * @param integer $currency_id
     * @param string $description
     * @return boolean
     * @throws Exception
     */
    public function writeOff($entity_id, $entity_type_id, $payment_system_transaction_number, $payment_system_transaction_status, $sum, $currency_id, $description = null)
    {
        $account = $this->accountService()->getOneByCondition([
            'entity_id' => $entity_id,
            'entity_type_id' => $entity_type_id,
            'currency_id' => $currency_id,
        ]);
        if (! $account){
            throw new Exception("account not exists");
        }

        if ($account->balance < $sum){
            throw new Exception("not enough balance");
        }

        return $this->doOperation($payment_system_transaction_number, $payment_system_transaction_status, $sum, $account, AccountOperationTypeEnum::WRITE_OFF, $description);
    }

    /**
     * Операция
     *
     * @param string $payment_system_transaction_number
     * @param integer $payment_system_transaction_status
     * @param double $sum
     * @param Account $account
     * @param integer $type
     * @param string $description
     * @return bool
     * @throws Exception
     */
    protected function doOperation($payment_system_transaction_number, $payment_system_transaction_status, $sum, $account, $type, $description = null)
    {
        $form = new AccountOperationForm();
        $form->type = $type;
        $form->payment_system_transaction_number = $payment_system_transaction_number;
        $form->payment_system_transaction_status = $payment_system_transaction_status;
        $form->sum = $sum;
        $form->account_id = $account->id;
        if ($description){
            $form->description = $description;
        }

        if (! $this->accountOperationService()->create($form))
        {
            throw new Exception("operation failed");
        }

        if ($type == AccountOperationTypeEnum::REFILL){
            $account->balance += $form->sum;
        }elseif ($type == AccountOperationTypeEnum::WRITE_OFF){
            $account->balance -= $form->sum;
        }else{
            return false;
        }

        if (! $account->save(false)){
            throw new Exception("operation failed");
        }

        return true;
    }
}
