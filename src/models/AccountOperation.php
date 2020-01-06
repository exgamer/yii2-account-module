<?php
namespace concepture\yii2account\models;

use Yii;
use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2handbook\models\traits\CurrencyTrait;
use concepture\yii2handbook\models\traits\PaymentSystemTrait;

/**
 * Class AccountOperation
 * @package concepture\yii2account\models
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class AccountOperation extends ActiveRecord
{
    use CurrencyTrait;
    use PaymentSystemTrait;

    /**
     * @see \concepture\yii2logic\models\ActiveRecord:label()
     * @return string
     */
    public static function label()
    {
        return Yii::t('account', 'Операции по счетам');
    }

    /**
     * @see \concepture\yii2logic\models\ActiveRecord:toString()
     * @return string
     */
    public function toString()
    {
        return $this->sum;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%account_operation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'sum'
                ],
                'double'
            ],
            [
                [
                    'account_id',
                    'payment_system_id',
                    'currency',
                    'type',
                    'payment_system_transaction_status',
                    'status'
                ],
                'integer'
            ],
            ['description', 'string', 'max' => 255],
            ['payment_system_transaction_number', 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('account', '#'),
            'currency' => Yii::t('account', 'Валюта'),
            'sum' => Yii::t('account', 'Сумма'),
            'account_id' => Yii::t('account', ' Аккаунт'),
            'payment_system_id' => Yii::t('account', 'Платежная система'),
            'payment_system_transaction_number' => Yii::t('account', 'Номер транзакции платежной системы'),
            'payment_system_transaction_status' => Yii::t('account', 'Статус транзакции платежной системы'),
            'type' => Yii::t('account', ' Вид операции'),
            'description' => Yii::t('account', 'Описание'),
            'created_at' => Yii::t('account', 'Дата создания'),
        ];
    }
}
