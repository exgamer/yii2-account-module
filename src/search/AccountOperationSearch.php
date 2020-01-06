<?php

namespace concepture\yii2account\search;

use concepture\yii2user\models\User;
use concepture\yii2account\models\AccountOperation;
use yii\db\ActiveQuery;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class AccountOperationSearch
 * @package concepture\yii2account\search
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class AccountOperationSearch extends AccountOperation
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
        ];
    }

    public function extendQuery(ActiveQuery $query)
    {
        $query->andFilterWhere([
            'id' => $this->id
        ]);
    }
}
