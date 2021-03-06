<?php
use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191126_102330_account_table_create
 */
class m191231_102330_account_table_create extends Migration
{
    public function getTableName()
    {
        return 'account';
    }

    public function safeUp()
    {
        $this->addTable([
            'id' => $this->bigPrimaryKey(),
            'entity_id' =>  $this->bigInteger()->notNull(),
            'entity_type_id' => $this->bigInteger()->notNull(),
            'balance' => $this->double()->defaultValue(0),
            'currency_id' => $this->bigInteger()->notNull(),
            'status' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression("NOW()") ),
            'updated_at' => $this->dateTime(),
        ]);
        $this->addUniqueIndex(
            ['entity_id', 'entity_type_id',  'currency_id']);
        $this->addIndex(['entity_type_id']);
        $this->addIndex(['status']);
        $this->addIndex(['entity_id']);
        $this->addIndex(['currency_id']);
        $this->addForeign('currency_id', 'currency','id');
        $this->addForeign('entity_type_id', 'entity_type','id');
    }
}
