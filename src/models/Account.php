<?php
namespace concepture\yii2account\models;

use Yii;
use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2handbook\models\traits\CurrencyTrait;

/**
 * Class Account
 * @package concepture\yii2account\models
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class Account extends ActiveRecord
{
    use CurrencyTrait;

    /**
     * @see \concepture\yii2logic\models\ActiveRecord:label()
     * @return string
     */
    public static function label()
    {
        return Yii::t('account', 'Счета');
    }

    /**
     * @see \concepture\yii2logic\models\ActiveRecord:toString()
     * @return string
     */
    public function toString()
    {
        return $this->balance;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%account}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'balance'
                ],
                'double'
            ],
            [
                [
                    'entity_id',
                    'entity_type_id',
                    'currency',
                    'status'
                ],
                'integer'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('account', '#'),
            'entity_id' => Yii::t('account', 'Сущность'),
            'currency' => Yii::t('account', 'Валюта'),
            'balance' => Yii::t('account', 'Баланс'),
            'created_at' => Yii::t('account', 'Дата создания'),
        ];
    }
}
