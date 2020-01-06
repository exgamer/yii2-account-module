<?php

namespace concepture\yii2account\search;

use concepture\yii2user\models\User;
use concepture\yii2account\models\Account;
use yii\db\ActiveQuery;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class AccountSearch
 * @package concepture\yii2account\search
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class AccountSearch extends Account
{
    public $username;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer']
        ];
    }

    public function extendQuery(ActiveQuery $query)
    {
        $query->andFilterWhere([
            'id' => $this->id
        ]);
    }
}
