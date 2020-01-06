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
    public $payment_system_transaction_status;
    public $sum;
    public $type;
    public $description;

    /**
     * @see CForm::formRules()
     */
    public function formRules()
    {
        return [
            [
                [
                    'account_id',
                    'payment_system_id',
                    'payment_system_transaction_number',
                    'payment_system_transaction_status',
                    'type',
                    'sum'
                ],
                'required'
            ],
        ];
    }
}
