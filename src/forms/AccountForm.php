<?php
namespace concepture\yii2account\forms;

use Yii;
use concepture\yii2logic\forms\Form;

/**
 * Class AccountForm
 * @package concepture\yii2account\forms
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class AccountForm extends Form
{
    public $entity_id;
    public $entity_type_id;
    public $balance;
    public $currency;
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
                    'entity_type_id',
                    'entity_id'
                ],
                'required'
            ],
        ];
    }
}
