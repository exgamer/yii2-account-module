<?php
namespace concepture\yii2account\forms;

use Yii;
use concepture\yii2logic\forms\Form;

/**
 * Class AccountOperationForm
 * @package concepture\yii2account\forms
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class AccountOperationForm extends Form
{
    public $account_id;
    public $payment_system_id;
    public $payment_system_transaction_number;
    public $sum;
    public $type;
    public $currency;
    public $description;
    public $status;

    /**
     * @see CForm::formRules()
     */
    public function formRules()
    {
        return [
            [
                [
                    'currency',
                    'account_id',
                    'payment_system_id',
                    'payment_system_transaction_number',
                    'type',
                    'sum'
                ],
                'required'
            ],
        ];
    }
}
